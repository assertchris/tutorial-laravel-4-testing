<?php

class PostControllerTest
extends TestCase
{
  public function tearDown()
  {
    Mockery::close();
  }

  public function testConstructor()
  {
    $repositoryMock = $this->getRepositoryMock();

    $mailerMock = $this->getMailerMock();

    $dispatcherMock = $this->getDispatcherMock();

    $dispatcherMock
      ->shouldReceive("listen")
      ->atLeast()
      ->once()
      ->with(
        "post.store",
        [$repositoryMock, "insert"]
      );

    $dispatcherMock
      ->shouldReceive("listen")
      ->atLeast()
      ->once()
      ->with(
        "post.store",
        [$mailerMock, "send"]
      );

    $postController = new PostController(
      $repositoryMock,
      $this->getValidatorMock(),
      $mailerMock,
      $this->getResponseMock(),
      $dispatcherMock
    );
  }

  public function testStore()
  {
    $validatorMock = $this->getValidatorMock();

    $validatorMock
      ->shouldReceive("passes")
      ->atLeast()
      ->once()
      ->with("store")
      ->andReturn(true);

    $responseMock = $this->getResponseMock();

    $responseMock
      ->shouldReceive("route")
      ->atLeast()
      ->once()
      ->with("posts.index")
      ->andReturn($responseMock);

    $responseMock
      ->shouldReceive("with")
      ->atLeast()
      ->once()
      ->with("success", true);

    $dispatcherMock = $this->getDispatcherMock();

    $dispatcherMock
      ->shouldReceive("fire")
      ->atLeast()
      ->once()
      ->with("post.store");

    $postController = new PostController(
      $this->getRepositoryMock(),
      $validatorMock,
      $this->getMailerMock(),
      $responseMock,
      $dispatcherMock
    );

    $postController->store();
  }

  public function testStoreFails()
  {
    $validatorMock = $this->getValidatorMock();

    $validatorMock
      ->shouldReceive("passes")
      ->atLeast()
      ->once()
      ->with("store")
      ->andReturn(false);

    $validatorMock
      ->shouldReceive("messages")
      ->atLeast()
      ->once()
      ->with("store")
      ->andReturn(["foo"]);

    $responseMock = $this->getResponseMock();

    $responseMock
      ->shouldReceive("back")
      ->atLeast()
      ->once()
      ->andReturn($responseMock);

    $responseMock
      ->shouldReceive("withErrors")
      ->atLeast()
      ->once()
      ->with(["foo"])
      ->andReturn($responseMock);

    $responseMock
      ->shouldReceive("withInput")
      ->atLeast()
      ->once()
      ->andReturn($responseMock);

    $postController = new PostController(
      $this->getRepositoryMock(),
      $validatorMock,
      $this->getMailerMock(),
      $responseMock,
      $this->getDispatcherMock()
    );

    $postController->store();
  }

  protected function getRepositoryMock()
  {
    return Mockery::mock("Formativ\PostRepositoryInterface")
      ->makePartial();
  }

  protected function getValidatorMock()
  {
    return Mockery::mock("Formativ\PostValidatorInterface")
      ->makePartial();
  }

  protected function getMailerMock()
  {
    return Mockery::mock("Formativ\PostMailerInterface")
      ->makePartial();
  }

  protected function getResponseMock()
  {
    return Mockery::mock("Illuminate\Support\Facades\Response")
      ->makePartial();
  }

  protected function getDispatcherMock()
  {
    return Mockery::mock("Illuminate\Events\Dispatcher")
      ->makePartial();
  }
}
