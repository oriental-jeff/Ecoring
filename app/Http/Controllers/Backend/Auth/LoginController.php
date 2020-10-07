<?php

namespace App\Http\Controllers\Backend\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  use AuthenticatesUsers;

  protected $redirectTo = RouteServiceProvider::BACKEND_HOME;

  public function __construct()
  {
    $this->middleware('guest:admin')->except('logout');
  }

  public function showLoginForm()
  {
    return view('backend.auth.login');
  }

  public function logout(Request $request)
  {
    $this->guard()->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    if ($response = $this->loggedOut($request)) {
      return $response;
    }

    return $request->wantsJson()
    ? new JsonResponse([], 204)
    : redirect('/');
  }

  public function loggedOut()
  {
    return redirect()->route('backend.auth.login.form');
  }

  public function credentials()
  {
    return array_merge(
      request()->only($this->username(), 'password'), 
      ['active' => 1, 'guest' => 0]
    );
  }
}
