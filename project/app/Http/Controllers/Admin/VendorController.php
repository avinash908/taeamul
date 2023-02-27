<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\User;
use DataTables;

class VendorController extends Controller
{
  public function __construct()
    {
        $this->middleware(['permission:can manage vendors']);
    }
	public function datatables()
    {
             $datas = User::where('is_vendor','=',1)->orderBy('id','desc')->get();
             return Datatables::of($datas)
              ->addColumn('shop_name', function(User $data) {
                                return $data->shop->shop_name;
                            })
              ->addColumn('shop_number', function(User $data) {
                                return $data->shop->shop_number;
                            })
             ->addColumn('action', function(User $data) {
                                return '<div class="dropdown">
                          <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <h6 class="dropdown-header"></h6>
                            <a class="dropdown-item" href="'.route("admin.vendors.show",$data->id).'"><i class="mdi mdi-eye"></i> Details</a>
                            <a class="dropdown-item" href="'.route("admin.vendors.edit",$data->id).'"><i class="mdi mdi-pencil"></i> Edit</a>'.
                            // <a class="dropdown-item t_delete" data-url="'.route("admin.vendors.destroy",$data->id).'" href="javascript:void(0)"><i class="mdi mdi-delete"></i> Delete</a>
                          '</div>
                        </div>';
                            })
                            ->addColumn('user_status', function(User $data) {
                                 if($data->status != 1){
                                return '<div class="dropdown">
                                      <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Unverified
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item badge t_active" data-url="'.route("admin.vendors.verify",$data->id).'" href="javascript:void(0)"><i class="mdi mdi-eye"></i> Verify</a>
                                      </div>
                                    </div>';
                                }else{

                                    return '<div class="dropdown">
                                      <button type="button" class="badge badge-success dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Verified
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item badge t_deactive" data-url="'.route("admin.vendors.unverify",$data->id).'" href="javascript:void(0)"><i class="mdi mdi-eye-off"></i> Unverify</a>
                                      </div>
                                    </div>';
                                }
                            })
                    ->rawColumns(['action','user_status'])
                ->toJson();
    }
    public function index()
    {
    	$vendors = User::where('is_vendor','=',1)->get();
        return view('admin.vendor.index',compact('vendors'));
    }
     public function show($id)
    {
      $user = User::findOrFail($id);
      return view('admin.vendor.show',compact('user'));
    }
    public function edit($id)
    {
      $user = User::findOrFail($id);
      return view('admin.vendor.edit',compact('user'));
    }
    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $userdata = $request->only(['name','email','phone','address','city','state','zip']);
        $shopdata = $request->except(['name','email','phone','address','city','state','zip','pic','_token']);

        if ($file = $request->file('pic')) 
        {
          $files_path = 'assets/images/users/';
          $pic = time().'.'.$file->getClientOriginalExtension();
          $file->move(base_path('../'.$files_path),$pic);

          $user->image()->update(['url'=>$files_path .'/'. $pic]); 
        }

          $files_path = 'assets/files/';
        // upload national id copy

        if ($file = $request->file('national_copy')) 
        {              
            $file_n = time().$file->getClientOriginalName();
            $file->move(base_path('../'.$files_path),$file_n);            
            $shopdata['national_copy'] = $files_path .'/'. $file_n;
        } 

        // upload comercial registration copy

        if ($file = $request->file('comercial_reg_copy')) 
        {              
            $file_r = time().$file->getClientOriginalName();
            $file->move(base_path('../'.$files_path),$file_r);            
            $shopdata['comercial_reg_copy'] = $files_path .'/'. $file_r;
        }

        $user->update($userdata);
        $user->shop()->update($shopdata);

       return redirect()->route('admin.vendors.show',$user->id)->with('success','Vendor Profile has been updated!');
    }

    public function destroy(Request $request, $id)
    {
       $user = User::findOrFail($id)->delete();
       if ($request->ajax()) {
            return response()->json([
                'msg'     => 'success',
                'success' => 'Vendor has been Deleted!'
            ]);
        }
       return redirect()->route('admin.vendors')->with('success','Vendor has been deleted!');
    }
    public function unverify($id)
    {
      $user = User::findOrFail($id);
      $user->status = 0;
      $user->save();
      return response()->json([
          'msg'     => 'success',
          'success' => 'Vendor has been Unverifed!'
      ]);
    }
    public function verify($id)
    {
      $user = User::findOrFail($id);
      $user->status = 1;
      $user->save();
      return response()->json([
          'msg'     => 'success',
          'success' => 'Vendor has been Verifed!'
      ]);
    }
}