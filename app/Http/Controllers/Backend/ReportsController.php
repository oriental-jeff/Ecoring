<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\model\Orders;
use App\model\StatusConfig;
use App\Model\Stocks;
use Carbon\Carbon;

// Models
use App\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    const MODULE = 'reports';

    // V I E W & P R O C E S S
    public function orders(Request $request)
    {
        // $this->authorize(mapPermission(self::MODULE));

        // Initial Varialble
        $total_gross = 0;
        $total_discount = 0;
        $total_price = 0;
        $total_net = 0;

        // Filtering
        $filter = [
            'keyword' => $request->keyword,
            'from' => $request->from,
            'to' => $request->to,
            'type' => $request->payment_type,
            'status' => $request->status,
        ];

        // GET : Status Config
        $status = StatusConfig::where('type', 'order')->get();

        // COUNT : Total Orders
        $total_orders = Orders::get()->count();

        // GET : Data Orders
        if ($request->has('_token')):
            $orders = Orders::reportGetSearchData($request)->get();
        else:
            $orders = Orders::limit(30)->orderBy('created_at', 'desc')->get();
        endif;

        // COUNT : Displaying Orders
        $display_orders = $orders->count();

        // Preparing Data
        if ($orders->count() != 0):
            foreach ($orders as $key => $order):
                $pickup = $order->pickup_optional == 0 ? 'ใช้ช่องทางการจัดส่ง' : 'มารับสินค้าเอง';

                $gross_price = $order->total_amount + $order->discount;
                $net_price = $order->total_amount + $order->vat;
                $net_price_delivery = $net_price + $order->delivery_charge;

                $lists[$key]['date_order'] = Carbon::parse($order->created_at)->isoFormat('DD-MM-YYYY @ HH:mm:ss');
                $lists[$key]['code'] = $order->code;
                $lists[$key]['status'] = $order->status_config->name_th;
                $lists[$key]['payment_name'] = $order->payment_type;
                $lists[$key]['gross_price'] = $gross_price;
                $lists[$key]['discount'] = $order->discount;
                $lists[$key]['total_price'] = $order->total_amount;
                $lists[$key]['delivery_charge'] = $order->delivery_charge;
                $lists[$key]['vat'] = $order->vat;
                $lists[$key]['net_price'] = $net_price;
                $lists[$key]['net_price_delivery'] = $net_price_delivery;
                $lists[$key]['pickup'] = $pickup;
                $lists[$key]['logistic_image'] = $order->logistic->image;
                $lists[$key]['logistic_name'] = $order->logistic->name_th;
                // $list[$key][''] = $item->;

                $total_gross += $gross_price;
                $total_discount += $order->discount;
                $total_price += $order->total_amount;
                $total_net += $net_price;
            endforeach;
        else:
            $lists = [];
        endif;

        // Summaries
        $overall = [
            'gross' => $total_gross,
            'discount' => $total_discount,
            'price' => $total_price,
            'net' => $total_net,
        ];

        $compact = ['status', 'lists', 'overall', 'total_orders', 'display_orders', 'filter'];
        return view('backend.reports.orders', compact($compact));
    }

    public function customers(Request $request)
    {
        // $this->authorize(mapPermission(self::MODULE));

        // Filtering
        $filter = ['keyword' => $request->keyword];

        // COUNT : Total Users
        $total_users = User::where('guest', 1)->get()->count();

        // GET : Data User
        if ($request->has('_token')):
            $keyword = $request->keyword;
            $user_data = User::with('address_deliveries', 'social_account', 'profiles')
                ->reportGetDataByKeyword($keyword)
                ->get();
        else:
            $user_data = User::with('address_deliveries', 'social_account', 'profiles')->where('guest', 1)->limit(30)->get();
        endif;

        // COUNT : Displaying Users
        $display_users = count($user_data);

        // Preparing Data
        if ($user_data->count() != 0):
            foreach ($user_data as $key => $user):
                // Check Profile User
                if (!is_null($user->profiles)):
                    $gender = $user->profiles->sex == 1 ? 'ชาย' : 'หญิง';
                    $telephone = $user->profiles->telephone;
                    $birthdate = Carbon::parse($user->profiles->birthday)->isoFormat('DD-MM-YYYY');
                else:
                    $gender = 'ไม่มีข้อมูลโปรไฟล์';
                    $telephone = 'ไม่มีข้อมูลโปรไฟล์';
                    $birthdate = 'ไม่มีข้อมูลโปรไฟล์';
                endif;

                // Check Social Account
                if ($user->social_account->count() != 0):
                    $social = implode(', ', $user->social_account->pluck('provider')->all());
                else:
                    $social = '-';
                endif;

                $total_address_deliveries = $user->address_deliveries->count();

                $confirm_email = is_null($user->email_verified_at) ? 'ยังไม่มีการยืนยันอีเมล์' : 'ยืนยันอีเมล์แล้ว';

                $lists[$key]['count'] = $key + 1;
                $lists[$key]['user_id'] = $user->id;
                $lists[$key]['gender'] = $gender;
                $lists[$key]['fullname'] = "{$user->first_name} {$user->last_name}";
                $lists[$key]['email'] = $user->email;
                $lists[$key]['tel'] = $telephone;
                $lists[$key]['birthdate'] = $birthdate;
                $lists[$key]['bind_social'] = $social;
                $lists[$key]['confirm_email'] = $confirm_email;
                $lists[$key]['total_delivery_address'] = $total_address_deliveries;
                $lists[$key]['register_date'] = Carbon::parse($user->created_at)->isoFormat('DD-MM-YYYY @ HH:mm:ss');
            endforeach;
        else:
            $lists = [];
        endif;
        return view('backend.reports.customers', compact('lists', 'display_users', 'total_users', 'filter'));
    }

    public function stocks(Request $request)
    {
        // $this->authorize(mapPermission(self::MODULE));

        // Filtering
        $filter = ['keyword' => $request->keyword];

        // COUNT : Total Stocks
        $total_stocks = Stocks::count();

        // GET : Data Stocks
        if ($request->has('_token')):
            $stocks_data = Stocks::getDataByKeyword($request)->get();
        else:
            $stocks_data = Stocks::limit(30)->orderBy('updated_at', 'DESC')->get();
        endif;

        // COUNT : Display Stocks
        $display_stocks = count($stocks_data);

        // Preparing Data
        if ($stocks_data->count() != 0):
            foreach ($stocks_data as $key => $stock):
                $lists[$key]['count'] = $key + 1;
                $lists[$key]['id'] = $stock->id;
                $lists[$key]['date_add'] = Carbon::parse($stock->created_at)->isoFormat('DD-MM-YYYY @ HH:mm:ss');
                $lists[$key]['product_image'] = $stock->product->image;
                $lists[$key]['product_name_th'] = $stock->product->name_th;
                $lists[$key]['product_name_en'] = $stock->product->name_en;
                $lists[$key]['quantity'] = $stock->quantity;
                $lists[$key]['warehouse'] = $stock->warehouse->name;
            endforeach;
        else:
            $lists = [];
        endif;

        $compact = ['lists', 'total_stocks', 'display_stocks', 'filter'];
        return view('backend.reports.stocks', compact($compact));
    }

    // P R I V A T E
    private function _getData()
    {}
}
