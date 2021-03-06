<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index() {
        return view("admin.category.index");
    }

    public function updateCategoryStatus(Request $request, $id)
    {
        try {
            Category::where("id", $id)->update(["status" => !$request->status]);
            return redirect()->back()->with('success', 'Status updated');  
    
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['message' => 'Status not updated']);
        }
    }

    public function store(Request $request) {

        // if method type is post then store data in database else return "add category page"
        if($request->isMethod("post")) {
            $request->validate([
                "category_name" => "required",
                "section_id" => "required",
                "category_discount" => "required",
                "parent_id" => "required"
            ]);

            try {
                Category::insert($request->except('_token'));
                return redirect()->route("admin.category.index");
            } catch (\Throwable $th) {
                return redirect()->back()->withErrors("Something went wrong, category not created");
            }

        }

        return view("admin.category.add");
    }
    public function dataTable() 
    {
        $categories = Category::all();

        return Datatables::of($categories)
        ->addColumn("status", function ($category) {
            if($category->status) {
                return '<a class="btn"><span onclick="updateCategoryStatus(this) "data-status="' . $category->status . '" data-id="'. $category->id . '" class="badge badge-pill badge-success">Active</span><a>';
            } else {
                return '<a class="btn"><span onclick="updateCategoryStatus(this) "data-status="' . $category->status . '" data-id="'. $category->id . '" class="badge badge-pill badge-danger">Inactive</span><a>';
            }
        })
        ->rawColumns(['status'])
        ->make(true);
    }
}
