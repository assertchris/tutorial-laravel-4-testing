<?php

use Formativ\PostRepositoryInterface;
use Formativ\PostValidatorInterface;
use Formativ\PostMailerInterface;
use Illuminate\Support\Facades\Response;
use Illuminate\Events\Dispatcher;

class PostController
extends BaseController
{
	public function __construct(
		PostRepositoryInterface $repository,
		PostValidatorInterface $validator,
		PostMailerInterface $mailer,
		Response $response,
		Dispatcher $dispatcher
	)
	{
		$this->repository = $repository;
		$this->validator  = $validator;
		$this->mailer     = $mailer;
		$this->response   = $response;
		$this->dispatcher = $dispatcher;

		$this->dispatcher->listen(
			"post.store",
			[$this->repository, "insert"]
		);

		$this->dispatcher->listen(
			"post.store",
			[$this->mailer, "send"]
		);
	}

	public function store()
	{
		if ($this->validator->passes("store")) {
			$this->dispatcher->fire("post.store");

			return $this->response
				->route("posts.index")
				->with("success", true);
		}

		return $this->response
			->back()
			->withErrors($this->validator->messages("store"))
			->withInput();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
