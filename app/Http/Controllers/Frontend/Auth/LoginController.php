<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Facades\App\Repository\Pages;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }

    public function redirectTo()
    {
        return app()->getLocale() . '/home';
    }

    public function showLoginForm()
    {
        $pages = Pages::get(1);
        return view('frontend.auth.login', compact(['pages']));
    }

    public function authenticated(Request $request, $user)
    {
      $user = Auth::user();
      if (is_null($user->email_verified_at)) { // This is the most important part for you
        Auth::logout();
        $message = __('messages.email_not_verified');
        $request->session()->flash('message', $message);
        $request->session()->flash('alert-class', 'alert-warning');

        return redirect(route('frontend.auth.login.form', ['locale' => get_lang()]));
      }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }

    public function loggedOut()
    {
        return redirect()->route('/');
    }

    public function credentials()
    {
        return array_merge(
            request()->only($this->username(), 'password'),
            ['active' => 1, 'guest' => 1]
        );
    }
}
