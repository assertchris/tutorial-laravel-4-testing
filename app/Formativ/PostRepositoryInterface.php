<?php

namespace Formativ;

interface PostRepositoryInterface
{
  public function all(array $modifiers);

  public function first(array $modifiers);

  public function insert();

  public function update(array $data, array $modifiers);

  public function delete(array $modifiers);
}
