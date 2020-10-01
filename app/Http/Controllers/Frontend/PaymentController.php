<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Facades\App\Repository\Pages;
use App\Model\BankAccounts;
use Illuminate\Http\Request;
use App\Model\PaymentNotifications;

class PaymentController extends Controller
{

    public function index(Request $request)
    {
        $pages = Pages::get(3);
        $bank_accounts = BankAccounts::onlyActive()->get();

        return view('frontend.payment.index', compact(['pages', 'bank_accounts']));
    }
}
