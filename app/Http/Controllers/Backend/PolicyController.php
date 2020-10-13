<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PolicyController extends Controller
{
  const MODULE = 'policy';

  public function index()
  {
    $this->authorize(mapPermission(self::MODULE));
    $policy = Policy::find(1)->first();

    return view('backend.policy.update', compact('policy'));
  }

  public function update(Request $request, Policy $policy)
  {
    $this->authorize(mapPermission(self::MODULE));
    $policy->update($this->validateRequest());

    $message = 'บันทึกข้อมูลเรียบร้อย';
    $request->session()->flash('message', $message);
    $request->session()->flash('alert-class', 'alert-success');

    return redirect(route('backend.policy.index'));
  }

  private function validateRequest() {
    $validatedData = request()->validate([
      "title_th"               => "required",
      "title_en"               => "required",
      "description_th"        => "required",
      "description_en"        => "required",
    ]);

    $validatedData['updated_by'] = Auth::id();

    return $validatedData;
  }

}

