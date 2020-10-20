<?php

namespace App\Http\Middleware;

use Closure;

class CheckFrontUserStatus
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
      if (auth()->check()) {
        if ((!$request->user()->isActive() || $request->user()->guest == '0') ) {
          auth()->logout();

          return redirect(route('frontend.auth.login.form', ['locale' => get_lang()]));
        }
      } else {
        return redirect(route('frontend.auth.login.form', ['locale' => get_lang()]));
      }

    return $next($request);
  }
}
