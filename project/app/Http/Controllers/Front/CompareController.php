<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Cart;
use App\Product;
use Session;
use App;


class CompareController extends Controller
{
	function __construct()
    {
    	
    }
    public function index()
    {
    	return view('front.compare');
    }
    public function store($slug)
    {
    	if (Cart::instance('compare')->content()->count() <= 3) {
	 		$product = Product::where('slug',$slug)->firstOrFail();
	 		if ($product->stock >0) {
				$add = Cart::instance('compare')->add($product->id, $product->name, 1, $product->price, 550,['description'=>$product->short_description,'picture'=> $product->thumbnail,'stock'=>'In Stock','slug'=>$product->slug]);
	 		}else{
				$add = Cart::instance('compare')->add($product->id, $product->name, 1, $product->price, 550,['description'=>$product->short_description,'picture'=> $product->thumbnail,'stock'=>'Out Of Stock','slug'=>$product->slug]);

	 		}

			if ($add) {
				return response()->json(['success'=>'Item Added To Compare']);
			}
			return response()->json([
				'danger'=>'Item Failed while Adding To Compare',
			]);
    	}else{
    		return response()->json([
				'danger'=>'Cannot add more than 4 items in Compare',
			]);
    	}

    }
	public function remove($rowId)
 	{
 		$remove = Cart::instance('compare')->remove($rowId);
		return response()->json(['success'=>'Compare Item Has Been Removed']) ;
 	}
}
