<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Validator;

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
        $admins = Admin::all();
        return view('admin.wap_admin', [
            'admins'=>$admins
        ]);
    }

    public function saveAdmin(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'name' => 'required|max:191',
            'email' => 'required|unique:admins,email,'.$req->input('email'),
            'password' => 'required|max:191',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{

            $model = new Admin ;
            $model->admin_role = $req->input('admin_role');
            $model->name = ucwords($req->input('name'));
            $model->email = $req->input('email');
            $model->password = Hash::make($req->input('password'));
            $model->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }

    public function editAdmin($admin_id)
    {
        $admin = Admin::find($admin_id);
        return response()->json([
            'status'=>200,
            'admin'=>$admin
        ]);
    }

    public function updateAdmin(Request $req, $admin_id)
    {
        $validator = Validator::make($req->all(),[
            'name' => 'required|max:191',
            'email' => 'required|unique:admins,email,'.$admin_id,
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{

            $model = Admin::find($admin_id) ;
            $model->admin_role = $req->input('admin_role');
            $model->name = ucwords($req->input('name'));
            $model->email = $req->input('email');
            if(!empty($req->input('password'))){
                $model->password = Hash::make($req->input('password'));
            }
            $model->save();
            return response()->json([
                'status'=>200
            ]);
        }
    }

    public function deleteAdmin($admin_id)
    {
        $model = Admin::find($admin_id); 
        $model->delete();
        return response()->json([
            'status'=>200,
        ]);
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
