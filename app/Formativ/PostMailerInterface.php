<?php

namespace Formativ;

interface PostMailerInterface
{
  public function send($to, $view, $data);
}
