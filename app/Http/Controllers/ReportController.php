<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WapRequest;
use App\Models\User;
use App\Models\Admin;
use App\MyApp;

class ReportController extends Controller
{
    
    public function index()
    {
        $users = User::all();
        $admins = Admin::all();
        $wap_request = WapRequest::join('users','wap_requests.user_id','=','users.id')
                            ->leftjoin('admins','wap_requests.approve_by','=','admins.id')
                            ->join('templates','wap_requests.template_id','=','templates.id')
                            //->where('wap_requests.request_date', $select_date)
                            ->where('wap_requests.approve', MyApp::APPROVE)
                            ->get(['wap_requests.*','users.user_name','admins.name as admin_name','templates.template_name']);
        
        // echo "<pre>";
        // print_r($wap_request);
        return view('admin.report',[
            'users'=>$users,
            'admins'=>$admins,
            'wap_request'=>$wap_request
        ]);
    }

    public function getReportFilter($user_id)
    {
        $wap_request = WapRequest::join('users','wap_requests.user_id','=','users.id')
                            ->leftjoin('admins','wap_requests.approve_by','=','admins.id')
                            ->join('templates','wap_requests.template_id','=','templates.id')
                            ->where('wap_requests.approve', MyApp::APPROVE)
                            ->where('wap_requests.user_id', $user_id)
                            ->get(['wap_requests.*','users.user_name','admins.name as admin_name','templates.template_name']);

        $html = "";
        foreach ($wap_request as $key => $item) {
            
            $html .= "<tr>";
            $html .= "<td>".++$key."</td>";
            $html .= "<td>".$item->id."</td>";
            $html .= "<td>".$item->client_mobile."</td>";
            $html .= "<td>".$item->template_name."</td>";
            $html .= "<td>";
                $html .= "<div>".$item->user_name."</div>";
                $html .= "<small class='dt_color'>".date('d-m-Y', strtotime($item->request_date)) . ' ' . $item->request_time."</small>";
            $html .="</td>";
            $html .= "<td>";
                $html .="<div>".$item->admin_name."</div>";
                $html .="<small class='dt_color'>".date('d-m-Y', strtotime($item->approve_date)) . ' ' . $item->approve_time."</small>";
            $html .="</td>";
            $html .= "<td></td>";
            $html .= "</tr>";
        }
                        
        
        //$html = reportFilterHtml($wap_request);
        return response()->json([
            'status'=>200,
            'html'=>$html,
        ]);
    }

}
