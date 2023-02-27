<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Category;
use App\SubCategory;
use App\ChildCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChildCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:can manage categories']);
    }
   public function datatables()
    {
        $datas = ChildCategory::orderBy('id','desc')->get();
             return Datatables::of($datas)
                           ->addColumn('attributes', function(ChildCategory $data) {
                                $buttons = '<div class="btn btn-group">';
                                $buttons .= '<a href="'.route("admin.attributes.create",$data->id).'?type=childcategory" class="btn btn-primary">
                                  <i class="mdi mdi-plus"></i>
                              Create
                            </a>';

                              if ($data->attributes()->count() > 0) {
                                  $buttons .= '<a href="' . route('admin.attributes.manage', $data->id) .'?type=childcategory' . '" class="btn btn-dark"> <i class="mdi mdi-pencil"></i> Manage</a>';
                                }
                                $buttons .= '</div>';
                                return $buttons;
                            })->addColumn('category', function(ChildCategory $data) {
                                
                                return ucwords($data->subcategory->category->name);
                                
                            })->addColumn('sub_category', function(ChildCategory $data) {
                                
                                return ucwords($data->subcategory->name);
                            })
                            ->addColumn('status', function(ChildCategory $data) {
                                if($data->status != 1){
                                return '<div class="dropdown">
                                      <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Deactivated
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item badge t_active" data-url="'.route("admin.childcategory.active",$data->id).'" href="javascript:void(0)"><i class="mdi mdi-eye"></i> Activate</a>
                                      </div>
                                    </div>';
                                }else{

                                    return '<div class="dropdown">
                                      <button type="button" class="badge badge-success dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Activated
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item badge t_deactive" data-url="'.route("admin.childcategory.deactive",$data->id).'" href="javascript:void(0)"><i class="mdi mdi-eye-off"></i> Deactivate</a>
                                      </div>
                                    </div>';
                                };
                            })
                            ->addColumn('action', function(ChildCategory $data) {
                                return '<div class="dropdown">
                          <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <h6 class="dropdown-header"></h6>
                            <a class="dropdown-item" href="'.route("childcategories.edit",$data->id).'"><i class="mdi mdi-pencil"></i> Edit</a>
                            <a class="dropdown-item t_delete" href="javascript::void(0)" data-url="'.route("childcategories.destroy",$data->id).'"><i class="mdi mdi-delete"></i> Delete</a>
                          </div>
                        </div>';
                            })
                    ->rawColumns(['attributes','action','status'])
                ->toJson();
    }
    public function index(Request $request)
    {
        return view('admin.childcategory.index');
    }

    public function create()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view('admin.childcategory.create',compact('categories','subcategories'));
    }

    public function subcategoryOptions($id)
    {
        $category = Category::findOrFail($id);
        $view = view('admin.childcategory.ajax.subcategoryoptions',compact('category'))->render();
        return response()->json(['html'=>$view]);
    }
  
    public function attributes($id)
    {
      $cat = ChildCategory::findOrFail($id);
      $childcategory_attributes = view('admin.childcategory.ajax.attributes',compact('cat'))->render();
      return response()->json(['childcategory_attributes' => $childcategory_attributes]);
    }
    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required|max:255',
            'slug'=>'required|unique:child_categories,slug|max:255',
            'subcategory'=>'required|integer',
        ]);

        $childcategory = new ChildCategory();
        $input = $request->all();

        $subcategory = SubCategory::findOrFail($request->input('subcategory'));

        $input['subcategory_id'] = $subcategory->id;
        $input['slug'] = Str::slug($request->input('slug'));

        $childcategory->fill($input)->save();

        return redirect()->back()->with('success','Child Category Has Been Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChildCategory  $ChildCategory
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChildCategory  $ChildCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ChildCategory $childcategory)
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $childcategory = ChildCategory::findOrFail($childcategory->id); 
        return view('admin.childcategory.edit',compact('childcategory','categories','subcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChildCategory  $ChildCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name'=>'required|max:255',
            'slug'=>'required|max:255',
            'subcategory'=>'required|integer',
        ]);

        $input = $request->all();

        $subcategory = SubCategory::findOrFail($request->input('subcategory'));

        $input['subcategory_id'] = $subcategory->id;
        $input['slug'] = Str::slug($request->input('slug'));

        $childcategory = ChildCategory::findOrFail($id)->update($input);

        return redirect()->route('childcategories.index')->with('success','Child Category has been updated!');
    }

    public function active($id)
    {
        $childcategory = ChildCategory::findOrFail($id);
        $childcategory->status = 1;
        $childcategory->save();
        return response()->json(['success'=>'Child Category has been activated!']);
    }

    public function deactive($id)
    {
        $childcategory = ChildCategory::findOrFail($id);
        $childcategory->status = 0;
        $childcategory->save();
        return response()->json(['success'=>'Child Category has been deactivated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChildCategory  $ChildCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $data = ChildCategory::findOrFail($id);

        if($data->attributes->count() > 0)
        {
        //--- Redirect Section
        return response()->json([
            'msg'=> 'danger',
            'danger'=> 'This Child Category has Attributes Remove its Attributes first !',
        ]);
        //--- Redirect Section Ends
        }
        
        if($data->products->count()>0)
        {
        //--- Redirect Section
        return response()->json([
            'msg'=> 'danger',
            'danger'=> 'This Child Category has Products Remove its Products first !',
        ]);
        //--- Redirect Section Ends
        }

        $data->delete();

        return response()->json([
            'msg'     => 'success',
            'success' => 'Child Category has been Deleted!'
        ]);
    }
}
