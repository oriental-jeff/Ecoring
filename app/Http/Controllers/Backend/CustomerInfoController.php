<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

// Model
use App\User;
use App\Model\Province;
use App\Model\District;
use App\Model\SubDistrict;
use App\Model\UserAddressDelivery;

class CustomerInfoController extends Controller
{
    const MODULE = 'customerinfo';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        // $this->authorize(mapPermission(self::MODULE));

        // Filtering
        $filter = ['keyword' => $request->keyword];

        // COUNT : Total Customer ( User )
        $total_customer = User::where('guest', 1)->count();

        // GET : User Data
        if ($request->has('_token') && !is_null($request->keyword)) :
            $keyword = $request->keyword;
            $users_data = User::with('profiles', 'social_account')
            ->reportGetDataByKeyword($keyword)
            ->ofSort(['active' => 'DESC', 'created_at' => 'DESC'])
            ->get();
        else :
            $users_data = User::with('profiles', 'social_account')
            ->ofSort(['active' => 'DESC', 'created_at' => 'DESC'])
            ->where('guest', 1)
            ->limit(50)
            ->get();
        endif;

        // COUNT : Displaying Customer ( User )
        $display_customer = count($users_data);

        // Preparing Data
        if ($users_data->count() != 0) :
            // User Data
            foreach ($users_data as $key => $item) :
                $gender = $item->profiles->sex == 1 ? '<i class="fal fa-lg fa-mars"></i> ชาย' : '<i class="fal fa-lg fa-venus"></i> หญิง';
                $status = $item->active == 1 ? 'Activated' : 'Deactivated';
                $class_status = $item->active == 1 ? 'text-success' : 'text-danger';
                $fullname = "{$item->first_name} {$item->last_name}";

                // Email Verified
                if (is_null($item->email_verified_at)) :
                    $icon = '<i class="fal fa-lg fa-times-circle text-danger" title="-"></i>';
                else :
                    $confirmed_email_date = Carbon::parse($item->email_verified_at)->isoFormat('DD/MM/YYYY @ HH:mm:ss');
                    $icon = '<i class="fal fa-lg fa-check-circle text-success" title="' . $confirmed_email_date . '"></i>';
                endif;

                // Bind Social
                if ($item->social_account->count() != 0) :
                    $social = implode(', ', array_map('ucfirst', $item->social_account->pluck('provider')->all()));
                else :
                    $social = '-';
                endif;

                $lists[$key]['count'] = $key + 1;
                $lists[$key]['user_id'] = $item->id;
                $lists[$key]['gender'] = $gender;
                $lists[$key]['status'] = $status;
                $lists[$key]['class_status'] = $class_status;
                $lists[$key]['fullname'] = $fullname;
                $lists[$key]['email'] = $item->email;
                $lists[$key]['bind_social'] = $social;
                $lists[$key]['telephone'] = $item->profiles->telephone;
                $lists[$key]['confirmed_email_icon'] = $icon;
                $lists[$key]['created_date'] = Carbon::parse($item->created_at)->isoFormat('DD/MM/YYYY @ HH:mm:ss');
                $lists[$key]['updated_date'] = Carbon::parse($item->updated_at)->isoFormat('DD/MM/YYYY @ HH:mm:ss');
                $lists[$key]['updated_by'] = $item->user_updates->first_name;
                // $lists[$key][''] = $item->;
            endforeach;
        else :
            $lists = [];
        endif;

        $compact = ['lists', 'total_customer', 'display_customer', 'filter'];
        return view('backend.customerinfo.index', compact($compact));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $customerinfo) {
        $user = $customerinfo;
        $provinces = Province::orderBy('name_th', 'ASC')->get();

        return view('backend.customerinfo.update-data', compact('user', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $customerinfo) {
        // $this->authorize(mapPermission(self::MODULE));

        $fullname = "{$customerinfo->first_name} {$customerinfo->last_name}";

        $result_user = $customerinfo->update($this->_validate_request_user());
        $result_profile = $customerinfo->profiles->update($this->_validate_request_profile());

        // echo "{$result_user} : {$result_profile}";
        // dd($customerinfo);

        if ($result_profile == 1 && $result_user == 1) :
            $message = "User {$fullname} has been updated data.";
            $class = 'alert-success';
        else :
            $message = "Update data failed.";
            $class = 'alert-danger';
        endif;

        session()->flash('message', $message);
        session()->flash('alert-class', $class);
        return redirect(route('backend.customerinfo.index'));
    }

    /**
     * Remove the specified resource from storage. ( Not Used )
     */
    public function destroy(User $customerinfo) {
        // $this->authorize(mapPermission(self::MODULE));
        $customerinfo->delete();
    }

    // ------------------------------------------------------------------------------------------------
    // C U S T O M - B U I L D
    public function edit_shipping($user_id) {
        // $this->authorize(mapPermission(self::MODULE));
        $addresses = User::with('address_deliveries')->find($user_id);

        // foreach ($addresses->address_deliveries as $key => $item) :
        //     echo "{$item->fullname}<br>";
        // endforeach;
        // exit();

        return view('backend.customerinfo.update-shipping', compact('addresses'));
    }

    public function edit_password($user_id) {
        // $this->authorize(mapPermission(self::MODULE));
        $user = User::find($user_id);
        return view('backend.customerinfo.update-password', compact('user'));
    }

    public function process_update_password(Request $request) {
        // $this->authorize(mapPermission(self::MODULE));

        $new_pass = $request->new_pass;
        $con_new_pass = $request->confirm_new_pass;

        if ($new_pass === $con_new_pass) :
            $user = User::find($request->user_id);

            $user->password = Hash::make($new_pass);
            $user->save();

            $message = "User {$user->first_name} {$user->last_name} password has been changed.";
            $class = 'alert-success';
        else :
            $message = "User {$user->first_name} {$user->last_name} update password failed.";
            $class = 'alert-error';
        endif;

        $request->session()->flash('message', $message);
        $request->session()->flash('alert-class', $class);
        return redirect(route('backend.customerinfo.index'));
    }

    public function activation_user($user_id) {
        // $this->authorize(mapPermission(self::MODULE));
        $user = User::find($user_id);
        $fullname = "{$user->first_name} {$user->last_name}";

        $user->active = 1;
        $result = $user->save();

        if ($result == true) :
            session()->flash('message', "User {$fullname} has been activated.");
            session()->flash('alert-class', 'alert-success');
        endif;

        return redirect(route('backend.customerinfo.index'));
    }

    public function deactivation_user($user_id) {
        // $this->authorize(mapPermission(self::MODULE));

        $user = User::find($user_id);
        $fullname = "{$user->first_name} {$user->last_name}";

        $user->active = 0;
        $result = $user->save();

        if ($result == true) :
            session()->flash('message', "User {$fullname} has been deactivated.");
            session()->flash('alert-class', 'alert-success');
        endif;

        return redirect(route('backend.customerinfo.index'));
    }

    // ------------------------------------------------------------------------------------------------
    // A J A X
    public function ajax_get_districts_from_province_id(Request $request) {
        // $this->authorize(mapPermission(self::MODULE));

        $districts = District::where('province_id', $request->province_id)->orderBy('name_th', 'ASC')->get();
        return response()->json($districts);
    }

    public function ajax_get_subdistrict_from_district_id(Request $request) {
        // $this->authorize(mapPermission(self::MODULE));

        $sub_districts = SubDistrict::where('district_id', $request->district_id)->orderBy('name_th', 'ASC')->get();
        return response()->json($sub_districts);
    }

    public function ajax_remove_shipping_address(Request $request) {
        $shipping_id = $request->shipping_id;
        $result = UserAddressDelivery::where('id', $shipping_id)->delete();
        return response()->json($result);
    }

    // ------------------------------------------------------------------------------------------------
    // P R I V A T E
    private function _validate_request_user() {
        $validated_data = request()->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email']
            ]);

        $validated_data['updated_by'] = Auth::id();

        return $validated_data;
    }

    private function _validate_request_profile() {
        $validated_data = request()->validate([
            'telephone' => ['required', 'min:10', 'max:15'],
            'birthday' => ['required', 'date', 'date_format:Y-m-d'],
            'address' => ['required', 'string'],
            'province_id' => 'required',
            'district_id' => 'required',
            'sub_district_id' => 'required',
            'postcode' => 'required'
            ]);

        return $validated_data;
    }
}
