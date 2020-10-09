<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Redirect;

class CheckEmailVerified
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next, $redirectToRoute = null)
  {
    if (!$request->user() ||
      ($request->user() instanceof MustVerifyEmail &&
      !$request->user()->hasVerifiedEmail())) {

      auth()->logout();

      $message = __('messages.email_not_verified');
      $request->session()->flash('message', $message);
      $request->session()->flash('alert-class', 'alert-warning');

      // return $request->expectsJson()
      //     ? abort(403, 'Your email address is not verified.')
      //     : Redirect::route($redirectToRoute ?: 'verification.notice');
      return redirect(route('frontend.auth.login.form', ['locale' => get_lang()]));
    }

    return $next($request);
  }
}
