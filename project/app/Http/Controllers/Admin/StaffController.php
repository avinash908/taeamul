<?php
namespace App\Http\Controllers\Admin;

use Auth;
use Hash;
use App\Admin;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin']);
    }
    public function datatables()
    {
        $role = ['admin'];

        $datas = Admin::with('roles')->whereHas('roles', function ( $query ) use ( $role ) {
         $query->where( 'name', '!=', $role ); 
        })->get();
             //--- Integrating This Collection Into Datatables
             return Datatables::of($datas)
                                ->addColumn('role',function(Admin $data){
                                    $role_names = '';
                                    $roles = $data->getRoleNames();
                                    foreach ($roles as $rn) {
                                       $role_names .= ' '. ucfirst($rn). ' ';
                                    }
                                    return $role_names;
                                })
                                ->addColumn('action', function(Admin $data) {
                                    return  '<div class="dropdown">
                                              <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Actions
                                              </button>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="'.route("staffs.show",$data->id).'"><i class="mdi mdi-account"></i> Profile</a>
                                            <a class="dropdown-item" href="'.route("staffs.edit",$data->id).'"><i class="mdi mdi-pen"></i> Edit</a>
                                            <a class="dropdown-item t_delete" href="javascript:void(0)" data-url="'.route("staffs.destroy",$data->id).'"><i class="mdi mdi-trash-can"></i> Delete</a>
                                          </div>
                                        </div>';
                                })
                                ->rawColumns(['action','role'])
                                ->toJson(); //--- Returning Json Data To Client Sid
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        return view('admin.staff.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.staff.create',compact('roles'));
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
            'name'=> 'required|max:255',
            'email'=> 'required|email|max:255',
            'phone'=> 'required|max:255',
            'role'=> 'required',
            'password'=> 'required|min:8',
        ]);

        $input = $request->all();

        if($request->has('image')){

            $path = '/assets/admin/images/';

            $image = $request->file('image');

            $image_name = 'avatar-' . date('YmdHis') . "." . $image->getClientOriginalExtension();

            $image->move(base_path('../'.$path), $image_name);

            $input['avatar'] = $path.$image_name;

        }else{
            $input['avatar'] = 'assets/admin/images/avatar.png';
        }

        $role  = Role::findOrFail($request->role);

        $input['password'] = Hash::make($request->password);

        $user = Admin::create($input);

        $user->assignRole($role->name);

        return redirect()->route('staffs.index')->with('success','New Member Has Been Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Admin::findOrFail($id);
        return view('admin.staff.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $user = Admin::findOrFail($id);
        return view('admin.staff.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name'=> 'required|max:255',
            'email'=> 'required|email|max:255',
            'phone'=> 'required|max:255',
            'role'=> 'required',
        ]);

        $user = Admin::findOrFail($id);

        $input = $request->all();

        if($request->has('image')){

            $path = '/assets/admin/images/';

            $image = $request->file('image');

            $image_name = 'avatar-' . date('YmdHis') . "." . $image->getClientOriginalExtension();

            $image->move(base_path('../'.$path), $image_name);

            $input['avatar'] = $path.$image_name;

        }
        if ($request->has('password')) {
            $input['password'] = Hash::make($request->password);
        }

        $role  = Role::findOrFail($request->role);

        $user->fill($input)->save();

        $user->syncRoles([$role->name]);

        return redirect()->route('staffs.index')->with('success','Staff has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $role = Admin::findOrFail($id)->delete();
        if ($request->ajax()) {
            return response()->json([
                'msg'=>'success',
                'success'=>'Member has been removed!',
            ]);
        }
        return redirect()->route('staffs.index')->with('success','Member has been removed!');
    }
}