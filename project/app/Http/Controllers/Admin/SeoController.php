<?php

namespace App\Http\Controllers\Admin;

use App\Seo;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:can manage seo']);
    }
   public function datatables()
    {
     $datas = Seo::orderBy('id','desc')->get();
             //--- Integrating This Collection Into Datatables
             return Datatables::of($datas)
                                ->editColumn('url',function(Seo $data){
                                   return $data->seoble->slug ?? 'page not exist...';
                                })
                                ->addColumn('action', function(Seo $data) {
                                    return  '<div class="dropdown">
                                              <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Actions
                                              </button>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="'.route("admin.seo.edit",$data->id).'"><i class="mdi mdi-pen"></i> Edit</a>
                                          </div>
                                        </div>';
                                })
                                ->rawColumns(['action','url'])
                                ->toJson(); //--- Returning Json Data To Client Sid
    }
    public function index()
    {
        return view('admin.seo.index');
    }

    public function edit($id)
    {
        $seo = Seo::findOrFail($id);
        return view('admin.seo.edit',compact('seo'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'title'  =>'max:255',
        ]);

        $seo = Seo::findOrFail($id);

        $seo->update([
            'title'=>$request->input('seo_title'),
            'meta_tags'=>$request->input('meta_tags'),
            'meta_description'=>$request->input('meta_description'),
        ]);
        return redirect()->route('admin.seo.edit',$seo->id)->with('success','Seo has been updated!');
    }
}