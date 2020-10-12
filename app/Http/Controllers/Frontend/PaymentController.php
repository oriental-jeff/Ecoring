<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Facades\App\Repository\Pages;
use App\Model\BankAccounts;
use Illuminate\Http\Request;
use App\Model\Orders;
use App\Model\PaymentNotifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;

class PaymentController extends Controller
{

    public function index($locate, Orders $OrderCode, Request $request)
    {
        $pages = Pages::get(3);
        $bank_accounts = BankAccounts::onlyActive()->get();

        return view('frontend.payment.index', compact(['pages', 'bank_accounts', 'OrderCode']));
    }

    public function store(Request $request)
    {
        $pages = Pages::get(3);
        // Check order
        // $order = Orders::where('code', $request->orders_code);
        $order = 'TEST-20201001';
        // dd($request);
        if ($order and $this->validateRequest()) {
            if (Auth::user()) {
                $fullname = Auth::user()->first_name . ' ' . Auth::user()->last_name;
                $contact = '';
                $email = Auth::user()->email;
            } else {
                $fullname = $request->fullname;
                $contact = $request->contact;
                $email = $request->email;
            }
            $detail = [
                'orders_code' => $request->orders_code,
                'bank_accounts_id' => $request->bank_accounts_id,
                'fullname'  => $fullname,
                'contact'  => $contact,
                'email'  => $email,
                'payment_datetime'  => $request->payment_date . ' ' . $request->payment_time,
            ];
            $detail['updated_by'] = Auth::id() ?? 1;
            $detail['created_by'] = Auth::id() ?? 1;
            $payment = PaymentNotifications::create($detail);
            $payment->storeImage();

            return view('frontend.payment.success', compact(['order', 'pages']));
        } else {
            return redirect(route('frontend.payment.index'));
        }
    }

    public function success(Request $request)
    {
        $pages = Pages::get(3);
        $order = 'TEST-20201001';
        $order = '';
        return view('frontend.payment.success', compact(['order', 'pages']));
    }

    private function validateRequest()
    {
        if (Auth::user()) {
            $validatedData = request()->validate([
                "orders_code" => "required",
                "fullname" => "",
                "contact" => "",
                "email" => "",
                "payment_date" => "required",
                "payment_time" => "required",
                "bank_accounts_id" => "required",
            ]);
        } else {
            $validatedData = request()->validate([
                "orders_code" => "required",
                "fullname" => "required",
                "contact" => "required",
                "email" => "required",
                "payment_date" => "required",
                "payment_time" => "required",
                "bank_accounts_id" => "required",
            ]);
        }

        request()->validate([
            "image"  => ['required', 'file', 'image', 'max:204800'],
        ]);

        return $validatedData;
    }

    public function send_email($data)
    {
      $to_email = $data['email'];
      // $to_email = 'dragoon.jr@gmail.com';
      $to_name = $data['name'];
      $send_to = [['email' => $to_email, 'name' => $to_name]];
      $data['from_name'] = 'Ecoring Thailand Shop';
      $data['subject'] = 'Thank you for order product from Ecoring Thailand Shop';
      $data['footer'] = 'Ecoring thailand shop team';

      Mail::to($send_to)
      ->send(new InvoiceMail($data));

      // foreach (['taylor@example.com', 'dries@example.com'] as $recipient) {
      //   Mail::to($recipient)->send(new ApplyMail($data));
      // }
      
    }
}
