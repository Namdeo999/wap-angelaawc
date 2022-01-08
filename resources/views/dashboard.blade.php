@extends('layouts.app')
@section('page_title','Dashboard')
 
@section('content')
  
    <div class="row"></div>
    
    <div class="row mt-2">
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-table"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Request</span>
                    <span class="info-box-number">{{$total_request_count}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-tasks"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Approved</span>
                    <span class="info-box-number" >{{$approved_wap_request}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="far fa-window-close"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Rejected</span>
                    <span class="info-box-number" >{{$reject_wap_request}}</span>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Users</span>
                    <span class="info-box-number" ></span>
                </div>
            </div>
        </div> --}}
    </div>

    <div class="row">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">

                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="card-title"><b>Wap Request</b> </h3>
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="form-control form-control-sm" value="{{$today}}" id="select_date">
                        </div>
                        <div class="col-md-3">
                            <div class="card-tools ">
                                {{-- <div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
                                    <button filter-type="" class="btn btn-dark btn-sm wap_request_filter" >Clear</button>
                                    <button filter-type="{{MyApp::APPROVE_FILTER}}" class="btn btn-success wap_request_filter">Success</button>
                                    <button filter-type="{{MyApp::PENDING_FILTER}}" class="btn btn-info wap_request_filter">Pending</button>
                                    <button filter-type="{{MyApp::REJECT_FILTER}}" class="btn btn-danger wap_request_filter">Reject</button>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-md-1 d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-tool " data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus "></i>
                            </button>
                        </div>
                    </div>

                </div>
                <div class="card-body table-responsive p-0" style="height: 400px;">
                    <table class="table table-striped table-head-fixed ">
                        <thead>
                            <tr>
                                <th style="width: 2%">#</th>
                                <th style="width: 10%">Req ID</th>
                                <th style="width: 15%">Client No</th>
                                <th style="width: 30%">Template</th>
                                {{-- <th style="width: 15%">User Name</th> --}}
                                <th style="width: 15%">Approved By</th>
                                <th style="width: 10%" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody id="filter_web_request">
                            {{$count = ""}}
                            @foreach ($all_wap_request as $list)
                                <tr>
                                    <td>{{++$count}}</td>
                                    <td>{{$list->id}}</td>
                                    <td>{{$list->client_mobile}}</td>
                                    <td>
                                        <div>{{$list->template_name}}</div>
                                        <small class="dt_color">{{date('d-m-Y', strtotime($list->request_date)) . " " . $list->request_time}}</small>
                                    </td>
                                    {{-- <td>
                                        <div>{{$list->user_name}}</div>
                                    </td> --}}
                                    <td>
                                        <div>{{$list->admin_name}}</div>
                                        <small class="dt_color">{{date('d-m-Y', strtotime($list->approve_date)) . " " . $list->approve_time}}</small>
                                    </td>
                                    <td>
                                        @if ($list->approve == MyApp::APPROVE)
                                            <span class='badge badge-success'>Success</span>
                                        @elseif($list->reject == MyApp::STATUS)
                                            <span class='badge badge-danger'>Reject</span>
                                        @else
                                            <span class='badge badge-info'>Pending</span>    
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>

        </div>
    </div>

@endsection
  



    
    
