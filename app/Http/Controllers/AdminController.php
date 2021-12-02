<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index(Request $req)
    {
        if($req->session()->has('ADMIN_LOGIN'))
        {
            return redirect('admin/dashboard');
        }else{
            return view('admin.login');
        }
        return view('admin.login');
    }

    public function adminAuth(Request $req)
    {
        $email = $req->input('email');
        $password = $req->input('password');

        $result = Admin::where(['email'=>$email])->first();
        if($result)
        {
            if(Hash::check($req->input('password'),$result->password))
            {
                $req->session()->put('ADMIN_LOGIN', true);
                $req->session()->put('ADMIN_ID', $result->id);
                $req->session()->put('ADMIN_NAME', $result->name);
                $req->session()->put('ADMIN_ROLE', $result->role);
                return redirect('/admin/dashboard');
            }else{
                $req->session()->flash('error','Please enter valid password');
                return redirect('/admin');
            }
        }else{
            $req->session()->flash('error','Please enter valid login details');
            return redirect('/admin');
        }
    }

    public function wapAdmin()
    {
        return view('admin.wap_admin');
    }


    public function logout(Request $req)
    {
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');
        session()->forget('ADMIN_NAME');
        session()->forget('ADMIN_ROLE');
        session()->flash('msg','Logout successfully'); 
        return redirect('/admin');
    }
}
