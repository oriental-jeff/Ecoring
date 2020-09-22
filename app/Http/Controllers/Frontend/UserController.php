<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Facades\App\Repository\Pages;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  public function index()
  {
    $pages = Pages::get(1);

    return view('frontend.register.index', compact(['pages']));
  }

  public function create()
  {
    $user = new User;
    $pages = Pages::get(1);
    
    return view('frontend.register.index', compact(['user', 'pages']));
  }

  public function store(Request $request)
  {    
    $data = request()->validate([
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:6', 'confirmed'],
    ]);

    $data['password'] = Hash::make($data['password']);
    $data['active'] = 2;
    $data['created_by'] = 1;
    $data['updated_by'] = 1; 
    $user = User::create($data);

    $message = 'บันทึกข้อมูลเรียบร้อย';
    $request->session()->flash('message', $message);
    $request->session()->flash('alert-class', 'alert-success');

    return redirect(route('frontend.auth.login.form'));
  }

  public function edit(User $user)
  {
    return view('frontend.user.profile', compact(['user']));
  }

  public function update(Request $request, User $user)
  {
    if($request->filled('password')):
      $data = request()->validate([
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => '',
        'password' => ['string', 'min:6', 'confirmed'],
        'active' => '',
      ]);
          
      $data['password'] = Hash::make($data['password']);
     else :
      $data = request()->validate([
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => '',
        'active' => '',
      ]);
         
    endif;
   
    $data['updated_by'] = Auth::id();
    $user->update($data);

    $message = 'แก้ไขข้อมูลเรียบร้อย';
    $request->session()->flash('message', $message);
    $request->session()->flash('alert-class', 'alert-success');

    return redirect(route('frontend.user.index'));
  }

  public function destroy(User $user)
  {
    $user->delete();
    
    return redirect(route('frontend.user.index'));
  }
}
