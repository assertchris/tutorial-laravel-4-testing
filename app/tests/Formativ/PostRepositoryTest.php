<?php

namespace Formativ;

use Mockery;
use TestCase;

class PostRepositoryTest
extends TestCase
{
  public function tearDown()
  {
    Mockery::close();
  }

  public function testSend()
  {
    $requestMock = $this->getRequestMock();

    $requestMock
      ->shouldReceive("get")
      ->atLeast()
      ->once()
      ->with("title");

    $requestMock
      ->shouldReceive("get")
      ->atLeast()
      ->once()
      ->with("subtitle");

    $requestMock
      ->shouldReceive("get")
      ->atLeast()
      ->once()
      ->with("body");

    $requestMock
      ->shouldReceive("get")
      ->atLeast()
      ->once()
      ->with("author");

    $postRepository = new PostRepository($requestMock);
    $postRepository->insert();
  }

  protected function getRequestMock()
  {
    return Mockery::mock("Illuminate\Http\Request");
  }
}
