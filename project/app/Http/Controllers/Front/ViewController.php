<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use URL;
use App;
use Cart;
use Session;
use App\Seo;
use App\Faq;
use App\Post;
use App\Page;
use App\Product;
use App\Comment;
use App\PostCategory;
use App\Category;
use App\ContactDetail;
use Illuminate\Http\Request;
use App\Http\Services\FilterProductService;

class ViewController extends Controller
{

    public function index(Request $request)
    {
        $page = Page::where('type','=','default')->where('slug','=','home')->first();
        $seo = $page->seo;
        $title = $page->title;
        $products = Product::where('status','!=',0)->get();
        $categories = Category::where('status','!=',0)->where('is_featured','!=',0)->get();
        return view('front.index',compact('products','categories','seo','title'));
    }

    public function page($slug)
    {
        $page = Page::where('type','=',null)->where('slug','=',$slug)->firstOrFail();
        $seo = $page->seo;
        $title = $page->title;
        return view('front.page',compact('page','seo','title'));
    }

    public function product($slug = null)
    {   


        $product = Product::where('status','!=',0)->where('slug','=',$slug)->firstOrFail();

        $related_products = $product->category ? $product->category->products()->where('status','!=',0)->where('id','!=',$product->id)->take(5)->get() : [];

        Session::put('productData', $product->price);
        Session::put('productId', $product->id);

        $seo = $product->seo;
        $title = $product->name;
        return view('front.product',compact('product','related_products','seo','title'));
    }

    public function shop(Request $request, $slug = null, $slug1 = null, $slug2 = null)
    {
        $data = FilterProductService::filter($request, $slug, $slug1, $slug2);

        if(request()->ajax()){
            $view = view('front.ajax.shopProducts', $data)->render();
            return response()->json(['view'=>$view]);
        }
        $page = Page::where('type','=','default')->where('slug','=','shop')->first();
        $data['seo'] = $page->seo;
        $data['title'] = $page->title;
        return view('front.shop',$data);
    }
    public function order_track()
    {
        return view('front.order_track');
    }
    public function order_success()
    {
        return view('front.order');
    }
    public function checkout()
    {
        return view('front.checkout');
    }
     public function contact_us()
    {
        $page = Page::where('type','=','default')->where('slug','=','contact_us')->first();
        $seo = $page->seo;
        $title = $page->title;
        $contact_detail = ContactDetail::findOrFail(1);
        return view('front.contact_us',compact('contact_detail','seo','title'));
    }
    public function faqs()
    {
        $page = Page::where('type','=','default')->where('slug','=','faqs')->first();
        $seo = $page->seo;
        $title = $page->title;
        $faqs = Faq::all();
        return view('front.faqs',compact('faqs','seo','title'));
    }
    public function blog()
    {
        $ctg = null;
        $posts = Post::latest()->paginate(10);

       if (request()->has('category') && request()->filled('category')) {
            $ctg = PostCategory::where('slug',request()->get('category'))->firstOrFail();
            $posts =Post::where('category_id',$ctg->id)->paginate(10);
        };
        if (request()->has('s') && request()->filled('s')) {
            $posts = Post::where('title','LIKE','%'.request()->get('s').'%');
            $posts = $posts->paginate(10);

        };

        $cat = PostCategory::all();

        $page = Page::where('type','=','default')->where('slug','=','blog')->first();
        $seo = $page->seo;
        $title = $page->title;

        return view('front.blog',compact('posts','cat','seo','title','ctg'));

    } 
    public function post($slug = null)
    {   
        $post =Post::where('slug',$slug)->firstOrFail();  
        $recentPosts =Post::latest()->take(5)->get();  
        $cat =PostCategory::get();
        $comment =Comment::where('post_id',$post->id)->get();
        $seo = $post->seo;
        $title = $post->title;
        return view('front.post',compact('post','cat','recentPosts','comment','seo','title'));
    }
    public function comments(Request $request) 
    {
        $comment =Comment::where('post_id',$request->input('post'))->get();
        $view = view('front.ajax.comments',compact('comment'))->render();
        return response()->json(['html'=>$view]); 
    }
    public function reviews(Request $request) 
    {
        $product =Product::where('slug',$request->input('slug'))->firstOrFail();
        $view = view('front.ajax.review',compact('product'))->render();
        return response()->json(['html'=>$view]); 
    }
    public function getCompareItems(Request $request) 
    {
        $view = view('front.ajax.compare')->render();
        return response()->json(['html'=>$view]); 
    }
    public function getWishlistItems(Request $request) 
    {
        $view = view('front.ajax.wishlist')->render();
        return response()->json(['html'=>$view]); 
    }
     public function getCartItems(Request $request) 
    {
        $view = view('front.ajax.cart')->render();
        return response()->json(['html'=>$view]); 
    }
    public function getCartDiscount(Request $request) 
    {
        $view = view('front.ajax.cartDiscount')->render();
        return response()->json(['html'=>$view]); 
    }
    public function getUpperCart(Request $request) 
    {
        $view = view('front.ajax.upperCart')->render();
        return response()->json(['html'=>$view]); 
    }
    public function getFeaturedProducts(Request $request) 
    {
        $products = Product::where('status','!=',0)->where('is_featured','!=',0)->take(6)->get();
        $view = view('front.ajax.featured',compact('products'))->render();
        return response()->json(['html'=>$view]); 
    }
    public function getSaleProducts(Request $request) 
    {
        $sale = Product::where('status','!=',0)->where('is_sale','!=',0)->take(6)->get();
        $view = view('front.ajax.sale',compact('sale'))->render();
        return response()->json(['html'=>$view]); 
    }
    public function getTopRatedProducts(Request $request) 
    {
        $rated = Product::where('status','!=',0)->where('is_topRated','!=',0)->take(6)->get();
        $view = view('front.ajax.topRated',compact('rated'))->render();
        return response()->json(['html'=>$view]); 
    }
    public function getBestDealsProducts(Request $request) 
    {
        $deals = Product::where('status','!=',0)->where('is_bestDeals','!=',0)->take(6)->get();
        $view = view('front.ajax.bestDeals',compact('deals'))->render();
        return response()->json(['html'=>$view]); 
    }
    public function getBestSellersProducts(Request $request) 
    {
        $seller = Product::where('status','!=',0)->where('is_bestSeller','!=',0)->take(6)->get();
        $view = view('front.ajax.bestSellers',compact('seller'))->render();
        return response()->json(['html'=>$view]); 
    }
    public function getRecentlyAddedProducts(Request $request) 
    {
        $recently = Product::where('status','!=',0)->where('is_new','!=',0)->latest()->take(6)->get();
        $view = view('front.ajax.recentlyAdded',compact('recently'))->render();
        return response()->json(['html'=>$view]); 
    }
    public function getHotSaleTrendingProducts(Request $request) 
    {
        $hot = Product::where('status','!=',0)->where('is_hot','!=',0)->take(3)->get();
        $sale = Product::where('status','!=',0)->where('is_sale','!=',0)->take(3)->get();
        $trending = Product::where('status','!=',0)->where('is_trending','!=',0)->take(3)->get();
        $view = view('front.ajax.hotNewTrending',compact('hot','sale','trending'))->render();
        return response()->json(['html'=>$view]); 
    }
}