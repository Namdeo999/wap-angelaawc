<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\WapRequest;
use App\Models\Template;
use App\MyApp;

class DashboardController extends Controller
{
    public function index(Request $req)
    {
        //https://web.whatsapp.com/send?phone=9479505099&text&app_absent=0
        //file_get_contents("http://bulk.sms-india.in/unified.php?key=nl1571kj43s43S4NLKJ41571&ph=".$all_mobile_number."&sndr=IGSIND&text=".rawurlencode($message));           

        $wap_request = WapRequest::join("users","users.id","=","wap_requests.user_id")
                            ->join("templates","templates.id","=","wap_requests.template_id")
                            ->where("wap_requests.approve","=", 0)
                            ->get(['wap_requests.*','users.user_name', 'templates.template_name']);
        return view('admin/dashboard',[
            'wap_request'=>$wap_request
        ]);
    }

    public function sendMessage(Request $req)
    {
        $number = $req->input('number');
        $msg = $req->input('msg');
        $url = "https://api.whatsapp.com/send?phone=91".$number."&text=".$msg;

        //$data = Http::get("https://api.whatsapp.com/send?phone=91".$number."&text=".$msg );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec ($ch);
        $err = curl_error($ch);  //if you need
        curl_close ($ch);
        return $response;


        //https://wa.me/919479505099
        // return response()->json([
        //     'data'=>"ok"
        // ]);
    }


    //user dashboard
    public function userDashboard(Request $req)
    {
        return view('/dashboard');
    }
}
