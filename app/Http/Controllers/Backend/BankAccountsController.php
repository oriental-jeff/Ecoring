<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\BankAccounts;
use Illuminate\Support\Facades\Auth;

class BankAccountsController extends Controller
{
    const MODULE = 'bankaccounts';

    public function index(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        if ($request->filled('keyword')) :
            $bankaccounts = BankAccounts::getDataByKeyword($request->keyword)->get();
        else :
            $bankaccounts = BankAccounts::limit(50)->orderBy('updated_at', 'desc')->get();
        endif;

        return view('backend.bankaccounts.index', compact('bankaccounts'));
    }

    public function create()
    {
        $this->authorize(mapPermission(self::MODULE));
        $bankaccount = new BankAccounts;

        return view('backend.bankaccounts.create', compact('bankaccount'));
    }

    public function store(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        $bankaccount = BankAccounts::create($this->validateRequest());
        $bankaccount->storeImage();

        return redirect(route('backend.bankaccounts.index'));
    }

    public function edit(BankAccounts $bankaccount)
    {
        $this->authorize(mapPermission(self::MODULE));

        return view('backend.bankaccounts.update', compact('bankaccount'));
    }

    public function update(Request $request, BankAccounts $bankaccount)
    {
        $this->authorize(mapPermission(self::MODULE));
        $bankaccount->update($this->validateRequest());
        $bankaccount->storeImage();

        return redirect(route('backend.bankaccounts.index'));
    }

    public function destroy(BankAccounts $bankaccount)
    {
        $this->authorize(mapPermission(self::MODULE));
        $bankaccount->delete();

        return redirect(route('backend.bankaccounts.index'));
    }

    private function validateRequest()
    {
        $validatedData = request()->validate([
            "bank_name_th" => "required",
            "bank_name_en" => "required",
            "acc_no" => "required",
            "acc_name" => "required",
            "linkurl" => "",
            "active" => "",
        ]);

        request()->validate([
            "image"  => ['sometimes', 'file', 'image', 'max:40'],
            "image_qrcode"  => ['sometimes', 'file', 'image', 'max:40'],
        ]);

        $validatedData['updated_by'] = Auth::id();

        if (request()->route()->getActionMethod() == 'store') :

            $validatedData['created_by'] = Auth::id();

        endif;

        return $validatedData;
    }
}
