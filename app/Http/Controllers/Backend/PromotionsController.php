<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Promotions;
use Illuminate\Support\Facades\Auth;

class PromotionsController extends Controller
{
    const MODULE = 'promotions';

    public function index(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        if ($request->filled('keyword')) :
            $promotions = Promotions::getDataByKeyword($request->keyword)->get();
        else :
            $promotions = Promotions::limit(50)->orderBy('updated_at', 'desc')->get();
        endif;

        return view('backend.promotions.index', compact('promotions'));
    }

    public function create()
    {
        $this->authorize(mapPermission(self::MODULE));
        $promotion = new Promotions;

        return view('backend.promotions.create', compact('promotion'));
    }

    public function store(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        $promotion = Promotions::create($this->validateRequest());

        return redirect(route('backend.promotions.index'));
    }

    public function edit(Promotions $promotion)
    {
        $this->authorize(mapPermission(self::MODULE));

        return view('backend.promotions.update', compact('promotion'));
    }

    public function update(Request $request, Promotions $promotion)
    {
        $this->authorize(mapPermission(self::MODULE));
        $promotion->update($this->validateRequest());

        return redirect(route('backend.promotions.index'));
    }

    public function destroy(Promotions $promotion)
    {
        $this->authorize(mapPermission(self::MODULE));
        $promotion->delete();

        return redirect(route('backend.promotions.index'));
    }

    private function validateRequest()
    {
        $validatedData = request()->validate([
            "name_th" => "required",
            "name_en" => "required",
            "start_at" => "required",
            "end_at" => "required",
            "active" => "",
        ]);

        $validatedData['updated_by'] = Auth::id();

        if (request()->route()->getActionMethod() == 'store') :

            $validatedData['created_by'] = Auth::id();

        endif;

        return $validatedData;
    }
}
