<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Transactions;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    const MODULE = 'transactions';

    public function index(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        if ($request->filled('keyword')) :
            $transactions = Transactions::getDataByKeyword($request->keyword)->get();
        else :
            $transactions = Transactions::limit(50)->orderBy('updated_at', 'desc')->get();
        endif;

        return view('backend.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $this->authorize(mapPermission(self::MODULE));
        $transaction = new Transactions;

        return view('backend.transactions.create', compact('transaction'));
    }

    public function store(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        $transaction = Transactions::create($this->validateRequest());

        return redirect(route('backend.transactions.index'));
    }

    public function edit(Transactions $transaction)
    {
        $this->authorize(mapPermission(self::MODULE));

        return view('backend.transactions.update', compact('transaction'));
    }

    public function update(Request $request, Transactions $transaction)
    {
        $this->authorize(mapPermission(self::MODULE));
        $transaction->update($this->validateRequest());

        return redirect(route('backend.transactions.index'));
    }

    public function destroy(Transactions $transaction)
    {
        $this->authorize(mapPermission(self::MODULE));
        $transaction->delete();

        return redirect(route('backend.transactions.index'));
    }

    private function validateRequest()
    {
        $validatedData = request()->validate([
            "name_th" => "required",
            "name_en" => "required",
        ]);

        $validatedData['updated_by'] = Auth::id();

        if (request()->route()->getActionMethod() == 'store') :

            $validatedData['created_by'] = Auth::id();

        endif;

        return $validatedData;
    }
}
