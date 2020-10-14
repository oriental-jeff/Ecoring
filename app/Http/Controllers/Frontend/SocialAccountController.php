<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Socialite;
use App\User;
use App\SocialAccount;

class SocialAccountController extends Controller
{
    public function redirectToProvider($locate, $provider = 'facebook')
    {
        // dd('a');
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($locate, Request $request, $provider = 'facebook')
    {
        // dd('loginCTL');
        try{
            $providerUser = Socialite::driver($provider)->stateless()->user();
        } catch (\Exception $e) {
            return redirect(route('frontend.auth.login.form', ['locale' => get_lang()]));
        }

        $user = $this->createOrGetUser($provider, $providerUser);

        if (!$user) return redirect(route('frontend.register', ['locale' => get_lang(), 'provider' => $provider, 'providerUser' => $providerUser]));
        if ($user == 'email_not_verified') {
            Auth::logout();
            $message = __('messages.email_not_verified');
            $request->session()->flash('message', $message);
            $request->session()->flash('alert-class', 'alert-warning');

            return redirect(route('frontend.auth.login.form', ['locale' => get_lang()]));
        }

        // Check Bind
        if ($user == 'binded') {
            return redirect(route('frontend.user.profile', ['locale' => get_lang()]));
        } else {
            Auth::login($user, true);

            return redirect(route('frontend.home', ['locale' => get_lang()]));
        }
    }

    public function createOrGetUser($provider, $providerUser)
    {
        /** Get User Auth */
            // dd(Auth::check());
        if (Auth::check()) {
            $user = auth()->user();
            /** Create Social Account */
            $account = new SocialAccount([
                'user_id' => $user->id,
                'provider' => $provider,
                'provider_user_id' => $providerUser->getId(),
            ]);
            $account->save();
            return 'binded';
        }else{
            /** Get Social Account */
            $account = SocialAccount::whereProvider($provider)
                ->whereProviderUserId($providerUser->getId())
                ->first();
            if ($account) {
                if ($account->user) {
                    return $account->user;
                } else {
                    return 'email_not_verified';
                }
            } else {
                return null;
            }
        }
    }

    public function deauthorizeProvider($locate, $provider = 'facebook')
    {
        if (Auth::check()) {
            $user = auth()->user();
            /** Create Social Account */
            $account = SocialAccount::where('user_id', Auth::id())->where('provider', $provider);
            $account->delete();

            return redirect(route('frontend.user.profile', ['locale' => get_lang()]));
        }

        return redirect(route('frontend.auth.login.form', ['locale' => get_lang()]));
    }

}

