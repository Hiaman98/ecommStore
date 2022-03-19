<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboard () {
        return view("admin.dashboard");
    }

    public function login(Request $request)
    {
        // if request type is POST this function will run
        if($request->isMethod("post"))
        {
            $rules = [
                "email" => "required|email",
                "password" => "required"
            ];

            $messages = [
                'email.required' => 'The email field is required.',
                'password.required' => 'The password field is required.',
            ];
             
            $this->validate($request, $rules, $messages);

            if(Auth::guard('admin')->attempt(['email'=>$request['email'],'password'=>$request['password']])){
                return redirect('admin/dashboard');
            }else{
                Session::flash('error_message','Invalid Email or Password');
                return redirect()->back();
            }
        }

        // if request type is GET this function will run
        return view("admin.admin_login");
    }

    public function logout(Request $request)
    {
        Auth::guard("admin")->logout();
        return redirect("/admin");
    }

    public function settings(Request $request)
    {
        
        $adminDetails = Admin::where("email", Auth::guard("admin")->user()->email)->first();
        return view("admin.admin_settings", compact("adminDetails"));
    }

    public function checkCurrentPassword(Request $request)
    {
        if(Hash::check($request->currentPassword, Auth::guard("admin")->user()->password))
        {
            return "true";
        } else {
            return "false";

        }
    }

    public function updateCurrentPassword(Request $request)
    {
        $request->validate([
            "current-password" => "required",
            "confirm-password" => "required",
            "new-password" => "required",
        ]);
        

        // if current-password matches with password saved in database than update password

        if(Hash::check($request["current-password"], Auth::guard("admin")->user()->password))
        {
            if($request["current-password"] == $request["confirm-password"]) 
            {
                Admin::where("id", Auth::guard("admin")->user()->id)->update(["password" => bcrypt($request["new-password"])]);
                Session::flash("success_message",  "password updated successfully");
                return redirect()->back();
            } else {
                Session::flash("error_message", "Current password didn't matched with confirm password");
                return redirect()->back();
            }
        } else {
            Session::flash("error_message", "Current password not matched with with user password");
            return redirect()->back();

        }
    }

    public function updateAdminDetails(Request $request) 
    {
        // if request type get then show form else update admin record details
        if($request->isMethod("get"))
        {
            $adminDetails = Admin::where("email", Auth::guard("admin")->user()->email)->first();
            return view("admin.admin_update_details", compact("adminDetails"));

        } else if ($request->isMethod("post")) {

            // validate request and if request successfully validates, update admin details
            $request->validate([
                "name" => "required|string",
                "mobile" => "required|digits:10",
            ]);
            
            Admin::where("id", Auth::guard("admin")->user()->id)->update([
                "name" => $request->name,
                "mobile" => $request->mobile
            ]);

            Session::flash("success_message", "Record updated successfully");
            return redirect()->back();
        }
    }
}

