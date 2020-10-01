<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Facades\App\Repository\Pages;
use App\Model\BankAccounts;
use Illuminate\Http\Request;
use App\Model\PaymentNotifications;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    public function index(Request $request)
    {
        $pages = Pages::get(3);
        $bank_accounts = BankAccounts::onlyActive()->get();

        return view('frontend.payment.index', compact(['pages', 'bank_accounts']));
    }

    public function store(Request $request)
    {
        $product = PaymentNotifications::create($this->validateRequest());
        $product->storeImage();

        return redirect(route('frontend.payment.index'));
    }

    private function validateRequest()
    {
        $validatedData = request()->validate([
            "categories_id" => "required",
            "grades_id" => "required",
            "sku" => "",
            "name_th" => "required",
            "name_en" => "required",
            "description_th" => "",
            "description_en" => "",
            "info_th" => "",
            "info_en" => "",
            "full_price" => "required",
            "price" => "required",
            "weight" => "required",
            "recommend" => "",
            "active" => "required",
        ]);

        request()->validate([
            "image"  => ['sometimes', 'file', 'image', 'max:200'],
        ]);

        $validatedData['updated_by'] = Auth::id() ?? 1;

        if (request()->route()->getActionMethod() == 'store') :

            $validatedData['created_by'] = Auth::id() ?? 1;

        endif;

        // Checkbox
        $validatedData['recommend'] = request()->has('recommend') ? 1 : 0 ?? 0;

        return $validatedData;
    }
}
