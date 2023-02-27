<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductValidate;
use App\Http\Services\ProductService;
use Symfony\Component\HttpFoundation\Response;
use App\Product;
use App\User;
use App\Category;
use DataTables;
use Validator;
use Auth;

class ProductController extends Controller
{
    public function datatables()
    {
        $datas = Auth::user()->shop->products()->orderBy('id','desc')->get();
             return Datatables::of($datas)
                            ->addColumn('status', function(Product $data) {
                                 if($data->status != 1){
                                return '<div class="dropdown">
                                      <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Deactivated
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item badge t_active" data-url="'.route("v-product.active",$data->id).'" href="javascript:void(0)"><i class="mdi mdi-eye"></i> Activate</a>
                                      </div>
                                    </div>';
                                }else{

                                    return '<div class="dropdown">
                                      <button type="button" class="badge badge-success dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Activated
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item badge t_deactive" data-url="'.route("v-product.deactive",$data->id).'" href="javascript:void(0)"><i class="mdi mdi-eye-off"></i> Deactivate</a>
                                      </div>
                                    </div>';
                                }
                            })
                            ->addColumn('action', function(Product $data) {
                                return 
                                '<div class="dropdown">
                          <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Actions
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="dropdown-item" href="'.route("v-products.edit",$data->id).'"><i class="mdi mdi-pencil"></i> Edit</a>
                            <a class="dropdown-item t_delete" data-url="'.route("v-products.destroy",$data->id).'" href="javascript:void(0)"><i class="mdi mdi-delete"></i> Delete</a>
                          </div>
                        </div>';
                            })
                    ->rawColumns(['action','status'])
                ->toJson();
    }

    public function index()
    {
       return view('vendor.product.index');
    }
    
    public function create()
    {
        $categories = Category::all();
        $sku = $this->generateSku();
        return view('vendor.product.create',compact('categories','sku'));
    }
    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'name' => 'required|string|max:255',
            'sku' => 'required|unique:products,sku',
            'category' => 'required',
            'description' => 'required',
            'short_description' => 'required|max:255',
            'price' => 'integer|required',
            'old_price' => 'integer',
            'stock' => 'integer|required',
            'tags' =>   'max:255',
            'product_thumbnail' =>'required|image|mimes:jpeg,png,jpg',
            'images.*'      =>'image|mimes:jpeg,png,jpg,gif,svg',
            'meta_tags' => 'max:255',
            'meta_description' => 'max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg'=> 'danger',
                'error'=>$validator->errors()->all(),
            ]);
        }
        $shop_id = Auth::user()->shop->id;
        ProductService::uploadProduct($request,$shop_id);
        return response()->json([
            'msg'=> 'success',
            'success'=>'Product has been uploaded successfuly!',
        ]);    
    }
    
    public function show($value='')
    {
        return back();
    }

    public function edit($id)
    { 
        $categories = Category::all();
        $product = Auth::user()->shop->products()->findOrFail($id);
        return view('vendor.product.edit',compact('product','categories'));
    }

    public function update(Request $request, $id)
    {
        $input = request()->all();
        $validator = Validator::make($input,[
            'name' => 'required|string|max:255',
            'sku' => 'required',
            'category' => 'required',
            'description' => 'required',
            'short_description' => 'required|max:255',
            'price' => 'integer|required',
            'old_price' => 'integer',
            'stock' => 'integer|required',
            'tags' =>   'max:255',
            'product_thumbnail' =>'image|mimes:jpeg,png,jpg,gif,svg',
            'images.*'      =>'image|mimes:jpeg,png,jpg',
            'meta_tags' => 'max:255',
            'meta_description' => 'max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg'=> 'danger',
                'error'=>$validator->errors()->all(),
            ]);
        }

        $product = Auth::user()->shop->products()->findOrFail($id);
        ProductService::updateProduct($request,$product->id);

        return response()->json([
            'msg'=> 'success',
            'success'=>'Product has been Updated successfuly!',
        ]);
    }

    public function active($id)
    {
        $product = Auth::user()->shop->products()->findOrFail($id);
        $product->status = 1;
        $product->save();
        return response()->json(['success'=>'Product has been activated!']);
    }

    public function deactive($id)
    {
        $product = Auth::user()->shop->products()->findOrFail($id);
        $product->status = 0;
        $product->save();
        return response()->json(['success'=>'Product has been deactivated!']);
    }

    public function destroy(Request $request, $id)
    {
        $remove = Auth::user()->shop->products()->findOrFail($id)->delete();
        if ($request->ajax()) {
            return response()->json([
                'msg'     => 'success',
                'success' => 'Product has been Deleted!'
            ]);
        }
        return redirect()->back()->with('success','Product has been Deleted!') ;
    }

    public function deleteProductImage($product_id, $image_id)
    {
      $product = Auth::user()->shop->products()->findOrFail($id);
      $product->images()->where('id','=',$image_id)->delete();
      $gallery = view('vendor.product.ajax.images',compact('product'))->render();
      return response()->json([
          'html'    => $gallery,
          'msg'     => 'success',
          'success' => 'Image has been Deleted!'
      ]);
    }
    public function generateSku()
    {
        $uniqid1 = rand(10000,99999);
        $p = Product::latest()->first();
        if ($p) {
            $pid = $p->id;
        }else{
            $pid = 0;
        }
        $sku = ++$pid.$uniqid1;
        if (Product::where('sku',$sku)->exists()) {
            return generateSku();
        }
        return 'sku_'.$sku;
    }
}
