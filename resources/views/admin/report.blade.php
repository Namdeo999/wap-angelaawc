@extends('layouts.app')
@section('page_title', 'Report')
    
@section('content')
    <div class="row"></div>
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            <select name="user_id" id="user_id" filter-type="{{MyApp::USER_TYPE}}" class="form-select form-select-sm">
                                <option disabled selected id="select_user">Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->user_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="admin_id" id="admin_id" filter-type="{{MyApp::ADMIN_TYPE}}" class="form-select form-select-sm">
                                <option disabled selected id="select_admin">Select Admin</option>
                                @foreach ($admins as $admin)
                                    <option value="{{$admin->id}}">{{$admin->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-1">
                            <a href="{{url('admin/report')}}" class="btn btn-dark btn-sm " >Reset</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> <b>Reports</b> </h3>
                </div>
                <div class="card-body table-responsive p-0" style="height: 450px;">
                    
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Req ID</th>
                                <th>Client No</th>
                                <th>Template</th>
                                <th>User Name</th>
                                <th>Manager</th>
                            </tr>
                        </thead>
                        
                        <tbody id="report_filter">
                            {{$count = ""}}
                            @foreach ($wap_request as $item)
                                <tr>
                                    <td >{{++$count}}</td>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->client_mobile}}</td>
                                    <td>{{$item->template_name}}</td>
                                    <td>
                                        <div>{{$item->user_name}}</div>
                                        <small class="dt_color">{{date('d-m-Y', strtotime($item->request_date)) . " " . $item->request_time}}</small>
                                    </td>
                                    <td>
                                        <div>{{$item->admin_name}}</div>
                                        <small class="dt_color">{{date('d-m-Y', strtotime($item->approve_date)) . " " . $item->approve_time}}</small>
                                    </td>
                                    <td class="hide" id="wap_message_{{$item->id}}">{{$item->message}}</td>
                                    {{-- <td>
                                        <button type="button" class="btn btn-info btn-sm previewBtn" value="{{$item->id}}">Preview</button>
                                        <button type="button" class="btn btn-primary btn-sm approveBtn" value="{{$item->id}}">Approve</button>
                                        <button type="button" class="btn btn-danger btn-sm rejectBtn" value="{{$item->id}}">Reject</button>
                                        
                                    </td> --}}
                                    
                                    {{-- <div class="modal fade" id="wapRequestDetailModal_{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel"><span>[ {{$item->id}} ]</span> User Name - {{$item->user_name}} </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row mb-1">
                                                        <div class="col-md-6">
                                                            <div class="card border-info mb-3" >
                                                                <div class="card-body">
                                                                    <small>Client Mobile</small>
                                                                    <b><p class="card-text">{{$item->client_mobile}}</p></b>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="card border-info mb-3" >
                                                                <div class="card-body">
                                                                    <small>Template Name</small>
                                                                    <b><p class="card-text">{{$item->template_name}}</p></b>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <div class="col-md-12">
                                                                <textarea name="message" rows="10" class="form-control" disabled>{{$item->message}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        
                </div>

            </div>
        </div>

        
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {

            $(document).on('change','#user_id', function () {
                $('#admin_id').val("");
                $('#select_admin').prop("selected", true);
                const filter_type = $(this).attr('filter-type');
                const id = $(this).val();
                reportFilter(filter_type, id);
            });
            $(document).on('change','#admin_id', function () {
                $('#user_id').val("");
                $('#select_user').prop("selected", true);
                const filter_type = $(this).attr('filter-type');
                const id = $(this).val();
                reportFilter(filter_type, id);
            });

        });

        function reportFilter(filter_type, id) {
            $.ajax({
                type: "get",
                url: "get-report-filter/"+filter_type+"/"+id,
                dataType: "json",
                success: function (response) {
                    //console.log(response);
                    if (response.status == 200) {
                        $('#report_filter').html("");
                        $('#report_filter').append(response.html);

                    }
                }
            });
        }
    </script>
@endsection