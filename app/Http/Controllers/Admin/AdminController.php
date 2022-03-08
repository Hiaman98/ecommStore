<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
            $data = $request->all();

            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
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
}

