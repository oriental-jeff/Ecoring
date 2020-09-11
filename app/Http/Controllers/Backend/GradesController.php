<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Grades;
use Illuminate\Support\Facades\Auth;

class GradesController extends Controller
{
    const MODULE = 'grades';

    public function index(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        if ($request->filled('keyword')) :
            $grades = Grades::getDataByKeyword($request->keyword)->get();
        else :
            $grades = Grades::limit(50)->orderBy('updated_at', 'desc')->get();
        endif;

        return view('backend.grades.index', compact('grades'));
    }

    public function create()
    {
        $this->authorize(mapPermission(self::MODULE));
        $grade = new Grades;

        return view('backend.grades.create', compact('grade'));
    }

    public function store(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        $grade = Grades::create($this->validateRequest());

        return redirect(route('backend.grades.index'));
    }

    public function edit(Grades $grade)
    {
        $this->authorize(mapPermission(self::MODULE));

        return view('backend.grades.update', compact('grade'));
    }

    public function update(Request $request, Grades $grade)
    {
        $this->authorize(mapPermission(self::MODULE));
        $grade->update($this->validateRequest());

        return redirect(route('backend.grades.index'));
    }

    public function destroy(Grades $grade)
    {
        $this->authorize(mapPermission(self::MODULE));
        $grade->delete();

        return redirect(route('backend.grades.index'));
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
