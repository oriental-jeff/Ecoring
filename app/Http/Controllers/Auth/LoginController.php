<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
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
