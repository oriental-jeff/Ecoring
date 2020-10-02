<?php
namespace App\Http\Controllers\Backend;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  const MODULE = 'user';

  public function index(Request $request)
  {
    $this->authorize(mapPermission(self::MODULE));
    $search = [];
    if ($request->filled('keyword')) :
      $users = User::getDataByKeyword(request('keyword'))
          ->ignoreSuperAdmin()
          ->get();
    else:
      $users = User::ignoreSuperAdmin()
          ->limit(50)
          ->get();
    endif;

    return view('backend.user.index', compact(['users', 'search']));
  }

  public function create()
  {
    $roles = Role::where('id', '<>', 1)->get();
    $user = new User;
    
    return view('backend.user.create', compact(['user', 'roles']));
  }

  public function store(Request $request)
  {
    $this->authorize(mapPermission(self::MODULE));
    $data = request()->validate([
      'first_name' => ['required', 'string', 'max:255'],
      'last_name' => '',
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:6', 'confirmed'],
      'department_id' => '',
    ]);
    $role_id = request()->validate([ 
      'role_id' => ['required', 'array'],
      'role_id.*' => ['required'],
    ]);
    $data['password'] = Hash::make($data['password']);
    $data['created_by'] = Auth::id();
    $data['updated_by'] = Auth::id(); 
    $user = User::create($data);
    $user->syncRoles(request('role_id'));

    $message = 'บันทึกข้อมูลเรียบร้อย';
    $request->session()->flash('message', $message);
    $request->session()->flash('alert-class', 'alert-success');

    return redirect(route('backend.user.index'));
  }

  public function edit(User $user)
  { 
    $this->authorize(mapPermission(self::MODULE));
    $roles = Role::where('id', '<>', 1)->get();

    return view('backend.user.update', compact(['user', 'roles']));
  }

  public function update(Request $request, User $user)
  {
    $this->authorize(mapPermission(self::MODULE));
    if($request->filled('password')) :
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
    $role_id = request()->validate([ 
      'role_id' => ['required', 'array'],
      'role_id.*' => ['required'],
    ]);
   
    $data['updated_by'] = Auth::id();
    $user->update($data);
    $user->syncRoles(request('role_id'));

    $message = 'แก้ไขข้อมูลเรียบร้อย';
    $request->session()->flash('message', $message);
    $request->session()->flash('alert-class', 'alert-success');

    return redirect(route('backend.user.index'));
  }

  public function destroy(User $user)
  {
    $this->authorize(mapPermission(self::MODULE));
    $user->delete();
    
    return redirect(route('backend.user.index'));
  }
}
