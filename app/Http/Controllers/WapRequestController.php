<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\WapRequest;
use App\Models\Template;
use App\MyApp;
use Carbon\Carbon;

class WapRequestController extends Controller
{
    public function index()
    {
        $template = Template::where(['status'=>MyApp::STATUS])->get();
        $wap_request = WapRequest::join("users","users.id","=","wap_requests.user_id")
                            ->join("templates","templates.id","=","wap_requests.template_id")
                            ->where("wap_requests.user_id","=", session('USER_ID'))
                            ->where("wap_requests.approve","=", 0)
                            ->get(['wap_requests.*','users.user_name', 'templates.template_name']);

        $approve_wap_request = WapRequest::join("users","users.id","=","wap_requests.user_id")
                            ->join("templates","templates.id","=","wap_requests.template_id")
                            ->join("admins","admins.id","=","wap_requests.approve_by")
                            ->where("wap_requests.user_id","=", session('USER_ID'))
                            ->where("wap_requests.approve","=", MyApp::APPROVE)
                            ->get(['wap_requests.*','users.user_name', 'templates.template_name', 'admins.name as admin_name']);

        return view('wap_request',[
            'template'=>$template,
            'wap_request'=>$wap_request,
            'approve_wap_request'=>$approve_wap_request
        ]);
    }

    public function getTemplateContent($template_id)
    {
        $data = Template::where(['id'=>$template_id])->first('template_content');
        return response()->json([
            'data'=>$data
        ]);
    }

    public function saveWapRequest(Request $req)
    {
        $validator = Validator::make($req->all(),[
            //'client_mobile' => 'required|unique:wap_request,client_mobile,'.$req->input('client_mobile'),
            'client_mobile' => 'required|max:191',
            'template_id' => 'required',
            'message' => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{
            $model = new WapRequest ;
            $model->user_id = session('USER_ID');
            $model->client_mobile = $req->input('client_mobile');
            $model->template_id = $req->input('template_id');
            $model->message = $req->input('message');
            $model->request_date = date('Y-m-d');
            $model->request_time = date('g:i:s A');
            $model->save();
            return response()->json([
                'status'=>200
            ]);
        }
    }

    public function editWapRequest($wap_request_id)
    {
        $wap_request = WapRequest::find($wap_request_id);
        return response()->json([
            'status'=>200,
            'wap_request'=>$wap_request
        ]);
    }

    public function updateWapRequest(Request $req, $wap_request_id)
    {
        $validator = Validator::make($req->all(),[
            'client_mobile' => 'required|max:191',
            'template_id' => 'required',
            'message' => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{
            $model = WapRequest::find($wap_request_id) ;
            $model->user_id = session('USER_ID');
            $model->client_mobile = $req->input('client_mobile');
            $model->template_id = $req->input('template_id');
            $model->message = $req->input('message');
            $model->request_date = date('Y-m-d');
            $model->request_time = date('g:i:s A');
            $model->save();
            return response()->json([
                'status'=>200
            ]);
        }
    }

    public function deleteWapRequest($wap_request_id)
    {
        $model = WapRequest::find($wap_request_id); 
        $model->delete();
        return response()->json([
            'status'=>200
        ]);
    }

    public function approveWapRequest($wap_request_id)
    {
        $model = WapRequest::find($wap_request_id);
        $model->approve_by = session('ADMIN_ID'); 
        $model->approve = MyApp::APPROVE; 
        $model->approve_date = date('Y-m-d');
        $model->approve_time = date('g:i:s A');
        $model->save();
        return response()->json([
            'status'=>200
        ]);
    }

    public function rejectWapRequest(Request $req, $wap_request_id)
    {
        $validator = Validator::make($req->all(),[
            'reject_msg' => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }else{
            $model = WapRequest::find($wap_request_id) ;
            $model->reject = MyApp::STATUS;
            $model->reject_msg = $req->input('reject_msg');
            // $model->reject_date = date('Y-m-d');
            // $model->reject_time = date('g:i:s A');
            $model->save();
            return response()->json([
                'status'=>200
            ]);
        }
    }
}
