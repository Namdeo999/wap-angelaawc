<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;

use App\Models\User;

class UserController extends Controller
{
    
    public function userAuth(Request $req)
    {
        
 
    }

    public function index(Request $req)
    {
        $users = User::all();
        return view('admin.user', [
            'users'=>$users
        ]);

        //return view('admin.user');
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

}
