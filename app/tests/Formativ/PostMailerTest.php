<?php

namespace Formativ;

use Mockery;
use TestCase;

class PostMailerTest
extends TestCase
{
  public function tearDown()
  {
    Mockery::close();
  }

  public function testSend()
  {
    $mailerMock = $this->getMailerMock();

    $mailerMock
      ->shouldReceive("send")
      ->atLeast()->once()
      ->with(
        "bar", ["baz"],
        $this->getSendCallbackMock()
      );

    $postMailer = new PostMailer($mailerMock);
    $postMailer->send("foo", "bar", ["baz"]);
  }

  protected function getSendCallbackMock()
  {
    return Mockery::on(function($callback) {
      $emailMock = Mockery::mock("stdClass");

      $emailMock
        ->shouldReceive("to")
        ->atLeast()
        ->once()
        ->with("foo");

      $callback($emailMock);

      return true;
    });
  }

  protected function getMailerMock()
  {
    return Mockery::mock("Illuminate\Mail\Mailer");
  }
}
