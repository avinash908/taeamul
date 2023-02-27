<?php
namespace App\Http\Services;
use Str;
use App\User;
use App\Product;
use App\Category;
use App\Subcategory;
use App\Childcategory;
use Illuminate\Http\Request;
// use Illuminate\Support\Collection;
use App\Support\Collection;
class FilterProductService 
{
   public static function filter(Request $request, $slug=null, $slug1=null, $slug2=null)
    {
      $cat = null;
      $subcat = null;
      $childcat = null;
      $minprice = $request->min_price;
      $maxprice = $request->max_price;
      $sort = $request->sort;
      $search = $request->search;

      if (!empty($slug)) {
        $cat = Category::where('slug', $slug)->firstOrFail();
        $data['cat'] = $cat;
      }
      if (!empty($slug1)) {
        $subcat = Subcategory::where('slug', $slug1)->firstOrFail();
        $data['subcat'] = $subcat;
      }
      if (!empty($slug2)) {
        $childcat = Childcategory::where('slug', $slug2)->firstOrFail();
        $data['childcat'] = $childcat;
      }

      $prods = Product::when($cat, function ($query, $cat) {
                    return $query->where('category_id','=',$cat->id);
                })
                ->when($subcat, function ($query, $subcat) {
                    return $query->where('subcategory_id', $subcat->id);
                })
                ->when($childcat, function ($query, $childcat) {
                    return $query->where('childcategory_id', $childcat->id);
                })
                ->when($search, function ($query, $search) {
                    return $query->where('name','LIKE', '%'.$search.'%');
                })
                ->when($minprice, function($query, $minprice) {
                  return $query->where('price', '>=', $minprice);
                })
                ->when($maxprice, function($query, $maxprice) {
                  return $query->where('price', '<=', $maxprice);
                })
                 ->when($sort, function ($query, $sort) {
                    if ($sort=='date_desc') {
                      return $query->orderBy('id', 'DESC');
                    }
                    elseif($sort=='date_asc') {
                      return $query->orderBy('id', 'ASC');
                    }
                    elseif($sort=='price_desc') {
                      return $query->orderBy('price', 'DESC');
                    }
                    elseif($sort=='price_asc') {
                      return $query->orderBy('price', 'ASC');
                    }
                 })
                ->when(empty($sort), function ($query, $sort) {
                    return $query->orderBy('id', 'DESC');
                });

                $prods = $prods->where(function ($query) use ($cat, $subcat, $childcat, $request) {
                      $flag = 0;

                      if (!empty($cat)) {
                        foreach ($cat->attributes as $key => $attribute) {
                          $inname = $attribute->input_name;
                          $chFilters = $request["$inname"];
                          if (!empty($chFilters)) {
                            $flag = 1;
                            foreach ($chFilters as $key => $chFilter) {
                              if ($key == 0) {
                                $query->where('attributes', 'like', '%'.'"'.$chFilter.'"'.'%');
                              } else {
                                $query->orWhere('attributes', 'like', '%'.'"'.$chFilter.'"'.'%');
                              }

                            }
                          }
                        }
                      }


                      if (!empty($subcat)) {
                        foreach ($subcat->attributes as $attribute) {
                          $inname = $attribute->input_name;
                          $chFilters = $request["$inname"];
                          if (!empty($chFilters)) {
                            $flag = 1;
                            foreach ($chFilters as $key => $chFilter) {
                              if ($key == 0 && $flag == 0) {
                                $query->where('attributes', 'like', '%'.'"'.$chFilter.'"'.'%');
                              } else {
                                $query->orWhere('attributes', 'like', '%'.'"'.$chFilter.'"'.'%');
                              }

                            }
                          }

                        }
                      }


                      if (!empty($childcat)) {
                        foreach ($childcat->attributes as $attribute) {
                          $inname = $attribute->input_name;
                          $chFilters = $request["$inname"];
                          if (!empty($chFilters)) {
                            $flag = 1;
                            foreach ($chFilters as $key => $chFilter) {
                              if ($key == 0 && $flag == 0) {
                                $query->where('attributes', 'like', '%'.'"'.$chFilter.'"'.'%');
                              } else {
                                $query->orWhere('attributes', 'like', '%'.'"'.$chFilter.'"'.'%');
                              }

                            }
                          }

                        }
                      }
                  });


           $prods = $prods->where('status', 1)->get();

            $filters = $request->all();

            $products = (new Collection($prods))->paginate(12)->appends($filters);

            $data['products'] = $products;

      return $data;
    }
}