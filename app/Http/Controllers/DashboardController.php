<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\WapRequest;
use App\Models\Template;
use App\Models\User;
use App\MyApp;

class DashboardController extends Controller
{
    //admin dashboard
    public function index($status="")
    {
        if($status == MyApp::APPROVE_FILTER){
            $all_wap_request = WapRequest::join('users','wap_requests.user_id','=','users.id')
                        ->leftjoin('admins','wap_requests.approve_by','=','admins.id')
                        ->join('templates','wap_requests.template_id','=','templates.id')
                        ->where('wap_requests.approve', MyApp::APPROVE)
                        ->get(['wap_requests.*','users.user_name','admins.name as admin_name','templates.template_name']);
        }elseif ($status == MyApp::PENDING_FILTER) {
            $all_wap_request = WapRequest::join('users','wap_requests.user_id','=','users.id')
                        ->leftjoin('admins','wap_requests.approve_by','=','admins.id')
                        ->join('templates','wap_requests.template_id','=','templates.id')
                        ->where('wap_requests.approve', MyApp::PENDING)
                        ->where('wap_requests.reject', MyApp::PENDING)
                        ->get(['wap_requests.*','users.user_name','admins.name as admin_name','templates.template_name']);
        }elseif ($status == MyApp::REJECT_FILTER) {
            $all_wap_request = WapRequest::join('users','wap_requests.user_id','=','users.id')
                        ->leftjoin('admins','wap_requests.approve_by','=','admins.id')
                        ->join('templates','wap_requests.template_id','=','templates.id')
                        ->where('wap_requests.reject', MyApp::REJECT)
                        ->get(['wap_requests.*','users.user_name','admins.name as admin_name','templates.template_name']);
        }else{
            $all_wap_request = WapRequest::join('users','wap_requests.user_id','=','users.id')
                        ->leftjoin('admins','wap_requests.approve_by','=','admins.id')
                        ->join('templates','wap_requests.template_id','=','templates.id')
                        ->get(['wap_requests.*','users.user_name','admins.name as admin_name','templates.template_name']);
        }

        

        return view('admin.dashboard',[
            'all_wap_request'=>$all_wap_request
        ]);
    }

    public function allWapRequestCount()
    {
        $total_request_count = WapRequest::all()->count();
        $approved_wap_request = WapRequest::where(['approve'=>MyApp::APPROVE])->count();
        $reject_wap_request = WapRequest::where(['reject'=>MyApp::STATUS])->count();
        $wap_users = User::all()->count();

        return response()->json([
            'status'=>200,
            'total_request_count'=>$total_request_count,
            'approved_wap_request'=>$approved_wap_request,
            'reject_wap_request'=>$reject_wap_request,
            'wap_users'=>$wap_users
        ]);
    }

    
    //user dashboard
    public function userDashboard(Request $req)
    {
        return view('/dashboard');
    }
}
