<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:can manage banners']);
    }
   public function datatables()
    {
     $datas = Banner::orderBy('id','desc')->get();
             //--- Integrating This Collection Into Datatables
             return Datatables::of($datas)
                                ->editColumn('image',function(Banner $data){
                                    return '<img src="'.asset($data->image).'" style="width: 100%;height: 36px;border-radius: 0px">';
                                })
                                ->editColumn('link',function(Banner $data){
                                   return '<a href="'.$data->link.'" target="_blank">'.$data->link.'</a>';
                                })
                                ->addColumn('action', function(Banner $data) {
                                    return  '<div class="dropdown">
                                              <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Actions
                                              </button>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="'.route("banners.edit",$data->id).'"><i class="mdi mdi-pen"></i> Edit</a>
                                            <a class="dropdown-item t_delete" href="javascript:void(0)" data-url="'.route("banners.destroy",$data->id).'"><i class="mdi mdi-trash-can"></i> Delete</a>
                                          </div>
                                        </div>';
                                })
                                ->rawColumns(['action','image','link'])
                                ->toJson(); //--- Returning Json Data To Client Sid
    }
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.banner.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
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
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,',
            'position'=>'required|in:top_silder,top_widgets,middle,left_side,right_side,bottom',
            'title'  =>'required',
            'content'  =>'required',
            'link'  =>'required',
        ]);

        if($request->has('image')){
            $path = '/assets/images/banner/';

            $image = $request->file('image');

            $image_name = 'banner-' . date('YmdHis') . "." . $image->getClientOriginalExtension();

            $image->move(base_path('../'.$path), $image_name);

            $banner_image = $path.$image_name;
        }else{
            $banner_image = '/assets/images/banner/no-image.jpg';
        }

        $banner = Banner::create([
            'image'=>$banner_image,
            'position'=>$request->input('position'),
            'title'=>$request->input('title'),
            'content'=>$request->input('content'),
            'link'=>$request->input('link'),
            'offer'=>$request->input('offer'),
        ]);

        return redirect()->route('banners.index')->with('success','Banner has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'image'=>'image|mimes:jpeg,png,jpg,gif,',
            'position'=>'required|in:top_silder,top_widgets,middle,left_side,right_side,bottom',
            'title'  =>'required',
            'content'  =>'required',
            'link'  =>'required',
        ]);

        $banner = Banner::findOrFail($id);

        if($request->has('image')){
            $path = '/assets/images/banner/';

            $image = $request->file('image');

            $image_name = 'banner-' . date('YmdHis') . "." . $image->getClientOriginalExtension();

            $image->move(base_path('../'.$path), $image_name);

            $banner_image = $path.$image_name;
        }else{
            $banner_image = $banner->image;
        }

        $banner->update([
            'image'=>$banner_image,
            'position'=>$request->input('position'),
            'title'=>$request->input('title'),
            'content'=>$request->input('content'),
            'link'=>$request->input('link'),
            'offer'=>$request->input('offer'),
        ]);
        return redirect()->route('banners.index')->with('success','Banner has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       $banner = Banner::findOrFail($id);
       $banner->delete();
       if ($request->ajax()) {
           return response()->json([
            'msg'=>'success',
            'success'=>'Banner has been deleted!',
        ]);
       }
        return redirect()->route('pages.index')->with('Page has been deleted!');
    }
}
