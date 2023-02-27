<?php

namespace App\Http\Controllers\Admin;

use App\Faq;
use DataTables;
use App\PaymentWithdraw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:can manage pages']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function datatables()
    {
     $datas = Faq::orderBy('id','desc')->get();
             //--- Integrating This Collection Into Datatables
             return Datatables::of($datas)
                                ->addColumn('action', function(Faq $data) {
                                    return  '<div class="dropdown">
                                              <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Actions
                                              </button>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="'.route("faqs.edit",$data->id).'"><i class="mdi mdi-pen"></i> Edit</a>
                                            <a class="dropdown-item t_delete" href="javascript:void(0)" data-url="'.route("faqs.destroy",$data->id).'"><i class="mdi mdi-trash-can"></i> Delete</a>
                                          </div>
                                        </div>';
                                })
                                ->rawColumns(['action','detail'])
                                ->toJson(); //--- Returning Json Data To Client Sid
    }

    public function index()
    {
        $faqs =Faq::latest()->get();
        return view('admin.faq.index',compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faq.create');
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
            'title'     => 'required|max:255',
            'detail'    => 'required',
        ]);

        $faq = Faq::create([
            'title' => $request->input('title'),
            'detail' => $request->input('detail'),
        ]);
        return redirect()->route('faqs.index')->with('success','Faq has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $faq = Faq::findOrFail($id);
       return view('admin.faq.edit',compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $faq = Faq::findOrFail($id);
        $faq->update([
            'title' => $request->input('title'),
            'detail' => $request->input('detail'),
        ]);
        return redirect()->route('faqs.index')->with('success','Faq has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Faq::findOrFail($id)->delete();
        if ($request->ajax()) {
            return response()->json([
                'msg'=>'success',
                'success'=> 'Faq has been deleted!',
            ]);
        }
        return redirect()->route('faqs.index')->with('success','Faq has been deleted!');
    }
}
