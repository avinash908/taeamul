<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Cart;
use validator;
use Session;
use App;

class CartController extends Controller
{
	public function __construct()
	{
		Cart::setGlobalTax(0);
	}
	public function index()
	{
		return view('front.cart');
	}


 	public function store($slug,Request $req)
 	{
 		$product = Product::where('slug',$slug)->firstOrFail();
 		if (!$product->stock > 0) {
 			return response()->json(['danger'=>'Product is Out Of Stock !']);
 		}
 		
		$add = Cart::add($product->id, $product->name, 1, $product->price, 550,['picture'=> $product->thumbnail]);
 		$add->associate($product);
		if ($add) {
			return response()->json(['success'=>'Item Added To cart']);
		}
		return response()->json([
			'danger'=>'Item Failed while Adding To cart',
		]);
 	}
 	public function productStore($slug,Request $req)
 	{
		$value = $req->input('attrs');
		if (empty($value)) {
			$attr = null;
		}else{
			$attr = explode(',', $value);
		}

 		$product = Product::where('slug',$slug)->firstOrFail();

 		$price = Session::has('productData') ? Session::get('productData') : $product->price;

			$add = Cart::add($product->id, $product->name, $req->input('qty'), $price, 550,[
				'color'=>$req->input('color'),'attrs'=>$attr,'picture'=>$product->thumbnail,'size'=>$req->input('size')]);
 			$add->associate($product);
		if ($add) {
			return response()->json(['success'=>'Item Added To cart']);
		}
		return response()->json([
			'danger'=>'Item Failed while Adding To cart',
		]);
 	}


 	public function update(Request $req)
 	{
 		$validator = $req->validate([
 			'qty'=>'required',
 		]);
	 		for ($i=0; $i < Cart::content()->count(); $i++) { 
	 			$update = Cart::update($req->input('rowId')[$i], $req->input('qty')[$i]);
			}	
			if ($update) {
				return response()->json(['success'=>'Item Updated!']);

			}
			return response()->json(['danger'=>'Item Failed Updating cart']);

 		
 	}



 	public function remove($rowId)
 	{
 		$remve = Cart::remove($rowId);
		return response()->json(['success'=>'Cart Item Has Been Removed']);
 	}
}
