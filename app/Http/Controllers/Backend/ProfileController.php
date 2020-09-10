<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;

class ProfileController extends Controller
{

  public function index()
  {
    $user = Auth::user();
    
    return view('backend.profile.update', compact('user'));
  }

  public function update(Request $request)
  {
    $data = request()->validate([
      'old_password' => ['required', new MatchOldPassword],
      'password' => ['required', 'string', 'min:6', 'confirmed'],
    ]);
    //$new['password'] = Hash::make($data['password']);
    //dd($user);
    User::find(Auth::id())->update(['password'=> Hash::make(request('password'))]);

    $message = 'แก้ไขข้อมูลเรียบร้อย';
    $request->session()->flash('message', $message);
    $request->session()->flash('alert-class', 'alert-success');

    return redirect(route('backend.profile.index'));
  }
}

