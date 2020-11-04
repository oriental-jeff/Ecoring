<?php

namespace App\Helpers;

use App\Model\Orders;
use App\Model\WebInfo;
use Illuminate\Support\Facades\Mail;
use PDF;

class CustomSendMailWithPdf
{
    public static function send_invoice($order_id)
    {
        // GET : Order Data
        $order = Orders::where('id', $order_id)->get();

        // GET : Web Info Data
        $web_info = WebInfo::where('id', 1)->get();
        $data_pack = ['web_info' => $web_info, 'order' => $order];

        // Real
        $to_email = $order[0]->user->email;
        $to_name = "คุณ{$order[0]->user->first_name} {$order[0]->user->last_name}";

        // Test
        // $to_email = 'jeff2010@hotmail.co.th';
        // $to_name = "Jeff";

        $config_email['to_email'] = $to_email;
        $config_email['to_name'] = $to_name;
        $config_email['from_name'] = 'Ecoring Thailand Shop';
        $config_email['subject'] = 'Thank you for order product from Ecoring Thailand Shop';
        $config_email['footer'] = 'Ecoring thailand shop team';
        $send_to = [
            [
                'email' => $config_email['to_email'],
                'name' => $config_email['to_name'],
            ],
        ];

        try {
            $pdf_invoice = PDF::loadView('emails.invoice-email', $data_pack);

            Mail::send('emails.invoice-email', $data_pack, function ($message) use ($config_email, $pdf_invoice) {
                $message->to($config_email['to_email'], $config_email['to_name'])
                    ->subject('Thank you for order product from Ecoring Thailand Shop.')
                    ->attachData($pdf_invoice->output(), "ecoring-invoice.pdf");
            });
        } catch (JWTException $exception) {
            $message['serverstatuscode'] = "0";
            $message['serverstatusdes'] = $exception->getMessage();
        }

        if (Mail::failures()):
            $message['statusdesc'] = "Error sending mail";
            $message['statuscode'] = "0";
        else:
            $message['statusdesc'] = "Message sent Succesfully";
            $message['statuscode'] = "1";
        endif;

        return response()->json(compact('message'));
    }

    public static function send_receipt($order_id)
    {
        // GET : Order Data
        $order = Orders::where('id', $order_id)->get();
        // GET : Web Info Data
        $web_info = WebInfo::where('id', 1)->get();
        $data_pack = ['web_info' => $web_info, 'order' => $order];

        // Real
        $to_email = $order[0]->user->email;
        $to_name = "คุณ{$order[0]->user->first_name} {$order[0]->user->last_name}";

        // Test
        // $to_email = 'jeff2010@hotmail.co.th';
        // $to_name = "Jeff";

        $config_email['to_email'] = $to_email;
        $config_email['to_name'] = $to_name;
        $config_email['from_name'] = 'Ecoring Thailand Shop';
        $config_email['subject'] = 'Thank you for order product from Ecoring Thailand Shop';
        $config_email['footer'] = 'Ecoring thailand shop team';
        $send_to = [
            [
                'email' => $config_email['to_email'],
                'name' => $config_email['to_name'],
            ],
        ];

        try {
            $pdf_receipt = PDF::loadView('emails.receipt-email', $data_pack);

            Mail::send('emails.receipt-email', $data_pack, function ($message) use ($config_email, $pdf_receipt) {
                $message->to($config_email['to_email'], $config_email['to_name'])
                    ->subject('Thank you for order product from Ecoring Thailand Shop.')
                    ->attachData($pdf_receipt->output(), "ecoring-receipt.pdf");
            });
        } catch (JWTException $exception) {
            $message['serverstatuscode'] = "0";
            $message['serverstatusdes'] = $exception->getMessage();
        }

        if (Mail::failures()):
            $message['statusdesc'] = "Error sending mail";
            $message['statuscode'] = "0";
        else:
            $message['statusdesc'] = "Message sent Succesfully";
            $message['statuscode'] = "1";
        endif;

        return response()->json(compact('message'));
    }
}
