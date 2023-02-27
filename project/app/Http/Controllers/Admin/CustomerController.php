<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\User;
use DataTables;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:can manage customers']);
    }
	public function datatables()
    {
             $datas = User::where('is_vendor','!=',1)->orderBy('id','desc')->get();
             return Datatables::of($datas)
                            ->addColumn('action', function(User $data) {
                                return '<div class="dropdown">
                          <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <h6 class="dropdown-header"></h6>
                            <a class="dropdown-item" href="'.route("admin.customers.show",$data->id).'"><i class="mdi mdi-eye"></i> Details</a>
                            <a class="dropdown-item" href="'.route("admin.customers.edit",$data->id).'"><i class="mdi mdi-pencil"></i> Edit</a>'.
                            // <a class="dropdown-item t_delete" data-url="'.route("admin.customers.destroy",$data->id).'" href="javascript:void(0)"><i class="mdi mdi-delete"></i> Delete</a>
                          '</div>
                        </div>';
                            })
                            ->addColumn('user_status', function(User $data) {
                                 if($data->status != 1){
                                return '<div class="dropdown">
                                      <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Blocked
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item badge t_active" data-url="'.route("admin.customers.unblock",$data->id).'" href="javascript:void(0)"><i class="mdi mdi-eye"></i> Unblock</a>
                                      </div>
                                    </div>';
                                }else{

                                    return '<div class="dropdown">
                                      <button type="button" class="badge badge-success dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Unblocked
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item badge t_deactive" data-url="'.route("admin.customers.block",$data->id).'" href="javascript:void(0)"><i class="mdi mdi-eye-off"></i> Block</a>
                                      </div>
                                    </div>';
                                }
                            })
                    ->rawColumns(['action','user_status'])
                ->toJson();
    }
    public function index()
    {
    	$customers = User::where('is_vendor','!=',1)->get();
      return view('admin.customer.index',compact('customers'));
    }
    public function show($id)
    {
      $user = User::findOrFail($id);
      return view('admin.customer.show',compact('user'));
    }
    public function edit($id)
    {
      $user = User::findOrFail($id);
      return view('admin.customer.edit',compact('user'));
    }
    public function update(Request $request, $id)
    {
       $user = User::findOrFail($id);
       $user->update($request->all());
       $files_path = 'assets/files/';
        if ($file = $request->file('pic')) 
        {
          $files_path = 'assets/images/users/';
          $pic = time().'.'.$file->getClientOriginalExtension();
          $file->move(base_path('../'.$files_path),$pic);

          $user->image()->update(['url'=>$files_path .'/'. $pic]); 
        } 
       return redirect()->route('admin.customers.show',$user->id)->with('success','Customer Profile has been updated!');
    }
    public function destroy(Request $request, $id)
    {
       $user = User::findOrFail($id)->delete();
       if ($request->ajax()) {
            return response()->json([
                'msg'     => 'success',
                'success' => 'Customer has been Deleted!'
            ]);
        }
       return redirect()->route('admin.customers')->with('success','Customer has been deleted!');
    }
    public function block($id)
    {
      $user = User::findOrFail($id);
      $user->status = 0;
      $user->save();
      return response()->json([
          'msg'     => 'success',
          'success' => 'Customer has been Blocked!'
      ]);
    }
    public function unblock($id)
    {
      $user = User::findOrFail($id);
      $user->status = 1;
      $user->save();
      return response()->json([
          'msg'     => 'success',
          'success' => 'Customer has been Unblocked!'
      ]);
    }
}
