<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Category;
use App\SubCategory;
use App\ChildCategory;
use App\Attribute;
use App\AttributeOption;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class AttributeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:can manage categories']);
    }

    public function create($id)
    {
        $type = request()->get('type');
        if (!in_array($type, ['category','subcategory','childcategory'])) {
            return abort(404);
        }
        if ($type == 'category') {
            $attributable_type = 'App\Category';
            $cat = Category::findOrFail($id);
        } elseif ($type == 'subcategory') {
            $attributable_type = 'App\SubCategory';
            $cat = SubCategory::findOrFail($id);
        } elseif ($type == 'childcategory') {
            $attributable_type = 'App\ChildCategory';
            $cat = ChildCategory::findOrFail($id);
        }
        return view('admin.attribute.create',compact('cat','attributable_type'));
    }


    public function store(Request $request, $id)
    {
        $request->validate([
            'name'             =>'required|max:255',
            'attributable_type'=>'required|in:App\Category,App\SubCategory,App\ChildCategory',
        ]);

        $input = $request->all();
        $input['slug']                 = Str::slug($request->input('name'));
        $input['input_name']           = Str::slug($request->name, '_');
        $input['attributable_id']      = $id;
        $input['attributable_type']    = $request->attributable_type;
        
        $attr = Attribute::create($input);

        $options = $request->options;
          foreach ($options as $opt) {
            $attrOpt = new AttributeOption;
            $attrOpt->attribute_id = $attr->id;
            $attrOpt->name = $opt;
            $attrOpt->slug = Str::slug($opt,'_');
            $attrOpt->save();
        }
        return redirect()->back()->with('success','New Attribute Has Been Added');
    }

    public function manage($id)
    {
        $type = request()->get('type');
        if (!in_array($type, ['category','subcategory','childcategory'])) {
            return abort(404);
        }
        if ($type == 'category') {
            $attributable_type = 'App\Category';
            $cat = Category::findOrFail($id);
        } elseif ($type == 'subcategory') {
            $attributable_type = 'App\SubCategory';
            $cat = SubCategory::findOrFail($id);
        } elseif ($type == 'childcategory') {
            $attributable_type = 'App\ChildCategory';
            $cat = ChildCategory::findOrFail($id);
        }
        return view('admin.attribute.manage',compact('cat','attributable_type'));
    }

    public function edit($id)
    {
        $attribute = Attribute::findOrFail($id);
        return view('admin.attribute.edit',compact('attribute'));
    }


    public function update(Request $request, $id)
    {
        //--- Validation Section
       $request->validate([
            'name'             =>'required|max:255',
            'options.*' => 'required',
            'options' => 'required'
        ]);


      $attr = Attribute::findOrFail($id);
      $attr->name = $request->name;
      $attr->slug = Str::slug($request->name);
      $attr->input_name = Str::slug($request->name, '_');

      $attr->save();

      $attrOpts = AttributeOption::where('attribute_id', $id);
      $attrOpts->delete();

      $options = $request->options;

        foreach ($options as $opt) {
            $attrOpt = new AttributeOption;
            $attrOpt->attribute_id = $attr->id;
            $attrOpt->name = $opt;
            $attrOpt->slug = Str::slug($opt,'_');
            $attrOpt->save();
        }

      return redirect()->route('admin.attributes.edit',$attr->id)->with('success','Attribute Has Been Updated!');
    }


    public function destroy($id)
    {
        $attr = Attribute::findOrFail($id);
        $attr->attribute_options()->delete();
        $attr->delete();
        return back()->with('success','Attribute has been deleted!');
    }
}
