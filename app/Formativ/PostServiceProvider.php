<?php

namespace Formativ;

use Illuminate\Support\ServiceProvider;

class PostServiceProvider
extends ServiceProvider
{
  /**
   * Indicates if loading of the provider is deferred.
   *
   * @var bool
   */
  protected $defer = true;

  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind(
      "Formativ\\PostRepositoryInterface",
      "Formativ\\PostRepository"
    );

    $this->app->bind(
      "Formativ\\PostValidatorInterface",
      "Formativ\\PostValidator"
    );

    $this->app->bind(
      "Formativ\\PostMailerInterface",
      "Formativ\\PostMailer"
    );
  }

  /**
   * Get the services provided by the provider.
   *
   * @return array
   */
  public function provides()
  {
    return [
      "Formativ\\PostRepositoryInterface",
      "Formativ\\ValidatorInterface",
      "Formativ\\MailerInterface"
    ];
  }
}
