<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illminate\Support\Facades\Auth;
use Carbon\Carbon;

// Models
use App\model\StatusConfig;
use App\model\Orders;
use App\User;

class ReportsController extends Controller
{
    const MODULE = 'reports';

    // public function index() {
    //     return redirect(route('backend.reports.orders'));
    // }

    // V I E W & P R O C E S S
    public function orders(Request $request) {
				// $this->authorize(mapPermission(self::MODULE));

				// Initial Varialble
				$total = 0;

        // GET : Status Config
        $status = StatusConfig::where('type', 'order')->get();

        // GET : Orders
        if ($request->has('_token')) :
            $orders = Orders::reportGetSearchData($request)->get();
        else :
            $orders = Orders::limit(50)->orderBy('created_at', 'desc')->get();
        endif;

				// Preparing Data
				if ($orders->count() != 0) :
					foreach ($orders as $key => $order) :
						$pickup = $order->pickup_optional == 0 ? 'ใช้ช่องทางการจัดส่ง' : 'มารับสินค้าเอง';
	
						$lists[$key]['date_order'] = Carbon::parse($order->created_at)->isoFormat('DD-MM-YYYY @ HH:mm:ss');
						$lists[$key]['code'] = $order->code;
						$lists[$key]['status'] = $order->status_config->name_th;
						$lists[$key]['payment_name'] = $order->payment_type;
						$lists[$key]['total_amount'] = $order->total_amount;
						$lists[$key]['vat'] = $order->vat;
						$lists[$key]['delivery_charge'] = $order->delivery_charge;
						$lists[$key]['pickup'] = $pickup;
						$lists[$key]['logistic_image'] = $order->logistic->image;
						$lists[$key]['logistic_name'] = $order->logistic->name_th;
						// $list[$key][''] = $item->;

						$total += $order->total_amount;
						$overall = ['total' => $total];
					endforeach;
				else :
					$list = [];
				endif;				

        // dd($overall);

        return view('backend.reports.orders', compact(['status', 'lists', 'overall']));
		}
		
		public function customers(Request $request) {
			// $this->authorize(mapPermission(self::MODULE));

			$user_data = User::with('address_deliveries', 'social_account', 'profiles')->get();
			dd($user_data);
			if ($user_data->count() != 0) :
				foreach ($user_data as $key => $user) :
					dd($user->profiles);
					$gender = $user->profiles->sex == 1 ? 'ชาย' : 'หญิง';
					$confirm_email = is_null($user->email_verified_at) ? 'ยังไม่มีการยืนยันอีเมล์' : 'ยืนยันอีเมล์แล้ว';

					if ($user->social_account->count() != 0) :
							$social = $user->social_account->pluck('provider');
						else :
							$social = '-';
					endif;

					$lists[$key]['count'] = $key + 1;
					$lists[$key]['gender'] = $gender;
					$lists[$key]['fullname'] = "{$user->first_name} {$user->last_name}";
					$lists[$key]['email'] = $user->email;
					$lists[$key]['tel'] = $user->profile->telephone;
					$lists[$key]['birthdate'] = Carbon::parse($user->profile->birthday)->isoFormat('DD-MM-YYYY');
					$lists[$key]['bind_social'] = $social;
					$lists[$key]['confirm_email'] = $confirm_email;
					$lists[$key]['total_delivery_address'] = 0;
					$lists[$key]['register_date'] = Carbon::parse($user->created_at)->isoFormat('DD-MM-YYYY @ HH:mm:ss');
				endforeach;
			else :
				$lists = [];
			endif;

			dd($lists);

			return view('backend.reports.cusomters', compact('lists'));
		}

    // P R I V A T E
    // Not Used
    private function _process_serach_orders($request) {
        if ($request->has('from')) :
            $orders = Orders::reportOrdersGetSearchData($request)->get();
        else :
            echo 'Not Date';
        endif;

        dd($orders);
    }
}
