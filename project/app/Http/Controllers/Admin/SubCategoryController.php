<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Category;
use App\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:can manage categories']);
    }

    public function datatables()
    {
        $datas = SubCategory::orderBy('id','desc')->get();
             return Datatables::of($datas)
                            ->addColumn('attributes', function(SubCategory $data) {
                                $buttons = '<div class="btn btn-group">';
                                $buttons .= '<a href="'.route("admin.attributes.create",$data->id).'?type=subcategory" class="btn btn-primary">
                                  <i class="mdi mdi-plus"></i>
                              Create
                            </a>';

                              if ($data->attributes()->count() > 0) {
                                  $buttons .= '<a href="' . route('admin.attributes.manage', $data->id) .'?type=subcategory' . '" class="btn btn-dark"> <i class="mdi mdi-pencil"></i> Manage</a>';
                                }
                                $buttons .= '</div>';
                                return $buttons;
                            })
                            ->addColumn('status', function(SubCategory $data) {
                                if($data->status != 1){
                                return '<div class="dropdown">
                                      <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Deactivated
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item badge t_active" data-url="'.route("admin.subcategory.active",$data->id).'" href="javascript:void(0)"><i class="mdi mdi-eye"></i> Activate</a>
                                      </div>
                                    </div>';
                                }else{

                                    return '<div class="dropdown">
                                      <button type="button" class="badge badge-success dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Activated
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item badge t_deactive" data-url="'.route("admin.subcategory.deactive",$data->id).'" href="javascript:void(0)"><i class="mdi mdi-eye-off"></i> Deactivate</a>
                                      </div>
                                    </div>';
                                };
                            })
                            ->addColumn('category', function(SubCategory $data) {
                                
                                return ucwords($data->category->name);
                            })
                            ->addColumn('action', function(SubCategory $data) {
                                return '<div class="dropdown">
                          <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <h6 class="dropdown-header"></h6>
                            <a class="dropdown-item" href="'.route("subcategories.edit",$data->id).'"><i class="mdi mdi-pencil"></i> Edit</a>
                            <a class="dropdown-item t_delete" href="javascript::void(0)" data-url="'.route("subcategories.destroy",$data->id).'"><i class="mdi mdi-delete"></i> Delete</a>
                          </div>
                        </div>';
                            })
                    ->rawColumns(['attributes','action','status'])
                ->toJson();
    }
    public function index(Request $request)
    {
        return view('admin.subcategory.index');
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategory.create',compact('categories'));
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
            'name'=>'required|max:255',
            'slug'=>'required|unique:sub_categories,slug|max:255',
            'category'=>'required|integer',
        ]);

        $SubCategory = new SubCategory();
        $input = $request->all();

        $category = Category::findOrFail($request->input('category'));

        $input['category_id'] = $category->id;
        $input['slug'] = Str::slug($request->input('slug'));

        $SubCategory->fill($input)->save();

         if (!empty($request->seo_input)) {
            $SubCategory->seo()->create([
                'title' => $request->seo_title,
                'meta_tags' => $request->meta_tags,
                'meta_description' => $request->meta_description,
            ]);
        }

        return redirect()->back()->with('success','Sub Category Has Been Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubCategory  $SubCategory
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // return view('admin.SubCategory.update');
    }

    public function getChildcatOptions($id)
    {
      $cat = SubCategory::findOrFail($id);
      $childcategories = view('admin.subcategory.ajax.childoptions',compact('cat'))->render();
      $subcategory_attributes = view('admin.subcategory.ajax.attributes',compact('cat'))->render();
      return response()->json(['childcategories'=>$childcategories, 'subcategory_attributes' => $subcategory_attributes]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubCategory  $SubCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subcategory)
    {
        $categories = Category::all();
        $subcategory = SubCategory::findOrFail($subcategory->id); 
        return view('admin.subcategory.edit',compact('subcategory','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubCategory  $SubCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name'=>'required|max:255',
            'slug'=>'required|max:255',
            'category'=>'required|integer',
        ]);

        $input = $request->all();

        $category = Category::findOrFail($request->input('category'));

        $input['category_id'] = $category->id;
        $input['slug'] = Str::slug($request->input('slug'));

        $subcategory = SubCategory::findOrFail($id);
        $subcategory->update($input);

        if (!empty($request->seo_input)) {
           if ($subcategory->seo) {
               $subcategory->seo()->update([
                  'title' => $request->seo_title,
                  'meta_tags' => $request->meta_tags,
                  'meta_description' => $request->meta_description,
               ]);
            }else{
              $subcategory->seo()->create([
                  'title' => $request->seo_title,
                  'meta_tags' => $request->meta_tags,
                  'meta_description' => $request->meta_description,
              ]);
            }
        }

        return redirect()->route('subcategories.index')->with('success','Sub Category has been updated!');
    }

    public function active($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->status = 1;
        $subcategory->save();
        return response()->json(['success'=>'Sub Category has been activated!']);
    }

    public function deactive($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->status = 0;
        $subcategory->save();
        return response()->json(['success'=>'Sub Category has been deactivated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubCategory  $SubCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $data = SubCategory::findOrFail($id);

        if($data->attributes->count() > 0)
        {
        //--- Redirect Section
        return response()->json([
            'msg'=> 'danger',
            'danger'=> 'This Sub Category has Attributes Remove its Attributes first !',
        ]);
        //--- Redirect Section Ends
        }

        if($data->childs->count()>0)
        {
        //--- Redirect Section
        return response()->json([
            'msg'=> 'danger',
            'danger'=> 'This Sub Category has Child Categories Remove its Child Categories first !',
        ]);
        //--- Redirect Section Ends
        }
        if($data->products->count()>0)
        {
        //--- Redirect Section
        return response()->json([
            'msg'=> 'danger',
            'danger'=> 'This Sub Category has Products Remove its Products first !',
        ]);
        //--- Redirect Section Ends
        }

        $data->delete();

        return response()->json([
            'msg'     => 'success',
            'success' => 'Sub Category has been Deleted!'
        ]);
    }
}
