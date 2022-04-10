<?php

namespace App\Http\Controllers\Admin;

use App\Section;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    public function index() 
    {
        return view("admin.section.section");
    }

    public function updateSectionStatus(Request $request, $id)
    {
        try {
            Section::where("id", $id)->update(["status" => !$request->status]);
            return redirect()->back()->with('success', 'Status updated');  
    
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['message' => 'Status not updated']);
        }
    }

    public function dataTable() 
    {
        $sections = Section::all();

        return Datatables::of($sections)
        ->addColumn("status", function ($section) {
            if($section->status) {
                return '<a class="btn"><span onclick="updateSectionStatus(this) "data-status="' . $section->status . '" data-id="'. $section->id . '" class="badge badge-pill badge-success">Active</span><a>';
            } else {
                return '<a class="btn"><span onclick="updateSectionStatus(this) "data-status="' . $section->status . '" data-id="'. $section->id . '" class="badge badge-pill badge-danger">Inactive</span><a>';
            }
        })
        ->rawColumns(['status'])
        ->make(true);
    }
}
