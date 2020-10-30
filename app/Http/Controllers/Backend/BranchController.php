<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Branch;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
  const MODULE = 'branch';

  public function index(Request $request)
  {
    $this->authorize(mapPermission(self::MODULE));
    if ($request->filled('keyword')):
      $branchs = Branch::getDataByKeyword($request->keyword)->get();
    else:
      $branchs = Branch::limit(50)->get();
    endif;

    return view('backend.branch.index', compact('branchs'));
  }

  public function search(Request $request) {
    $this->authorize(mapPermission(self::MODULE));
    if ($request->filled('keyword')):
      $branchs = Branch::getDataByKeyword($request->keyword)->get();
    else:
      $branchs = Branch::all();
    endif;

    return view('backend.branch.show', compact('branchs'));
  }

  public function create() {
    $this->authorize(mapPermission(self::MODULE));
    $branch = new Branch;

    return view('backend.branch.create', compact('branch'));

  }

  public function store(Request $request) {
    $this->authorize(mapPermission(self::MODULE));
    $branch = Branch::create($this->validateRequest());
    $branch->storeImage();

    return redirect(route('backend.branch.index'));
  }

  public function edit(Branch $branch) {
    $this->authorize(mapPermission(self::MODULE));

    return view('backend.branch.update', compact('branch'));
  }

  public function update(Request $request, Branch $branch) {
    $this->authorize(mapPermission(self::MODULE));
    $branch->update($this->validateRequest());
    $branch->storeImage();

    return redirect(route('backend.branch.index'));
  }

  public function destroy(Branch $branch) {
    $this->authorize(mapPermission(self::MODULE));
    $branch->delete();

    return redirect(route('backend.branch.index'));
  }

  private function validateRequest() {
    $validatedData = request()->validate([
      "name_th"   => "required",
      "name_en"   => "required",
      "address_th"   => "required",
      "address_en"   => "required",
      "telephone"    => "required",
      "office_hours"    => "required",
      "description_th" => "",
      "description_en" => "",
      "active" => "",
    ]);

    request()->validate([
      "image"  => ['sometimes', 'file','image','max:5000'],
    ]);

    $validatedData['updated_by'] = Auth::id();
    if(request()->route()->getActionMethod() == 'store') :
      $validatedData['created_by'] = Auth::id();
    endif;

    return $validatedData;
  }

}

