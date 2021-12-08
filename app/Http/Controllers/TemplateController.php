<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Template;
use App\MyApp;


class TemplateController extends Controller
{
    //
    public function index(Request $req)
    {
        $templates = Template::all();
        return view('admin.template',[
            'templates'=>$templates
        ]);
    }

    public function saveTemplate(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'template_name' => 'required|unique:templates,template_name,'.$req->input('template_name'),
            'template_content' => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{
            $model = new Template ;
            $model->template_name = ucwords($req->input('template_name'));
            $model->template_content = $req->input('template_content');
            $model->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
}
