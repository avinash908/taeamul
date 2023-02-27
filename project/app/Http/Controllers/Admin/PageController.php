<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Str;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:can manage pages']);
    }
   public function datatables()
    {
     $datas = Page::where('type','=',null)->orderBy('id','desc')->get();
             //--- Integrating This Collection Into Datatables
             return Datatables::of($datas)
                                ->editColumn('slug',function (Page $page)
                                {
                                   return '<a href="'.url('/page',$page->slug).'" target="_blank">'.url('/page',$page->slug).'</a>';
                                })
                                ->addColumn('action', function(Page $data) {
                                    return  '<div class="dropdown">
                                              <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Actions
                                              </button>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="'.route("pages.edit",$data->id).'"><i class="mdi mdi-pen"></i> Edit</a>
                                            <a class="dropdown-item t_delete" href="javascript:void(0)" data-url="'.route("pages.destroy",$data->id).'"><i class="mdi mdi-trash-can"></i> Delete</a>
                                          </div>
                                        </div>';
                                })
                                ->rawColumns(['slug','action'])
                                ->toJson(); //--- Returning Json Data To Client Sid
    }
    public function index()
    {
        $pages = Page::where('type','=',null)->latest()->get();
        return view('admin.page.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.create');
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
            'title'=> 'required|max:255',
            'slug'=>    'required|unique:pages,slug',
            'content'=> 'required',
        ]);

        $page = Page::create([
            'title'=>$request->input('title'),
            'slug'=>Str::slug($request->input('slug')),
            'content'=>$request->input('content'),
        ]);

         if (!empty($request->seo_input)) {
            $page->seo()->create([
                'title' => $request->seo_title,
                'meta_tags' => $request->meta_tags,
                'meta_description' => $request->meta_description,
            ]);
        }

        return redirect()->back()->with('Page has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.page.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=> 'required|max:255',
            'slug'=>    'required',
            'content'=> 'required',
        ]);

        $page = Page::findOrFail($id);

        $page->update([
            'title'=>$request->input('title'),
            'slug'=> Str::slug($request->input('slug')),
            'content'=>$request->input('content'),
        ]);

        if (!empty($request->seo_input)) {
           if ($page->seo) {
               $page->seo()->update([
                  'title' => $request->seo_title,
                  'meta_tags' => $request->meta_tags,
                  'meta_description' => $request->meta_description,
               ]);
            }else{
              $page->seo()->create([
                  'title' => $request->seo_title,
                  'meta_tags' => $request->meta_tags,
                  'meta_description' => $request->meta_description,
              ]);
            }
        }

        return redirect()->route('pages.index')->with('Page has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       $page = Page::findOrFail($id);
       $page->delete();
       if ($request->ajax()) {
           return response()->json([
            'msg'=>'success',
            'success'=>'Page has been deleted!',
        ]);
       }
        return redirect()->route('pages.index')->with('Page has been deleted!');
    }
}
