<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\PostCategory;
use App\Comment;
use DataTables;
use DB;


class BlogController extends Controller
{
    // FRONT SECTION

    public function __construct()
    {
        $this->middleware(['permission:can manage blog']);
    }


    // ADMIN SECTION

    public function create()
    {

        // if(!empty($product->shop_id)){
        //     $product->shop->user->notify(new ReviewNotification);
        // }
        $cat=PostCategory::latest()->get() ; 


        return view('admin.blogs.create',compact('cat'));
    }
    public function createCategory()
    {
        $cat=PostCategory::latest()->get() ; 
        return view('admin.blogs.createCategories',compact('cat'));
    }
    public function store(Request $request)
    {
        $val = $request->validate([
            'title' => 'required|unique:posts,title',
            'dataSend' => 'required',
            'blogPic' => 'required',
            'categorySelect' => 'required',
        ]);
        if ($val) {
            $url = $request->file('blogPic');
            $path = 'assets/images/blogPics/';
            $thumbnail = date('YmdHis') . "." . $url->getClientOriginalExtension();
            $url->move(base_path('../'.$path), $thumbnail);

            $blog = Post::create([
                'slug'=> Str::slug($request->input('title')),
                'title'=> $request->input('title'),
                'data'=> $request->input('dataSend'),
                'thumbnail'=> $path.'/'.$thumbnail,
                'category_id'=> $request->input('categorySelect'),
            ]);
            $blog->tag($request->input('tags'));
            if ($blog) {
                return redirect()->back()->with('success','Post Posted !');
            }
            // if (!empty($request->seo_input)) {
      //           $blog->seo()->create([
      //               'meta_tags' => $request->meta_tags,
      //               'meta_description' => $request->meta_description,
      //        ]);
      //       }
        }
    }

    public function addCategory(Request $request)
    {
        $add = PostCategory::create([
            'title'=>$request->input('addCat'),
            'slug'=> str_replace(' ','-',$request->input('addCat')),
        ]);
        if ($add) {
            return redirect()->back()->with('success','Category Has Been Added');
        }
    }
    public function destroyCat(Request $request,$id)
    {
        PostCategory::find($id)->delete();
        if ($request->ajax()) {
            return response()->json([
                'msg'=>'success',
                'success'=> 'Category has been deleted!',
            ]);
        }
        return redirect()->url('/admin/blog_categories')->with('success','Category has been deleted!');
    }





    public function fetchCategory()
    {
        return view('admin.blogs.fetchCategories');
    }

    public function datatableCat()
    {
        $datas = PostCategory::orderBy('id','desc')->get();
             return Datatables::of($datas)
             ->addColumn('title', function(PostCategory $data) {
                                return $data->title;
                            })
             ->addColumn('slug', function(PostCategory $data) {
                                return $data->slug;
                            })
              ->addColumn('created_at', function(PostCategory $data) {
                                return $data->created_at;
                            })
                            ->addColumn('action', function(PostCategory $data) {
                                return '<div class="dropdown">  
                          <button type="button" class="btn btn-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <h6 class="dropdown-header"></h6>
                            <a class="dropdown-item" href="#"><i class="mdi mdi-pencil"></i> Edit</a>
                            <a class="dropdown-item t_delete" href="javascript:void(0)" data-url="'.route('admin.categories.destroy',$data->id).'" ><i class="mdi mdi-delete"></i> Delete</a>
                          </div>
                        </div>';
                            })
                    ->rawColumns(['title','slug','created_at','action'])
                ->toJson();
    }
    public function fetchPost()
    {
        return view('admin.blogs.fetchPosts');
    }

    public function datatablePost()
    {
        $datas = Post::orderBy('id','desc')->get();
             return Datatables::of($datas)

                          ->addColumn('category_name', function(Post $data) {
                                return $data->category->title;
                            })
                            ->addColumn('status', function(Post $data) {
                                return '<button type="button" class="btn btn-success">
                                <i class="mdi mdi-checked"></i>
                            Active
                          </button>';
                            })
                            ->addColumn('action', function(Post $data) {
                                return '<div class="dropdown">  
                          <button type="button" class="btn btn-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <h6 class="dropdown-header"></h6>
                            <a class="dropdown-item" href="#"><i class="mdi mdi-pencil"></i> Edit</a>
                            <a class="dropdown-item t_delete" href="#" ><i class="mdi mdi-delete"></i> Delete</a>
                          </div>
                        </div>';
                            })
                    ->rawColumns(['category_name','action','status'])
                ->toJson();
    }
    public function fetchComment()
    {
        return view('admin.blogs.fetchComments');
    }

    public function datatableComment()
    {
        $datas = Comment::orderBy('id','desc')->get();
             return Datatables::of($datas)
                        ->addColumn('post_title', function(Comment $data) {
                                return $data->post->title;
                            })
                            ->addColumn('status', function(Comment $data) {
                                return '<button type="button" class="btn btn-success">
                                <i class="mdi mdi-checked"></i>
                            Active
                          </button>';
                            })
                            ->addColumn('action', function(Comment $data) {
                                return '<div class="dropdown">
                          <button type="button" class="btn btn-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <h6 class="dropdown-header"></h6>
                            <a class="dropdown-item" href="#"><i class="mdi mdi-pencil"></i> Edit</a>
                            <a class="dropdown-item" href="#"><i class="mdi mdi-delete"></i> Delete</a>
                          </div>
                        </div>';
                            })
                    ->rawColumns(['post_title','action','status'])
                ->toJson();
    }
}