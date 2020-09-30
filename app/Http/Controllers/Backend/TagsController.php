<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Tags;
use Illuminate\Support\Facades\Auth;

class TagsController extends Controller
{
    const MODULE = 'tags';

    public function index(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        if ($request->filled('keyword')) :
            $tags = Tags::getDataByKeyword($request->keyword)->get();
        else :
            $tags = Tags::limit(50)->orderBy('updated_at', 'desc')->get();
        endif;

        return view('backend.tags.index', compact('tags'));
    }

    public function create()
    {
        $this->authorize(mapPermission(self::MODULE));
        $tag = new Tags;

        return view('backend.tags.create', compact('tag'));
    }

    public function store(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        $tag = Tags::create($this->validateRequest());

        return redirect(route('backend.tags.index'));
    }

    public function edit(Tags $tag)
    {
        $this->authorize(mapPermission(self::MODULE));

        return view('backend.tags.update', compact('tag'));
    }

    public function update(Request $request, Tags $tag)
    {
        $this->authorize(mapPermission(self::MODULE));
        $tag->update($this->validateRequest());

        return redirect(route('backend.tags.index'));
    }

    public function destroy(Tags $tag)
    {
        $this->authorize(mapPermission(self::MODULE));
        $tag->delete();

        return redirect(route('backend.tags.index'));
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
