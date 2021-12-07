<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;

use App\Models\User;

class UserController extends Controller
{
    public function index(Request $req)
    {
        if($req->session()->has('USER_LOGIN'))
        {
            return redirect('/dashboard');
        }else{
            return view('user_login');
        }
        return view('user_login');
    }

    public function wapUser(Request $req)
    {
        $users = User::all();
        return view('admin.user', [
            'users'=>$users
        ]);

    }
    public function userAuth(Request $req)
    {
        $email = $req->input('email');
        $password = $req->input('password');

        $result = User::where(['email'=>$email])->first();
        if($result)
        {
            if(Hash::check($req->input('password'),$result->password))
            {
                $req->session()->put('USER_LOGIN', true);
                $req->session()->put('USER_ID', $result->id);
                $req->session()->put('USER_NAME', $result->user_name);
                return redirect('/dashboard');
            }else{
                $req->session()->flash('error','Please enter valid password');
                return redirect('/');
            }
        }else{
            $req->session()->flash('error','Please enter valid login details');
            return redirect('/');
        }
 
    }

    public function saveUser(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'user_name' => 'required|max:191',
            'email' => 'required|unique:users,email,'.$req->input('email'),
            'mobile' => 'required|unique:users,mobile,'.$req->input('mobile'),
            'password' => 'required|max:191',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{

            $model = new User ;
            $model->user_name = ucwords($req->input('user_name'));
            $model->email = $req->input('email');
            $model->mobile = $req->input('mobile');
            $model->password = Hash::make($req->input('password'));
            $model->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }

    public function editUser($user_id)
    {
        $user = User::find($user_id);
        return response()->json([
            'status'=>200,
            'user'=>$user
        ]);
    }

    public function updateUser(Request $req, $user_id)
    {
        $validator = Validator::make($req->all(),[
            'user_name' => 'required|max:191',
            'email' => 'required|unique:users,email,'.$user_id,
            'mobile' => 'required|unique:users,mobile,'.$user_id,
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{

            $model = User::find($user_id) ;

            $model->user_name = ucwords($req->input('user_name'));
            $model->email = $req->input('email');
            $model->mobile = $req->input('mobile');
            if(!empty($req->input('password'))){
                $model->password = Hash::make($req->input('password'));
            }
            $model->save();
            return response()->json([
                'status'=>200
            ]);
        }
    }

    public function deleteUser($user_id)
    {
        $model = User::find($user_id); 
        $model->delete();
        return response()->json([
            'status'=>200,
        ]);
    }



    public function userLogout(Request $req)
    {
        session()->forget('USER_LOGIN');
        session()->forget('USER_ID');
        session()->forget('USER_NAME');
        session()->flash('msg','Logout successfully'); 
        return redirect('/');
    }

}
