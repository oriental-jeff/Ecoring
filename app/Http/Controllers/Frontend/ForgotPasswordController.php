<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Facades\App\Repository\Pages;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

class ForgotPasswordController extends Controller
{
  public function index()
  {
    $pages = Pages::get(1);

    return view('frontend.user.forgetpass', compact(['pages']));
  }

  public function forgot() {
    $credentials = request()->validate(['email' => 'required|email']);
    Password::sendResetLink($credentials);

    $pages = Pages::get(1);

    $message = __('messages.send_forgot_email_success');
    Session::flash('message', $message);
    Session::flash('alert-class', 'alert-success');

    // return response()->json(["msg" => 'Reset password link sent on your email id.']);
    return redirect(route('frontend.password.reset', ['locale' => get_lang()]));
    // return view('frontend.user.forgetpass', compact(['pages']));
  }

  public function reset(Request $request) {
    $credentials = request()->validate([
      'email' => 'required|email',
      'token' => 'required|string',
      'password' => 'required|string|confirmed'
    ]);

    $reset_password_status = Password::reset($credentials, function ($user, $password) {
      $user->password = $password;
      $user->save();
    });

    if ($reset_password_status == Password::INVALID_TOKEN) {
      return response()->json(["msg" => "Invalid token provided"], 400);
    }

    return response()->json(["msg" => "Password has been successfully changed"]);
  }

}

