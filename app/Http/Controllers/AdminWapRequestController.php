<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Http;
use App\Models\WapRequest;
use App\Models\Template;
use App\MyApp;

class AdminWapRequestController extends Controller
{
    public function index(Request $req)
    {
        //https://web.whatsapp.com/send?phone=9479505099&text&app_absent=0
        //file_get_contents("http://bulk.sms-india.in/unified.php?key=nl1571kj43s43S4NLKJ41571&ph=".$all_mobile_number."&sndr=IGSIND&text=".rawurlencode($message));           

        $wap_request = WapRequest::join("users","users.id","=","wap_requests.user_id")
                            ->join("templates","templates.id","=","wap_requests.template_id")
                            ->where("wap_requests.approve","=", 0)
                            ->where("wap_requests.reject","=", 0)
                            ->get(['wap_requests.*','users.user_name', 'templates.template_name']);

        $approved_wap_request = WapRequest::join("users","users.id","=","wap_requests.user_id")
                            ->join("templates","templates.id","=","wap_requests.template_id")
                            ->where("wap_requests.approve","=", MyApp::APPROVE)
                            ->take(100)
                            ->orderBy('approve_date', 'desc')
                            ->get(['wap_requests.*','users.user_name', 'templates.template_name']);

        $reject_wap_request = WapRequest::join("users","users.id","=","wap_requests.user_id")
                            ->join("templates","templates.id","=","wap_requests.template_id")
                            ->where("wap_requests.reject","=", MyApp::STATUS)
                            ->get(['wap_requests.*','users.user_name', 'templates.template_name']);

        return view('admin/admin_wap_request',[
            'wap_request'=>$wap_request,
            'approved_wap_request'=>$approved_wap_request,
            'reject_wap_request'=>$reject_wap_request
        ]);
    }

    public function sendMessage(Request $req)
    {
        $number = $req->input('number');
        $msg = $req->input('msg');
        $url = "https://api.whatsapp.com/send?phone=91".$number."&text=".$msg;


        
        //$data = Http::get("https://api.whatsapp.com/send?phone=91".$number."&text=".$msg );
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, 0);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // $response = curl_exec ($ch);
        // $err = curl_error($ch);  //if you need
        // curl_close ($ch);
        // return $response;


        //https://wa.me/919479505099
        // return response()->json([
        //     'data'=>"ok"
        // ]);
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
            
            foreach (explode(',',$wap_request_id) as $key => $id) {
                $model = WapRequest::find($id) ;
                $model->reject = MyApp::STATUS;
                $model->reject_msg = $req->input('reject_msg');
                // $model->reject_date = date('Y-m-d');
                // $model->reject_time = date('g:i:s A');
                $model->save();
            }
            return response()->json([
                'status'=>200
            ]);

            // $model = WapRequest::find($wap_request_id) ;
            // $model->reject = MyApp::STATUS;
            // $model->reject_msg = $req->input('reject_msg');
            // // $model->reject_date = date('Y-m-d');
            // // $model->reject_time = date('g:i:s A');
            // $model->save();
            // return response()->json([
            //     'status'=>200
            // ]);
        }
    }

}
