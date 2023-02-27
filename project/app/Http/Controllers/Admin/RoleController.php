<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin']);
    }
    public function datatables()
    {
     $datas = Role::orderBy('id','desc')->get();
             //--- Integrating This Collection Into Datatables
             return Datatables::of($datas)
                                ->addColumn('permissions',function(Role $data){
                                    $permissions = '';
                                    foreach ($data->permissions as $perm) {
                                        $permissions .= '<span>'.$perm->name. '</span>, ';
                                    }
                                    return $permissions;
                                })
                                ->addColumn('action', function(Role $data) {
                                    return  '<div class="dropdown">
                                              <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Actions
                                              </button>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="'.route("roles.edit",$data->id).'"><i class="mdi mdi-pen"></i> Edit</a>
                                            <a class="dropdown-item t_delete" href="javascript:void(0)" data-url="'.route("roles.destroy",$data->id).'"><i class="mdi mdi-trash-can"></i> Delete</a>
                                          </div>
                                        </div>';
                                })
                                ->rawColumns(['action','permissions'])
                                ->toJson(); //--- Returning Json Data To Client Sid
    }

    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
       return view('admin.role.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_name'   =>  'required|unique:roles,name|max:255',
            'permissions'   =>  'required',
        ]);

        $role = Role::create([
            'name'          =>  $request->role_name,
            'guard_name'    =>  'admin',
        ]);

        $role->syncPermissions($request->permissions);

        return redirect()->back()->with('success','Role has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('admin.role.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'role_name'   =>  'required|max:255',
            'permissions'   =>  'required',
        ]);

        $role = Role::findOrFail($id);
        $role->update(['name'=>$request->role_name]);

        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success','Role has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $role = Role::findOrFail($id)->delete();
        if ($request->ajax()) {
            return response()->json([
                'msg'=>'success',
                'success'=>'Role has been deleted!',
            ]);
        }
        return redirect()->route('roles.index')->with('success','Role has been deleted!');
    }
}