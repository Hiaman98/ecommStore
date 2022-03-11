<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Admin;
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
}

