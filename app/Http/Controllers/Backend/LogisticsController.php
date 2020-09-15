<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Logistics;
use Illuminate\Support\Facades\Auth;

class LogisticsController extends Controller
{
    const MODULE = 'logistics';

    public function index(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        if ($request->filled('keyword') or $request->filled('active')) :
            $logistics = Logistics::getDataByKeyword($request)->get();
        else :
            $logistics = Logistics::limit(50)->orderBy('updated_at', 'desc')->get();
        endif;

        return view('backend.logistics.index', compact('logistics'));
    }

    public function create()
    {
        $this->authorize(mapPermission(self::MODULE));
        $logistic = new Logistics;

        return view('backend.logistics.create', compact('logistic'));
    }

    public function store(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        $logistic = Logistics::create($this->validateRequest());
        $logistic->storeImage();

        return redirect(route('backend.logistics.index'));
    }

    public function edit(Logistics $logistic)
    {
        $this->authorize(mapPermission(self::MODULE));

        return view('backend.logistics.update', compact('logistic'));
    }

    public function update(Request $request, Logistics $logistic)
    {
        $this->authorize(mapPermission(self::MODULE));
        $logistic->update($this->validateRequest());
        $logistic->storeImage();

        return redirect(route('backend.logistics.index'));
    }

    public function destroy(Logistics $logistic)
    {
        $this->authorize(mapPermission(self::MODULE));
        $logistic->delete();

        return redirect(route('backend.logistics.index'));
    }

    private function validateRequest()
    {
        $validatedData = request()->validate([
            "name_th" => "required",
            "name_en" => "required",
            "period" => "required",
            "base_price" => "required",
        ]);

        request()->validate([
            "image"  => ['sometimes', 'file', 'image', 'max:200'],
        ]);

        $validatedData['updated_by'] = Auth::id();

        if (request()->route()->getActionMethod() == 'store') :

            $validatedData['created_by'] = Auth::id();

        endif;

        return $validatedData;
    }
}
