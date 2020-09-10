<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
  const MODULE = 'role';

  public function index(Request $request)
  {
    $this->authorize(mapPermission(self::MODULE));
    if ($request->filled('keyword')):
        $roles = Role::where('name', 'like', '%' . request('keyword') . '%')->get();
    else:
        $roles = Role::all();
    endif;

    return view('backend.role.index', compact('roles'));
  }

  public function search(Request $request)
  {
    $this->authorize(mapPermission(self::MODULE));
    $roles = [];
    if($request->filled('keyword')):
      $roles = Role::where('name', 'like', '%'.request('keyword').'%')->get();
    else:
      $roles = Role::all();
    endif;

    return view('backend.role.show', compact('roles'));
  }

  public function create()
  {
    $this->authorize(mapPermission(self::MODULE));
    $role = new Role;
    $permission_parents = Permission::where('name', 'like', 'manage%')->get();
    $permission_childen = Permission::where('name', 'not like', 'manage%')->get()->toArray();
    foreach ($permission_parents as $key => $parent) :
      $module = str_replace('manage ', '', $parent['name']);
      foreach ($permission_childen as  $child) :
        if (!preg_match('/manage/', $child['name'])):
          if(preg_match("/$module/", $child['name'])):
            $childen[] =  $child;
          endif;
        endif;
      endforeach;

      $permissions[] = [
        'name' => $parent['name'],
        $key   => $childen,
        'id'   => $parent['id'],
      ];

      unset($childen);
    endforeach;

    return view('backend.role.create', compact(['permissions', 'role']));
  }

  public function store()
  {
    $this->authorize(mapPermission(self::MODULE));
    $data = request()->validate([
      'name'       => ['required', 'unique:roles'],
      'permission' => 'required',
    ]);

    $role = Role::create(['name' => request('name')]);
    $permissions = explode(',', request('permission'));
    $role->syncPermissions($permissions);

    $message = 'บันทึกข้อมูลเรียบร้อย';
    $request->session()->flash('message', $message);
    $request->session()->flash('alert-class', 'alert-success');

    return redirect(route('backend.role.index'));
  }

  public function edit(Role $role)
  {
    $this->authorize(mapPermission(self::MODULE));
    $role_permissions = Role::findByName($role->name)->permissions()->get()->pluck('name')->toArray();
    $permission_parents = Permission::where('name', 'like', 'manage%')->get();
    $permission_childen = Permission::where('name', 'not like', 'manage%')->get()->toArray();
    foreach ($permission_parents as $key => $parents) :
      $module = str_replace('manage ', '', $parents['name']);
      foreach ($permission_childen as  $child) :
        if (!preg_match('/manage/', $child['name'])):
          if(preg_match("/$module/", $child['name'])):
            $childen[] =  $child;
          endif;
        endif;
      endforeach;

      $permissions[] = [
        'name' => $parents['name'],
        $key   => $childen,
        'id'   => $parents['id'],
      ];

      unset($childen);
    endforeach;

    return view('backend.role.update', compact(['role', 'permissions', 'role_permissions']));
  }

  public function update(Request $request, Role $role)
  {
    $this->authorize(mapPermission(self::MODULE));
    $data = request()->validate([
      'name'       => ['required', Rule::unique('roles')->ignore($role->id)],
      'permission' => 'required',
    ]);

    $role->name = request('name');
    $role->save();
    $permissions = explode(',', request('permission'));
    $role->syncPermissions($permissions);

    $message = 'แก้ไขข้อมูลเรียบร้อย';
    $request->session()->flash('message', $message);
    $request->session()->flash('alert-class', 'alert-success');

    return redirect(route('backend.role.index'));
  }

  public function destroy(Role $role)
  {

  }

}

