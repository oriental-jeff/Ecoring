<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\BankAccounts;
use App\Model\Orders;
use App\Model\PaymentNotifications;
use Facades\App\Repository\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PDF;

// For Test Send Mail
use App\Helpers\CustomSendMailWithPdf as CustomMailPdf;

class PaymentController extends Controller
{

    public function index($locate, Orders $OrderCode, Request $request)
    {
        // For Test Send Mail
        // $result = CustomMailPdf::send_receipt(55);

        $pages = Pages::get(3);
        $bank_accounts = BankAccounts::onlyActive()->get();

        return view('frontend.payment.index', compact(['pages', 'bank_accounts', 'OrderCode']));
    }

    public function store(Request $request)
    {
        $pn = PaymentNotifications::where('orders_code', $request->orders_code)->count();
        if ($pn > 0) {
            return redirect(route('frontend.payment', ['locale' => get_lang()]));
        }

        $pages = Pages::get(3);
        // Check order
        $order = Orders::where('code', $request->orders_code);
        if ($order and $this->validateRequest()) {
            if (Auth::user()) {
                $fullname = Auth::user()->first_name . ' ' . Auth::user()->last_name;
                $contact = Auth::user()->profiles->telephone;
                $email = Auth::user()->email;
            } else {
                $fullname = $request->fullname;
                $contact = $request->contact;
                $email = $request->email;
            }
            $detail = [
                'orders_code' => $request->orders_code,
                'bank_accounts_id' => $request->bank_accounts_id,
                'fullname' => $fullname,
                'contact' => $contact,
                'email' => $email,
                'payment_datetime' => $request->payment_date . ' ' . $request->payment_time,
            ];
            $detail['updated_by'] = Auth::id() ?? 1;
            $detail['created_by'] = Auth::id() ?? 1;
            $payment = PaymentNotifications::create($detail);
            $payment->storeImage();

            return view('frontend.payment.success', compact(['order', 'pages']));
        } else {
            return redirect(route('frontend.payment', ['locale' => get_lang()]));
        }
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
            "image" => ['required', 'file', 'image', 'max:204800'],
        ]);

        return $validatedData;
    }

    public function send_email($data)
    {
        // $to_email = $data['email'];
        // $to_name = $data['name'];
        $data = [];
        $data['to_email'] = 'dragoon.jr@gmail.com';
        $data['to_name'] = 'Test';
        $send_to = [['email' => $data['to_email'], 'name' => $data['to_name']]];
        $data['from_name'] = 'Ecoring Thailand Shop';
        $data['subject'] = 'Thank you for order product from Ecoring Thailand Shop';
        $data['footer'] = 'Ecoring thailand shop team';

        $pdf = PDF::loadView('emails.invoice-email', $data);

        try {
            Mail::send('emails.invoice-email', $data, function ($message) use ($data, $pdf) {
                $message->to($data['to_email'], $data['to_name'])
                    ->subject('Thank you for order product from Ecoring Thailand Shop.')
                    ->attachData($pdf->output(), "invoice.pdf");
            });
        } catch (JWTException $exception) {
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }

        if (Mail::failures()) {
            $this->statusdesc = "Error sending mail";
            $this->statuscode = "0";

        } else {
            $this->statusdesc = "Message sent Succesfully";
            $this->statuscode = "1";
        }
        return response()->json(compact('this'));

        // Mail::to($send_to)
        // ->send(new InvoiceMail($data));

        // foreach (['taylor@example.com', 'dries@example.com'] as $recipient) {
        //   Mail::to($recipient)->send(new ApplyMail($data));
        // }

    }
}
