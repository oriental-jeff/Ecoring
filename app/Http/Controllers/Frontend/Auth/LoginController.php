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

  public function showLoginForm()
  {
    $pages = Pages::get(1);
    return view('frontend.auth.login', compact(['pages']));
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

  public function redirectToProvider($provider = 'facebook')
    {
      return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request, $provider = 'facebook')
    {
      if ($request->query('error_code')) {
        return abort(404);
      }
      $providerUser = Socialite::driver($provider)->user();

      $user = $this->createOrGetUser($provider, $providerUser);
      auth()->login($user);

      return redirect('/#');
    }

    public function createOrGetUser($provider, $providerUser)
    {
      $account = User::whereSocial($provider)
          ->whereSocialId($providerUser->getId())
          ->first();

      if ($account) {
        return $account;
      } else {
        $userDetail = Socialite::driver($provider)->userFromToken($providerUser->token);

        /** Get email or not */
        $email = !empty($providerUser->getEmail()) ? $providerUser->getEmail() : $providerUser->getId() . '@' . $provider . '.com';

        /** Get User Auth */
        if (auth()->check()) {
          $user = auth()->user();
        } else {
          $user = User::whereEmail($email)->first();
        }

        if (!$user) {

          /** Create User */
          $name = explode(" ", $providerUser->getName());
          $user = User::create([
              'email' => $email,
              'first_name' => $name[0],
              'last_name' => $name[1],
              'email' => $email,
              'social' => $provider,
              'social_id' => $providerUser->getId(),
              'password' => bcrypt(rand(1000, 9999)),
          ]);
          $user->save();
        }
        return $user;
      }
    }
}
