<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:can manage categories']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function datatables()
    {
        $datas = Category::orderBy('id','desc')->get();
             return Datatables::of($datas)
                            ->addColumn('attributes', function(Category $data) {
                                $buttons = '<div class="btn btn-group">';
                                $buttons .= '<a href="'.route("admin.attributes.create",$data->id).'?type=category" class="btn btn-primary">
                                  <i class="mdi mdi-plus"></i>
                              Create
                            </a>';

                              if ($data->attributes()->count() > 0) {
                                  $buttons .= '<a href="' . route('admin.attributes.manage', $data->id) .'?type=category' . '" class="btn btn-dark"> <i class="mdi mdi-pencil"></i> Manage</a>';
                                }
                                $buttons .= '</div>';
                                return $buttons;
                            })
                            ->addColumn('status', function(Category $data) {
                                if($data->status != 1){
                                return '<div class="dropdown">
                                      <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Deactivated
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item badge t_active" data-url="'.route("admin.category.active",$data->id).'" href="javascript:void(0)"><i class="mdi mdi-eye"></i> Activate</a>
                                      </div>
                                    </div>';
                                }else{

                                    return '<div class="dropdown">
                                      <button type="button" class="badge badge-success dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Activated
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item badge t_deactive" data-url="'.route("admin.category.deactive",$data->id).'" href="javascript:void(0)"><i class="mdi mdi-eye-off"></i> Deactivate</a>
                                      </div>
                                    </div>';
                                };
                            })
                            ->addColumn('action', function(Category $data) {
                                return '<div class="dropdown">
                          <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <h6 class="dropdown-header"></h6>
                            <a class="dropdown-item" href="'.route("categories.edit",$data->id).'"><i class="mdi mdi-pencil"></i> Edit</a>
                            <a class="dropdown-item t_delete" href="javascript::void(0)" data-url="'.route("categories.destroy",$data->id).'"><i class="mdi mdi-delete"></i> Delete</a>
                          </div>
                        </div>';
                            })
                    ->rawColumns(['attributes','action','status'])
                ->toJson();
    }
    public function index(Request $request)
    {
        return view('admin.category.index');
    }

    public function create()
    {
        return view('admin.category.create');
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
            'slug'=>'required|unique:categories,slug|max:255',
        ]);

        $category = new Category();
        $input = $request->all();

        $input['slug'] = Str::slug($request->input('slug'));

        if (!empty($input['is_featured'])) {
           $input['is_featured'] = 1;
        }else{
            $input['is_featured'] = 0;
        }

        $category->fill($input)->save();

        if (!empty($request->seo_input)) {
            $category->seo()->create([
                'title' => $request->seo_title,
                'meta_tags' => $request->meta_tags,
                'meta_description' => $request->meta_description,
            ]);
        }
        
        return redirect()->back()->with('success','Category Has Been Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return redirect()->back();
    }

    public function getSubcatOptions($id)
    {
      $cat = Category::findOrFail($id);
      $subcategories = view('admin.category.ajax.subcatoptions',compact('cat'))->render();
      $category_attributes = view('admin.category.ajax.attributes',compact('cat'))->render();
      return response()->json(['subcategories'=>$subcategories, 'category_attributes' => $category_attributes]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $category = Category::findOrFail($category->id); 
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name'=>'required|max:255',
            'slug'=>'required|max:255',
        ]);

        $input = $request->all();

        $input['slug'] = Str::slug($request->input('slug'));

        if (!empty($input['is_featured'])) {
           $input['is_featured'] = 1;
        }else{
            $input['is_featured'] = 0;
        }

        $category = Category::findOrFail($id);
        $category->update($input);


        if (!empty($request->seo_input)) {
           if ($category->seo) {
               $category->seo()->update([
                  'title' => $request->seo_title,
                  'meta_tags' => $request->meta_tags,
                  'meta_description' => $request->meta_description,
               ]);
            }else{
              $category->seo()->create([
                  'title' => $request->seo_title,
                  'meta_tags' => $request->meta_tags,
                  'meta_description' => $request->meta_description,
              ]);
            }
        }

        return redirect()->route('categories.index')->with('success','Category has been updated!');
    }

    public function active($id)
    {
        $category = Category::findOrFail($id);
        $category->status = 1;
        $category->save();
        return response()->json(['success'=>'Category has been activated!']);
    }

    public function deactive($id)
    {
        $category = Category::findOrFail($id);
        $category->status = 0;
        $category->save();
        return response()->json(['success'=>'Category has been deactivated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $data = Category::findOrFail($id);

        if($data->attributes->count() > 0)
        {
        //--- Redirect Section
        return response()->json([
            'msg'=> 'danger',
            'danger'=> 'This Category has Attributes Remove its Attributes first !',
        ]);
        //--- Redirect Section Ends
        }

        if($data->subs->count()>0)
        {
        //--- Redirect Section
        return response()->json([
            'msg'=> 'danger',
            'danger'=> 'This Category has Sub Categories Remove its Sub Categories first !',
        ]);
        //--- Redirect Section Ends
        }
        if($data->products->count()>0)
        {
        //--- Redirect Section
        return response()->json([
            'msg'=> 'danger',
            'danger'=> 'This Category has Products Remove its Products first !',
        ]);
        //--- Redirect Section Ends
        }

        $data->delete();

        return response()->json([
            'msg'     => 'success',
            'success' => 'Category has been Deleted!'
        ]);
    }
}
