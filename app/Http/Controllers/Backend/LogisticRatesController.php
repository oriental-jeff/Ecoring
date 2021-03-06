<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\LogisticRates;
use App\Model\Logistics;
use Illuminate\Support\Facades\Auth;

class LogisticRatesController extends Controller
{
    const MODULE = 'logistic_rates';

    public function index(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        if ($request->filled('keyword') or $request->filled('date_start') or $request->filled('date_end')) :
            $logistic_rates = LogisticRates::getDataByKeyword($request)->get();
        else :
            $logistic_rates = LogisticRates::limit(50)->orderBy('updated_at', 'desc')->get();
        endif;

        return view('backend.logistic_rates.index', compact('logistic_rates'));
    }

    public function create()
    {
        $this->authorize(mapPermission(self::MODULE));
        $logistic_rate = new LogisticRates;
        $logistics = Logistics::all();

        return view('backend.logistic_rates.create', compact(['logistic_rate', 'logistics']));
    }

    public function store(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        $logistic_rate = LogisticRates::create($this->validateRequest());

        return redirect(route('backend.logistic_rates.index'));
    }

    public function edit(LogisticRates $logistic_rate)
    {
        $this->authorize(mapPermission(self::MODULE));
        $logistics = Logistics::all();

        return view('backend.logistic_rates.update', compact(['logistic_rate', 'logistics']));
    }

    public function update(Request $request, LogisticRates $logistic_rate)
    {
        $this->authorize(mapPermission(self::MODULE));
        $logistic_rate->update($this->validateRequest());

        return redirect(route('backend.logistic_rates.index'));
    }

    public function destroy(LogisticRates $logistic_rate)
    {
        $this->authorize(mapPermission(self::MODULE));
        $logistic_rate->delete();

        return redirect(route('backend.logistic_rates.index'));
    }

    private function validateRequest()
    {
        $validatedData = request()->validate([
            "logistics_id" => "required",
            "weight_from" => "required",
            "weight_to" => "required",
            "price" => "required",
            "start_at" => "required",
            "end_at" => "",
        ]);

        $validatedData['updated_by'] = Auth::id();

        if (request()->route()->getActionMethod() == 'store') :

            $validatedData['created_by'] = Auth::id();

        endif;

        return $validatedData;
    }
}
