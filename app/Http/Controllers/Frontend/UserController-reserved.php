<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Facades\App\Repository\Pages;
use App\User;
use App\SocialAccount;
use App\Model\UserProfile;
use App\Model\UserAddressDelivery;
use App\Model\UserVerify;
use App\Model\Province;
use App\Model\District;
use App\Model\SubDistrict;
use App\Model\Favorites;
use App\Model\Orders;
use App\Model\StatusConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;

class UserController extends Controller
{
    public function index()
    {
        $pages = Pages::get(1);

        return view('frontend.register.index', compact(['pages']));
    }

    public function create()
    {
        if (get_lang() == 'th') :
            $name = 'name_th';
        else :
            $name = 'name_en';
        endif;

        $user = new User;
        $pages = Pages::get(1);
        $provinces = Province::orderBy($name, 'asc')->get();

        return view('frontend.register.index', compact(['user', 'pages', 'provinces']));
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => '',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'sex' => ['required'],
            'birthday' => '',
            'telephone' => ['required'],
            'address' => ['required'],
            'province' => ['required'],
            'district' => ['required'],
            'sub_district' => ['required'],
            'postcode' => ['required'],
            'current_address' => ['required'],
            'receive_info' => '',
            'privacy_confirm' => ['required'],
            'delivery_fullname' => ['required', 'string', 'max:255'],
            'delivery_address' => ['required'],
            'delivery_province' => ['required'],
            'delivery_district' => ['required'],
            'delivery_sub_district' => ['required'],
            'delivery_postcode' => ['required'],
            'delivery_telephone' => ['required'],
            'provider' => '',
            'provider_user_id' => '',
        ]);

        $user_data = [
            'guest' => 1,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'active' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ];

        $user_profile = [
            'sex' => $data['sex'],
            'birthday' => $data['birthday'],
            'telephone' => $data['telephone'],
            'address' => $data['address'],
            'province_id' => $data['province'],
            'district_id' => $data['district'],
            'sub_district_id' => $data['sub_district'],
            'postcode' => $data['postcode'],
            'current_address' => $data['current_address'],
            'receive_info' => $data['receive_info'],
            'privacy_confirm' => $data['privacy_confirm'],
        ];

        $user_address_delivery = [
            'default' => 1,
            'fullname' => $data['delivery_fullname'],
            'address' => $data['delivery_address'],
            'province_id' => $data['delivery_province'],
            'district_id' => $data['delivery_district'],
            'sub_district_id' => $data['delivery_sub_district'],
            'postcode' => $data['delivery_postcode'],
            'telephone' => $data['delivery_telephone'],
        ];

        $user = User::create($user_data);

        /** Create Social Account */
        if ($data['provider_user_id']) {
            $account = new SocialAccount([
                'user_id' => $user->id,
                'provider' => $data['provider'],
                'provider_user_id' => $data['provider_user_id'],
            ]);
            $account->save();
        }

        $user_profile['user_id'] = $user->id;
        UserProfile::create($user_profile);

        $user_address_delivery['user_id'] = $user->id;
        UserAddressDelivery::create($user_address_delivery);

        $user->sendEmailVerificationNotification();

        $verify_code = '';
        $email_data = [
            'email' => $data['email'],
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'verify_code' => $verify_code,
        ];
        // $this->send_email($email_data);

        // $message = __('messages.create_success');
        $message = __('messages.verify_resend_success');
        $request->session()->flash('message', $message);
        $request->session()->flash('alert-class', 'alert-success');

        return redirect(route('frontend.auth.login.form', ['locale' => get_lang()]));
    }

    public function verify_resend(Request $request)
    {
        $user = User::find(4);
        $user->sendEmailVerificationNotification();

        $message = __('messages.verify_resend_success');
        $request->session()->flash('message', $message);
        $request->session()->flash('alert-class', 'alert-success');

        return redirect(route('frontend.auth.login.form', ['locale' => get_lang()]));
    }

    public function verify_register()
    {
        $verify_code = '';
        $verify = UserVerify::where('verify_code', $verify_code)->whereRaw('now() >= end_date_time')->first();
        if ($verify) :
            $user_id = $verify->user_id;
            $user_data = [
                'active' => 1,
            ];
            User::where('user_id', $user->id)->update($user_data);
        endif;
    }

    public function edit()
    {
        $name = get_lang() == 'th' ? 'name_th' : 'name_en';

        $pages = Pages::get(1);
        $user = User::where('id', Auth::id())->first();
        $provinces = Province::orderBy($name, 'asc')->get();
        $districts = District::where('id', $user->profiles->district_id)->orderBy($name, 'asc')->get();
        $sub_districts = SubDistrict::where('id', $user->profiles->sub_district_id)->orderBy($name, 'asc')->get();

        return view('frontend.user.profile', compact(['user', 'pages', 'provinces', 'districts', 'sub_districts']));
    }

    public function update($language, Request $request, User $user)
    {
        dd($request);
        if ($request->filled('password')) :
            $data = request()->validate([
                'old_password' => ['required', 'string', 'min:8'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $hashedPassword = Auth::user()->password;
            if (Hash::check($request->old_password, $hashedPassword)) : // check old password
                if (!Hash::check($request->password, $hashedPassword)) : // check duplicate new password with old password
                    $user_data['password'] = Hash::make($data['password']);
                    $user->update($user_data);

                    $message = __('messages.update_password_success');
                    $alert_class = 'alert-success';
                else :
                    $message = __('messages.duplicate_password');
                    $alert_class = 'alert-warning';
                endif;
            else :
                $message = __('messages.old_password_not_matched');
                $alert_class = 'alert-warning';
            endif;

            $request->session()->flash('message', $message);
            $request->session()->flash('alert-class', $alert_class);

            return redirect()->back();
        elseif (request()->has('avatar')) :
            $user->profiles->storeImage('avatar');

            $message = __('messages.change_avatar_success');
            $request->session()->flash('message', $message);
            $request->session()->flash('alert-class', 'alert-success');
            return redirect(route('frontend.user.profile', ['locale' => get_lang()]));
        else :
            $data = request()->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => '',
                'sex' => ['required'],
                'birthday' => ['required'],
                'telephone' => ['required'],
                'address' => ['required'],
                'province' => ['required'],
                'district' => ['required'],
                'sub_district' => ['required'],
                'postcode' => ['required'],
                'receive_info' => '',
                'delivery_fullname' => ['required', 'string', 'max:255'],
                'delivery_address' => ['required'],
                'delivery_province' => ['required'],
                'delivery_district' => ['required'],
                'delivery_sub_district' => ['required'],
                'delivery_postcode' => ['required'],
                'delivery_telephone' => ['required'],
            ]);

            $user_data = [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ];

            $user_profile = [
                'sex' => $data['sex'],
                'birthday' => $data['birthday'],
                'telephone' => $data['telephone'],
                'address' => $data['address'],
                'province_id' => $data['province'],
                'district_id' => $data['district'],
                'sub_district_id' => $data['sub_district'],
                'postcode' => $data['postcode'],
                'receive_info' => $data['receive_info']
            ];

            $user_address_delivery = [
                'default' => 1,
                'fullname' => $data['delivery_fullname'],
                'address' => $data['delivery_address'],
                'province_id' => $data['delivery_province'],
                'district_id' => $data['delivery_district'],
                'sub_district_id' => $data['delivery_sub_district'],
                'postcode' => $data['delivery_postcode'],
                'telephone' => $data['delivery_telephone']
            ];

            $userProfile = UserProfile::where('user_id', $user->id)->update($user_profile);

            UserAddressDelivery::where('user_id', $user->id)->update($user_address_delivery);

            $user->update($user_data);

            $message = __('messages.update_success');
            $alert_class = 'alert-success';

            $request->session()->flash('message', $message);
            $request->session()->flash('alert-class', $alert_class);

            return redirect(route('frontend.user.profile', ['locale' => get_lang()]));
        endif;
    }

    public function edit_password()
    {
        $pages = Pages::get(1);
        $user = User::where('id', Auth::id())->first();

        return view('frontend.user.changepass', compact(['user', 'pages']));
    }

    public function history(Request $request)
    {
        $pages = Pages::get(1);
        $orders = Orders::where('users_id', Auth::id());
        if ($request->filled('search_orderid')) {
            $orders = $orders->where('code', 'like', "%$request->search_orderid%");
        }
        $orders = $orders->orderBy('created_at', 'desc')->paginate(config('global.pagination'));
        $status = StatusConfig::where('type', 'order')->get();

        return view('frontend.user.history', compact(['orders', 'pages', 'status']));
    }

    public function detail($local, $order_id)
    {
        $pages = Pages::get(1);
        $order = Orders::where([['id', $order_id], ['users_id', Auth::id()]])->get();
        $status = StatusConfig::where('type', 'order')->get();

        return view('frontend.user.history-detail', compact(['order', 'pages', 'status']));
    }

    public function favorite(Request $request)
    {
        $pages = Pages::get(1);
        $favorites = Favorites::where('user_id', Auth::id());
        if ($request->filled('sort')) :
            $favorites = $favorites->whereHas('products', function ($q) use ($request) {
                if ($request->sort == 1) : //สินค้าแนะนำ
                    $q->orderBy('recommend', 'desc');
                elseif ($request->sort == 2) : //สินค้ามาใหม่
                    $q->orderBy('created_at', 'desc');
                elseif ($request->sort == 3) : // เกรดสินค้า A > D
                    $q->orderBy('grades_id', 'asc');
                elseif ($request->sort == 4) : // เกรดสินค้า D > A
                    $q->orderBy('grades_id', 'desc');
                elseif ($request->sort == 5) : // ราคาน้อย > มาก
                    $q->orderBy('price', 'asc');
                elseif ($request->sort == 6) : // ราคามาก > น้อย
                    $q->orderBy('price', 'desc');
                else :
                    $q->orderBy('updated_at', 'desc');
                endif;
            });
        endif;
        $favorites = $favorites->paginate(config('global.pagination'));

        return view('frontend.user.favorite', compact(['pages', 'favorites']));
    }

    public function send_email($data)
    {
        $to_email = $data['email'];
        // $to_email = 'dragoon.jr@gmail.com';
        $to_name = $data['name'];
        $send_to = [['email' => $to_email, 'name' => $to_name]];
        $data['from_name'] = 'Ecoring Thailand';
        $data['subject'] = '[Ecoring] Please verify your email address';
        $data['footer'] = 'Ecoring Thailand team';

        Mail::to($send_to)
            ->send(new RegisterMail($data));

        // foreach (['taylor@example.com', 'dries@example.com'] as $recipient) {
        //   Mail::to($recipient)->send(new ApplyMail($data));
        // }

    }
}
