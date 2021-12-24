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
    public function index()
    {
        return view('admin.dashboard');
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

    public function allWapRequest()
    {
        $all_wap_request = WapRequest::join('users','wap_requests.user_id','=','users.id')
                        ->leftjoin('admins','wap_requests.approve_by','=','admins.id')
                        ->join('templates','wap_requests.template_id','=','templates.id')
                        ->get(['wap_requests.*','users.user_name','admins.name as admin_name','templates.template_name']);
        $html = "";
        $count = "";
        foreach ($all_wap_request as $key => $list) {
            $html .= "<tr>";
                $html .= "<td>".++$count."</td>";
                $html .= "<td>".$list->id."</td>";
                $html .= "<td>".$list->client_mobile."</td>";
                $html .= "<td>".$list->template_name."</td>";
                $html .= "<td>".$list->user_name."</td>";
                $html .= "<td>".$list->admin_name."</td>";
                if ($list->approve == MyApp::APPROVE) {
                    $html .= "<td><span class='badge badge-success'>Success</span></td>";
                }elseif($list->reject == MyApp::STATUS) {
                    $html .= "<td><span class='badge badge-danger'>Reject</span></td>";
                }else{
                    $html .= "<td><span class='badge badge-info'>Pending</span></td>";
                }
                $html .= "<td>Action</td>";
            $html .= "</tr>";
        }



        return response()->json([
            'status'=>200,
            'all_wap_request'=>$all_wap_request,
            'html'=>$html
        ]);
    }





    //user dashboard
    public function userDashboard(Request $req)
    {
        return view('/dashboard');
    }
}
