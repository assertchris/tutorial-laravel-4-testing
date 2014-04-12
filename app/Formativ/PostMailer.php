<?php

namespace Formativ;

use Illuminate\Mail\Mailer;

class PostMailer implements PostMailerInterface
{

  public function __construct(Mailer $mailer)
  {
    $this->mailer = $mailer;
  }

  public function send($to, $view, $data)
  {
    $this->mailer->send(
      $view, $data,
      function($email) use ($to) {
			  $email->to($to);
  		}
    );
  }
}
