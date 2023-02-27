<?php
namespace App\Http\Services;
use Str;
use App\User;
use App\Product;
use App\Category;
use App\Attribute;
class ProductService 
{
    public static function uploadProduct($request, $shop_id = null)
    {
          $input = $request->all();
        
          $slug = Str::slug($input['name'].'-'.uniqid(),'-');

            $product = Product::create([
                'shop_id' => $shop_id,
                'sku' => $input['sku'],
                'slug' => $slug,
                'name' => $input['name'],
                'description' => $input['description'],
                'price' => $input['price'],
                'old_price' => $input['old_price'],
                'stock' => $input['stock'],
                'short_description' => $input['short_description'],
            ]);
           
            $path = '/assets/images/products/'.$slug.'-taeamul_00'.$product->id;
            mkdir(base_path('../'.$path));

            $product_thumbnail = $request->file('product_thumbnail');

            $thumbnail_name = $slug . date('YmdHis') . "." . $product_thumbnail->getClientOriginalExtension();

            $product_thumbnail->move(base_path('../'.$path), $thumbnail_name);

            $product->thumbnail = $path.'/'.$thumbnail_name;

            if (!empty($request->condition_input)) {
                $product->condition   = $input['condition'];
            }

            if ($request->has('tags')) {
                $product->tag($request->input('tags'));
            }
            if (!empty($request->size_input)) {
                for ($i=0; $i < count($input['sizes']); $i++) { 
                    $product->sizes()->create([
                         'title' => $input['sizes'][$i],
                         'slug' => Str::slug($input['sizes'][$i]),
                         'quantity' => $input['sizes_qty'][$i],
                         'price' => $input['sizes_price'][$i],
                    ]);
                } 
            }
            if (!empty($request->color_input)) {
                for ($i=0; $i < count($input['colors']); $i++) { 
                    $product->colors()->create([
                         'code' => $input['colors'][$i],
                         'name' => $input['colors_name'][$i],
                         'slug' => Str::slug($input['colors_name'][$i]),
                         'quantity' => $input['colors_qty'][$i],
                    ]);
                } 
            }
            if (!empty($request->wholesale_input)) {
                for ($i=0; $i < count($input['whole_sale_unit']); $i++) { 
                    $product->wholesale()->create([
                         'qty' => $input['whole_sale_qty'][$i],
                         'unit' => $input['whole_sale_unit'][$i],
                         'price' => $input['whole_sale_price'][$i],
                    ]);
                }
            }

            $attrArr = [];
            if ($request->has('category') && !empty($request->category)) {

              $product->category_id = $request->category;

              $catAttrs = Attribute::where('attributable_id', $request->category)->where('attributable_type', 'App\Category')->get();
              if (!empty($catAttrs)) {
                foreach ($catAttrs as $key => $catAttr) {
                  $in_name = $catAttr->input_name;
                  if ($request->has("$in_name")) {
                    $attrArr["$in_name"]["values"] = $request["$in_name"];
                  }
                }
              }
            }

            if ($request->has('subcategory') && !empty($request->subcategory)) {

               $product->subcategory_id = $request->subcategory;

              $subAttrs = Attribute::where('attributable_id', $request->subcategory)->where('attributable_type', 'App\Subcategory')->get();
              if (!empty($subAttrs)) {
                foreach ($subAttrs as $key => $subAttr) {
                  $in_name = $subAttr->input_name;
                  if ($request->has("$in_name")) {
                    $attrArr["$in_name"]["values"] = $request["$in_name"];
                  }
                }
              }
            }
            if ($request->has('childcategory') && !empty($request->childcategory)) {

               $product->childcategory_id = $request->childcategory;

              $childAttrs = Attribute::where('attributable_id', $request->childcategory)->where('attributable_type', 'App\Childcategory')->get();
              if (!empty($childAttrs)) {
                foreach ($childAttrs as $key => $childAttr) {
                  $in_name = $childAttr->input_name;
                  if ($request->has("$in_name")) {
                    $attrArr["$in_name"]["values"] = $request["$in_name"];
                  }
                }
              }
            }

            if (empty($attrArr)) {
              $product->attributes = NULL;
            } else {
              $jsonAttr = json_encode($attrArr);
              $product->attributes = $jsonAttr;
            }


            if ($request->has('images')) {
                $count = 1;

                $countfiles = count($_FILES['images']['name']);
 
                 // Looping all files
                 for($i=0;$i<$countfiles;$i++){
                   $filename = $_FILES['images']['name'][$i];
                   
                   // Upload file
                   $folder = base_path('../'.$path);
                   move_uploaded_file($_FILES['images']['tmp_name'][$i],$folder.'/'.$filename);
                    
                    $product->images()->create(['url'=>$path.'/'.$filename]); 
                 }

                // foreach($files as $file) {
                //     $image_name = date('YmdHis').'-'.$count++.'-'.'.'.$file->getClientOriginalExtension();
                //     if($file->move(base_path('../'.$path), $image_name)) {
                //         $current_image = $product->images()->create(['url'=>$path.'/'.$image_name]);  
                //     }
                // }

            }
            if (!empty($request->seo_input)) {
                $product->seo()->create([
                    'title' => $request->seo_title,
                    'meta_tags' => $request->meta_tags,
                    'meta_description' => $request->meta_description,
                ]);
            }
            $product->save();
            return $product;
    }
    public static function updateProduct($request,$product_id)
    {
          $input = request()->all();
          $product = Product::find($product_id);

           $product->update([
                'sku' => $input['sku'],
                'name' => $input['name'],
                'description' => $input['description'],
                'price' => $input['price'],
                'old_price' => $input['old_price'],
                'stock' => $input['stock'],
                'short_description' => $input['short_description'],
            ]);
           
           $slug = $product->slug;

            $path = '/assets/images/products/'.$slug.'-taeamul_00'.$product->id;

            if($request->has('product_thumbnail')){

                $product_thumbnail = $request->file('product_thumbnail');

                $thumbnail_name = $slug . date('YmdHis') . "." . $product_thumbnail->getClientOriginalExtension();

                $product_thumbnail->move(base_path('../'.$path), $thumbnail_name);

                $product->thumbnail = $path.'/'.$thumbnail_name;
            }

            if (!empty($request->condition_input)) {
                $product->condition   = $input['condition'];
            }else{
                $product->condition   = null; 
            }

            if ($request->has('tags')) {
                $product->tag($request->input('tags'));
            }

            if (!empty($request->size_input)) {
                if ($product->sizes) {
                   $product->sizes()->delete();
                }
                for ($i=0; $i < count($input['sizes']); $i++) { 
                    $product->sizes()->create([
                         'title' => $input['sizes'][$i],
                         'slug' => Str::slug($input['sizes'][$i]),
                         'quantity' => $input['sizes_qty'][$i],
                         'price' => $input['sizes_price'][$i],
                    ]);
                } 
            }else{
              if ($product->sizes) {
                 $product->sizes()->delete();
              } 
            }
            if (!empty($request->color_input)) {
              if ($product->colors) {
                 $product->colors()->delete();
              }
              for ($i=0; $i < count($input['colors']); $i++) { 
                  $product->colors()->create([
                       'code' => $input['colors'][$i],
                       'name' => $input['colors_name'][$i],
                       'slug' => Str::slug($input['colors_name'][$i]),
                       'quantity' => $input['colors_qty'][$i],
                  ]);
              } 
            }else{
              if ($product->colors) {
                 $product->colors()->delete();
              }
            }

            if (!empty($request->wholesale_input)) {
                if ($product->wholesale) {
                   $product->wholesale()->delete();
                }
                for ($i=0; $i < count($input['whole_sale_unit']); $i++) { 
                    $product->wholesale()->create([
                         'qty' => $input['whole_sale_qty'][$i],
                         'unit' => $input['whole_sale_unit'][$i],
                         'price' => $input['whole_sale_price'][$i],
                    ]);
                }
            }else{
              if ($product->wholesale) {
                 $product->wholesale()->delete();
              }
            }

            $attrArr = [];
              
              $product->category_id = $request->category;

            if ($request->has('category') && !empty($request->category)) {


              $catAttrs = Attribute::where('attributable_id', $request->category)->where('attributable_type', 'App\Category')->get();
              if (!empty($catAttrs)) {
                foreach ($catAttrs as $key => $catAttr) {
                  $in_name = $catAttr->input_name;
                  if ($request->has("$in_name")) {
                    $attrArr["$in_name"]["values"] = $request["$in_name"];
                  }
                }
              }
            }
            
               $product->subcategory_id = $request->subcategory;

            if ($request->has('subcategory') && !empty($request->subcategory)) {


              $subAttrs = Attribute::where('attributable_id', $request->subcategory)->where('attributable_type', 'App\Subcategory')->get();
              if (!empty($subAttrs)) {
                foreach ($subAttrs as $key => $subAttr) {
                  $in_name = $subAttr->input_name;
                  if ($request->has("$in_name")) {
                    $attrArr["$in_name"]["values"] = $request["$in_name"];
                  }
                }
              }
            }
               $product->childcategory_id = $request->childcategory;

            if ($request->has('childcategory') && !empty($request->childcategory)) {


              $childAttrs = Attribute::where('attributable_id', $request->childcategory)->where('attributable_type', 'App\Childcategory')->get();
              if (!empty($childAttrs)) {
                foreach ($childAttrs as $key => $childAttr) {
                  $in_name = $childAttr->input_name;
                  if ($request->has("$in_name")) {
                    $attrArr["$in_name"]["values"] = $request["$in_name"];
                  }
                }
              }
            }

            if (empty($attrArr)) {
              $product->attributes = NULL;
            } else {
              $jsonAttr = json_encode($attrArr);
              $product->attributes = $jsonAttr;
            }

            if ($request->file('images')) {

                $countfiles = count($_FILES['images']['name']);
 
                 // Looping all files
                 for($i=0;$i<$countfiles;$i++){

                   $filename = $_FILES['images']['name'][$i];

                   $folder = base_path('../'.$path);

                    if (!file_exists($folder.'/'.$filename)) {

                      move_uploaded_file($_FILES['images']['tmp_name'][$i],$folder.'/'.$filename);
                    
                      $product->images()->create(['url'=>$path.'/'.$filename]); 
                    }
                   
                 }

            }
            if (!empty($request->seo_input)) {
             if ($product->seo) {
                 $product->seo()->update([
                    'title' => $request->seo_title,
                    'meta_tags' => $request->meta_tags,
                    'meta_description' => $request->meta_description,
                 ]);
              }else{
                $product->seo()->create([
                    'title' => $request->seo_title,
                    'meta_tags' => $request->meta_tags,
                    'meta_description' => $request->meta_description,
                ]);
              }
            }
            $product->save();
            return $product;
    }
    public static function updatedHighlight($request,$product_id)
    {
      $product = Product::where('id',$product_id);
      $input = [];
      if($request->is_featured == 'yes')
      {
        $input['is_featured'] = 1;
      }else{
        $input['is_featured'] = 0;
      }
      if($request->is_bestSeller == 'yes')
      {
        $input['is_bestSeller'] = 1;
      }else{
        $input['is_bestSeller'] = 0;
      }
      if($request->is_topRated == 'yes')
      {
        $input['is_topRated'] = 1;
      }else{
        $input['is_topRated'] = 0;
      }
      if($request->is_bestDeals == 'yes')
      {
        $input['is_bestDeals'] = 1;
      }else{
        $input['is_bestDeals'] = 0;
      }
      if($request->is_hot == 'yes')
      {
        $input['is_hot'] = 1;
      }else{
        $input['is_hot'] = 0;
      }
      if($request->is_new == 'yes')
      {
        $input['is_new'] = 1;
      }else{
        $input['is_new'] = 0;
      }
      if($request->is_trending == 'yes')
      {
        $input['is_trending'] = 1;
      }else{
        $input['is_trending'] = 0;
      }
      if($request->is_sale == 'yes')
      {
        $input['is_sale'] = 1;
      }else{
        $input['is_sale'] = 0;
      }
      $product->update($input);
      return $product;
    }
}