<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Mail;
use App\Model\Orders;
use App\Model\WebInfo;
use PDF;

Class SendPdfMail {
    public static function send($payment_type, $order_id) {
        $order = Orders::where('id', $order_id)->get();
        $web_info = WebInfo::where('id', 1)->get();
        $data_pack = ['web_info' => $web_info, 'order' => $order];

        // Real
        // $to_email = $order->user->email;
        // $to_name = "คุณ{$order->user->first_name} {$order->user->last_name}";

        // Test
        $to_email = 'jeff2010@hotmail.co.th';
        $to_name = "Jeff";

        $config_email['to_email'] = $to_email;
        $config_email['to_name'] = $to_name;
        $config_email['from_name'] = 'Ecoring Thailand Shop';
        $config_email['subject'] = 'Thank you for order product from Ecoring Thailand Shop';
        $config_email['footer'] = 'Ecoring thailand shop team';
        $send_to = [['email' => $config_email['to_email'], 'name' => $config_email['to_name']]];

        if ($payment_type == 0) :
            $pdf_invoice = PDF::loadView('emails.invoice-email', $data_pack);
        else :
            $pdf_invoice = PDF::loadView('emails.invoice-email', $data_pack);
            $pdf_receipt = PDF::loadView('emails.receipt-email', $data_pack);
        endif;

        try {
            if ($payment_type == 0) :
                Mail::send('emails.invoice-email', $data_pack, function ($message) use ($config_email, $pdf_invoice) {
                    $message->to($config_email['to_email'], $config_email['to_name'])
                        ->subject('Thank you for order product from Ecoring Thailand Shop.')
                        ->attachData($pdf_invoice->output(), "ecoring-invoice.pdf");
                });
            else :
                Mail::send('emails.invoice-email', $data_pack, function ($message) use ($config_email, $pdf_invoice) {
                    $message->to($config_email['to_email'], $config_email['to_name'])
                        ->subject('Thank you for order product from Ecoring Thailand Shop.')
                        ->attachData($pdf_invoice->output(), "ecoring-invoice.pdf");
                });

                Mail::send('emails.receipt-email', $data_pack, function ($message) use ($config_email, $pdf_receipt) {
                    $message->to($config_email['to_email'], $config_email['to_name'])
                        ->subject('Thank you for order product from Ecoring Thailand Shop.')
                        ->attachData($pdf_receipt->output(), "ecoring-receipt.pdf");
                });
            endif;


        } catch (JWTException $exception) {
            $message['serverstatuscode'] = "0";
            $message['serverstatusdes'] = $exception->getMessage();
        }

        if (Mail::failures()) :
            $message['statusdesc'] = "Error sending mail";
            $message['statuscode'] = "0";
        else :
            $message['statusdesc'] = "Message sent Succesfully";
            $message['statuscode'] = "1";
        endif;

        return response()->json(compact('message'));
    }
}
