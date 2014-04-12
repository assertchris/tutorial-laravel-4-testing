<?php

namespace Formativ;

interface PostValidatorInterface
{
  public function passes($event);

  public function messages($event);

  public function on($event);
}
