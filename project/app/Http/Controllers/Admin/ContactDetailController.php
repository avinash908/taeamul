<?php

namespace App\Http\Controllers\Admin;

use App\ContactDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:can manage pages']);
    }
    public function index()
    {
        $detail = ContactDetail::findOrFail(1);
        return view('admin.contact_detail.index',compact('detail'));
    }
    public function update(Request $request)
    {
        $detail = ContactDetail::findOrFail(1);
        $detail->update($request->all());
        return redirect()->route('admin.contact_details')->with('success','Contact Details has been updated!');
    }
}
