<?php

namespace App\Http\Controllers\Admin;

use App\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;


class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.reviews.fetchReviews');
    }

   
    public function edit($id)
    {
        $rev = Review::findOrFail($id);
        $view = view('admin.reviews.editReview',compact('rev'))->render();
        return response()->json(['html'=>$view]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $up = Review::where('id',$id)->firstOrFail();
        $up->update(['review'=>$request->input('revText')]);
        return response()->json(['success'=>'Review Has been Updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */

  public function destroy(Request $request,$id)
    {
       $review = Review::findOrFail($id);
       $review->delete();
       if ($request->ajax()) {
           return response()->json([
            'msg'=>'success',
            'success'=>'Review has been deleted!',
        ]);
       }
        return redirect()->route('pages.index')->with('Page has been deleted!');
    }

    public function reviewDatatable()
    {

            $datas = Review::orderBy('id','desc')->get();
             return Datatables::of($datas)
                      ->addColumn('review', function(Review $data) {
                            return $data->review;
                        })
                        ->addColumn('product', function(Review $data) {
                            $name = '<a href="'.url("/".$data->product->slug).'" target="_blank">'.$data->product->name.'</a>';
                            return $name;
                            
                        })
                        ->addColumn('user', function(Review $data) {
                            return $data->user->name;
                            
                        })
                        ->addColumn('created_at', function(Review $data) {
                            return $data->created_at->format('D M Y');
                        })
                         ->addColumn('action', function(Review $data) {
                              return  '<div class="dropdown">
                                              <button type="button" class="badge badge-dark dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Actions
                                              </button>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item editRev" href="javascript:void(0)" data-url="'.route("review.edit",$data->id).'"><i class="mdi mdi-pen"></i> Edit</a>
                                            <a class="dropdown-item t_delete" href="javascript:void(0)" data-url="'.route("review.destroy",$data->id).'"><i class="mdi mdi-trash-can"></i> Delete</a>
                                          </div>
                                        </div>';
                        })
                ->rawColumns(['review','product','user','created_at','action'])
            ->toJson();
    }
}
