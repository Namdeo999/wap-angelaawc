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
        $total_request_count = WapRequest::all()->count();
        $approved_wap_request = WapRequest::where(['approve'=>MyApp::APPROVE])->count();
        $reject_wap_request = WapRequest::where(['reject'=>MyApp::STATUS])->count();
        $wap_users = User::all()->count();

        // if($status == MyApp::APPROVE_FILTER){
        //     $all_wap_request = WapRequest::join('users','wap_requests.user_id','=','users.id')
        //                 ->leftjoin('admins','wap_requests.approve_by','=','admins.id')
        //                 ->join('templates','wap_requests.template_id','=','templates.id')
        //                 ->where('wap_requests.approve', MyApp::APPROVE)
        //                 ->get(['wap_requests.*','users.user_name','admins.name as admin_name','templates.template_name']);
        // }elseif ($status == MyApp::PENDING_FILTER) {
        //     $all_wap_request = WapRequest::join('users','wap_requests.user_id','=','users.id')
        //                 ->leftjoin('admins','wap_requests.approve_by','=','admins.id')
        //                 ->join('templates','wap_requests.template_id','=','templates.id')
        //                 ->where('wap_requests.approve', MyApp::PENDING)
        //                 ->where('wap_requests.reject', MyApp::PENDING)
        //                 ->get(['wap_requests.*','users.user_name','admins.name as admin_name','templates.template_name']);
        // }elseif ($status == MyApp::REJECT_FILTER) {
        //     $all_wap_request = WapRequest::join('users','wap_requests.user_id','=','users.id')
        //                 ->leftjoin('admins','wap_requests.approve_by','=','admins.id')
        //                 ->join('templates','wap_requests.template_id','=','templates.id')
        //                 ->where('wap_requests.reject', MyApp::REJECT)
        //                 ->get(['wap_requests.*','users.user_name','admins.name as admin_name','templates.template_name']);
        // }else{
        //     $all_wap_request = WapRequest::join('users','wap_requests.user_id','=','users.id')
        //                 ->leftjoin('admins','wap_requests.approve_by','=','admins.id')
        //                 ->join('templates','wap_requests.template_id','=','templates.id')
        //                 ->get(['wap_requests.*','users.user_name','admins.name as admin_name','templates.template_name']);
        // }

        $today = date('Y-m-d');
        $all_wap_request = WapRequest::join('users','wap_requests.user_id','=','users.id')
                        ->leftjoin('admins','wap_requests.approve_by','=','admins.id')
                        ->join('templates','wap_requests.template_id','=','templates.id')
                        ->where('wap_requests.request_date', $today)
                        ->get(['wap_requests.*','users.user_name','admins.name as admin_name','templates.template_name']);

       
        return view('admin.dashboard',[
            'all_wap_request'=>$all_wap_request,
            'total_request_count'=>$total_request_count,
            'approved_wap_request'=>$approved_wap_request,
            'reject_wap_request'=>$reject_wap_request,
            'wap_users'=>$wap_users,
            'today'=>$today
            
        ]);
    }

    public function wapRequestFilter($select_date="", $filter_type="")
    {
        
            if($filter_type == MyApp::APPROVE_FILTER){
                // $condition = 'wap_requests.approve';
                // $type = MyApp::APPROVE;
                $filter_wap_request = WapRequest::join('users','wap_requests.user_id','=','users.id')
                            ->leftjoin('admins','wap_requests.approve_by','=','admins.id')
                            ->join('templates','wap_requests.template_id','=','templates.id')
                            ->where('wap_requests.request_date', $select_date)
                            ->where('wap_requests.approve', MyApp::APPROVE)
                            ->get(['wap_requests.*','users.user_name','admins.name as admin_name','templates.template_name']);
            }elseif ($filter_type == MyApp::PENDING_FILTER) {
                    $filter_wap_request = WapRequest::join('users','wap_requests.user_id','=','users.id')
                            ->leftjoin('admins','wap_requests.approve_by','=','admins.id')
                            ->join('templates','wap_requests.template_id','=','templates.id')
                            ->where('wap_requests.request_date', $select_date)
                            ->where('wap_requests.approve', MyApp::PENDING)
                            ->where('wap_requests.reject', MyApp::PENDING)
                            ->get(['wap_requests.*','users.user_name','admins.name as admin_name','templates.template_name']);
            }elseif ($filter_type == MyApp::REJECT_FILTER) {
                    $filter_wap_request = WapRequest::join('users','wap_requests.user_id','=','users.id')
                                ->leftjoin('admins','wap_requests.approve_by','=','admins.id')
                                ->join('templates','wap_requests.template_id','=','templates.id')
                                ->where('wap_requests.request_date', $select_date)
                                ->where('wap_requests.reject', MyApp::REJECT)
                                ->get(['wap_requests.*','users.user_name','admins.name as admin_name','templates.template_name']);
            }
            elseif ($filter_type == null) {
                return response()->json([
                    'status'=>400,
                ]);
            }

        $html = "";
        $count = "";
        foreach ($filter_wap_request as $key => $list) {
            $html .= "<tr>"; 
                $html .= "<td>".++$count."</td>"; 
                $html .= "<td>".$list->id."</td>"; 
                $html .= "<td>".$list->client_mobile."</td>"; 
                $html .= "<td>".$list->template_name."</td>"; 
                $html .= "<td>";
                    $html .="<div>".$list->user_name."</div>";
                    $html .="<small class='dt_color'>" .date('d-m-Y', strtotime($list->request_date)) . ' ' . $list->request_time ."</small>";
                $html .="</td>";
                $html .= "<td>";
                    $html .="<div>".$list->admin_name."</div>";
                    $html .="<small class='dt_color'>" .date('d-m-Y', strtotime($list->approve_date)) . ' ' . $list->approve_time ."</small>";
                $html .="</td>"; 
                    if($list->approve == MyApp::APPROVE){
                        $html .="<td><span class='badge badge-success'>Success</span></td>";
                    }elseif ($list->reject == MyApp::REJECT) {
                        $html .="<td><span class='badge badge-danger'>Reject</span></td>";
                    }else{
                        $html .="<td><span class='badge badge-info'>Pending</span></td>";
                    }
                $html .="</td>"; 
                
            $html .= "</tr>"; 
        }

        return response()->json([
            'status'=>200,
            'filter_type'=>$filter_type,
            'filter_html'=>$html,
        ]);
    }

    public function wapRequestDateFilter($select_date="")
    {
        
        $filter_wap_request = WapRequest::join('users','wap_requests.user_id','=','users.id')
                    ->leftjoin('admins','wap_requests.approve_by','=','admins.id')
                    ->join('templates','wap_requests.template_id','=','templates.id')
                    ->where('wap_requests.request_date', $select_date)
                    ->get(['wap_requests.*','users.user_name','admins.name as admin_name','templates.template_name']);
        

        $html = "";
        $count = "";
        foreach ($filter_wap_request as $key => $list) {
            $html .= "<tr>"; 
                $html .= "<td>".++$count."</td>"; 
                $html .= "<td>".$list->id."</td>"; 
                $html .= "<td>".$list->client_mobile."</td>"; 
                $html .= "<td>".$list->template_name."</td>"; 
                $html .= "<td>";
                    $html .="<div>".$list->user_name."</div>";
                    $html .="<small class='dt_color'>" .date('d-m-Y', strtotime($list->request_date)) . ' ' . $list->request_time ."</small>";
                $html .="</td>";
                $html .= "<td>";
                    $html .="<div>".$list->admin_name."</div>";
                    $html .="<small class='dt_color'>" .date('d-m-Y', strtotime($list->approve_date)) . ' ' . $list->approve_time ."</small>";
                $html .="</td>"; 
                    if($list->approve == MyApp::APPROVE){
                        $html .="<td><span class='badge badge-success'>Success</span></td>";
                    }elseif ($list->reject == MyApp::REJECT) {
                        $html .="<td><span class='badge badge-danger'>Reject</span></td>";
                    }else{
                        $html .="<td><span class='badge badge-info'>Pending</span></td>";
                    }
                $html .="</td>"; 
                
            $html .= "</tr>"; 
        }

        return response()->json([
            'status'=>200,
            'select_date'=>$select_date,
            'filter_html'=>$html,
        ]);
    }

    // public function allWapRequestCount()
    // {
    //     $total_request_count = WapRequest::all()->count();
    //     $approved_wap_request = WapRequest::where(['approve'=>MyApp::APPROVE])->count();
    //     $reject_wap_request = WapRequest::where(['reject'=>MyApp::STATUS])->count();
    //     $wap_users = User::all()->count();

    //     return response()->json([
    //         'status'=>200,
    //         'total_request_count'=>$total_request_count,
    //         'approved_wap_request'=>$approved_wap_request,
    //         'reject_wap_request'=>$reject_wap_request,
    //         'wap_users'=>$wap_users
    //     ]);
    // }

    
    //user dashboard
    public function userDashboard(Request $req)
    {
        return view('/dashboard');
    }
}
