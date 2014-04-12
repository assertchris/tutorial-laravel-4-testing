<?php

namespace Formativ;

use Illuminate\Http\Request;
use Str;

class PostRepository implements PostRepositoryInterface
{
  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  public function insert()
  {
    $data = [
      "title"     => $this->request->get("title"),
			"subtitle"  => $this->request->get("subtitle"),
			"body"      => $this->request->get("body"),
			"author_id" => $this->request->get("author"),
			"slug"      => Str::slug($this->request->get("title"))
    ];

    // insert posts with $data...
  }

  public function all(array $modifiers)
  {
    // return all the posts filtered by $modifiers...
  }

  public function first(array $modifiers)
  {
    // return the first post filtered by $modifiers...
  }

  public function update(array $data, array $modifiers)
  {
    // update posts filtered by $modifiers, with $data...
  }

  public function delete(array $modifiers)
  {
    // delete posts filtered by $modifiers...
  }
}
