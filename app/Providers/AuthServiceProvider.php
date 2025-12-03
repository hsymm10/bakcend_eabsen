<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * The model to policy mappings for the application.
   *
   * @var arraylass-string, class-string>
   */
  protected $policies = [
    // 'App\Models\Model' => 'App\Policies\ModelPolicy',
  ];

  /**
   * Register any authentication / authorization services.
   */
  public function boot(): void
  {
    $this->registerPolicies();

    // Custom URL untuk email reset password (SPA Nuxt)
    ResetPassword::createUrlUsing(function ($user, string $token) {
      $frontend = config('app.frontend_url', 'http://localhost:3000');

      return $frontend . '/reset-password?token=' . $token . '&email=' . urlencode($user->email);
    });
  }
}
