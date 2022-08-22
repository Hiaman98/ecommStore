<?php

namespace App\Http\Controllers\Admin;

use App\Section;
use App\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index() {
        
        return view("admin.category.index");
    }

    public function destroy($id) {

        try {
            Category::destroy($id);
            return response()->json(['success' => "Category deleted successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json(["error" => "Something went wrong"],422);
        }  
    }
    
    public function updateCategoryStatus(Request $request, $id) {
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
                "parent_id" => "required",
                "image" => "image|mimes:png,jpg"
            ]);

            try {

                // Check if we have picked image, if yes then save that image else check for previous image
                if($request->hasFile("image"))
                {
                    $image = $request->file("image");

                    if($image->isValid()) {
                        $extension = $image->getClientOriginalExtension();
                        $imageName = time() . '.' . $extension;
                        $imagePath = "images/admin_images/category_image/" . $imageName;
                        $request["category_image"] = asset($imagePath);
                        //upload image
                        $image->move($imagePath, $imageName);
                    } else {
                        $imageName = "";
                    }
                }

                Category::insert($request->except(['_token', 'image']));
                return redirect()->route("admin.category.index");
            } catch (\Throwable $th) {
                return redirect()->back()->withErrors("Something went wrong, category not created");
            }
        }

        $sections = Section::where("status", true)->get();
        return view("admin.category.add", compact("sections"));
    }
    public function dataTable() 
    {
        $categories = Category::with(["parentCategory", "section"])->get();

        return Datatables::of($categories)
        ->addColumn("status", function ($category) {
            if($category->status) {
                return '<a class="btn"><span onclick="updateCategoryStatus(this) "data-status="' . $category->status . '" data-id="'. $category->id . '" class="badge badge-pill badge-success">Active</span><a>';
            } else {
                return '<a class="btn"><span onclick="updateCategoryStatus(this) "data-status="' . $category->status . '" data-id="'. $category->id . '" class="badge badge-pill badge-danger">Inactive</span><a>';
            }
        })
        ->addColumn("parent_category", function ($category) {
            if(is_null($category["parentCategory"])) {
                return "-";
            } else {
                return $category["parentCategory"]["category_name"];
            }
        })
        ->addColumn("section", function ($category) {
            if(is_null($category["section"])) {
                return "-";
            } else {
                return $category["section"]["name"];
            }
        })
        ->addColumn("action", function ($category) {
            return '<span onclick="editCategory(this)" data-id="' . $category->id . '"><i class="fas fa-edit"></i></span>
                    <span onclick="destroyCategory(this)" data-id="' . $category->id . '" class="ml-2"><i class="fas fa-trash"></i></span>';
        })
        ->rawColumns(['status', 'action'])
        ->make(true);
    }

    public function getCategoryOfSection(Request $request) {
        $request->validate([
            "section_id" => "required"
        ]);

        try {
            $categories = Category::with("subCategories")->where("section_id", $request->section_id)
            ->where("parent_id", 0)
            ->where("status", true)
            ->get()->toArray();

            return response()->json(['categories' => $categories], 200);
        } catch (\Throwable $th) {
            return response()->json(["error" => "Something went wrong"],422);
        }        
    }
}
