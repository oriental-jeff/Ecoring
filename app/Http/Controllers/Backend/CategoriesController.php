<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Categories;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    const MODULE = 'categories';

    public function index(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        if ($request->filled('keyword')) :
            $categories = Categories::getDataByKeyword($request->keyword)->get();
        else :
            $categories = Categories::limit(50)->orderBy('updated_at', 'desc')->get();
        endif;

        return view('backend.categories.index', compact('categories'));
    }

    public function create()
    {
        $this->authorize(mapPermission(self::MODULE));
        $category = new Categories;

        return view('backend.categories.create', compact('category'));
    }

    public function store(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        $category = Categories::create($this->validateRequest());
        $category->storeImage();

        return redirect(route('backend.categories.index'));
    }

    public function edit(Categories $category)
    {
        $this->authorize(mapPermission(self::MODULE));

        return view('backend.categories.update', compact('category'));
    }

    public function update(Request $request, Categories $category)
    {
        $this->authorize(mapPermission(self::MODULE));
        $category->update($this->validateRequest());
        $category->storeImage();

        return redirect(route('backend.categories.index'));
    }

    public function destroy(Categories $category)
    {
        $this->authorize(mapPermission(self::MODULE));
        $category->delete();

        return redirect(route('backend.categories.index'));
    }

    private function validateRequest()
    {
        $validatedData = request()->validate([
            "name_th" => "required",
            "name_en" => "required",
        ]);

        request()->validate([
            "image"  => ['sometimes', 'file', 'image', 'max:180'],
        ]);

        $validatedData['updated_by'] = Auth::id();

        if (request()->route()->getActionMethod() == 'store') :

            $validatedData['created_by'] = Auth::id();

        endif;

        return $validatedData;
    }
}
