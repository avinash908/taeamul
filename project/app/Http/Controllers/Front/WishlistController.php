<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Cart;
use validator;
use Session;
use App;


class WishlistController extends Controller
{
	function __construct()
    {
    	
    }

	public function index()
	{
		return view('Front.wishlist');
	}
 	public function store($slug = null)
 	{
 		$product = Product::where('slug',$slug)->firstOrFail();
		$add = Cart::instance('wishlist')->add($product->id, $product->name, 1, $product->price, 550, ['slug' => $product->slug,'picture'=>$product->thumbnail]);
		if ($add) {
 			return response()->json(['success'=>'Item Has Been Added to Wishlist']) ;
		}
 			return response()->json(['danger'=>'Item Cannot Be Added to Wishlist']) ;
 	}

 	public function remove($rowId)
 	{
 		$remove = Cart::instance('wishlist')->remove($rowId);
		return response()->json(['success'=>'Wishlist Item Has Been Removed']) ;
 	}
}
