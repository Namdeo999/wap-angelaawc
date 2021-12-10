<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WapRequest;
use App\Models\Template;
use App\MyApp;

class DashboardController extends Controller
{
    public function index(Request $req)
    {
        $wap_request = WapRequest::join("users","users.id","=","wap_requests.user_id")
                            ->join("templates","templates.id","=","wap_requests.template_id")
                            ->where("wap_requests.approve","=", 0)
                            ->get(['wap_requests.*','users.user_name', 'templates.template_name']);
        return view('admin/dashboard',[
            'wap_request'=>$wap_request
        ]);
    }


    //user dashboard
    public function userDashboard(Request $req)
    {
        return view('/dashboard');
    }
}
