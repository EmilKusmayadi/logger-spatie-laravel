<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'show']]);
    //     $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    // }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Permission::all();
        return view('permission.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
        ]);
        $data = Permission::create(['name' => $request->input('name')]);
        return redirect('permissions')->with('data', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission = Permission::find($id);
        return view('permission.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permission::find($id);
        $roles = Role::where('name','!=','superadmin')->pluck('name', 'name')->all();
        $userRole = $permission->roles->pluck('name', 'name')->all();

        return view('permission.edit', compact('permission', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);


        $permission = Permission::find($id);
        $permission->name = $request->input('name');
        $permission->save();

        DB::table('model_has_permissions')->where('permission_id', $id)->delete();
        $permission->syncRoles([]);
        $permission->assignRole($request->input('roles'));
        return redirect()->route('permissions.index')->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table("permissions")->where('id', $id)->delete();

        return redirect()->route('permissions.index')->with('success', 'Role deleted successfully');
    }
}
