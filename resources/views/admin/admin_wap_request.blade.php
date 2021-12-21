@extends('layouts.app')
@section('page_title','Dashboard')


@section('style')
<style>
    .wap_request_row{
        cursor: pointer;
    }
    
</style>
@endsection

 
@section('content')

    <div class="modal fade" id="rejectWapRequestModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Reject Message </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="rejectWapRequestForm">
                @csrf
                <div class="modal-body">
                    <div id="reject_wap_request_err"></div>
                    {{-- <input type="hidden" name="wap_request_id" id="wap_request_id"> --}}
                    <div class="row">
                        <textarea class="form-control" name="reject_msg" id="reject_msg" placeholder="Leave a comment here" style="height: 150px"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="submitRejectWapRequestBtn" class="btn btn-primary btn-sm ">Reject</button>
                </div>
            </form>
        </div>
        </div>
    </div>

  <div class="row mt-2"></div>
  
    <div class="row mt-2">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> <b>Pending Wap Request</b> </h3>
                </div>
                <div class="card-body table-responsive p-0" style="height: 450px;">
                    
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Req ID</th>
                                <th>User Name</th>
                                {{-- <th>Template</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            {{$count = ""}}
                            @foreach ($wap_request as $item)
                                <tr>
                                    <td >{{++$count}}</td>
                                    <td>{{$item->id}}</td>
                                    <td>
                                        <div>{{$item->user_name}}</div>
                                        <small class="dt_color">{{date('d-m-Y', strtotime($item->request_date)) . " " . $item->request_time}}</small>
                                    </td>
                                    <td class="hide">{{$item->template_name}}</td>
                                    <td class="hide">{{$item->client_mobile}}</td>
                                    <td class="hide" id="wap_message_{{$item->id}}">{{$item->message}}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm previewBtn" value="{{$item->id}}">Preview</button>
                                        <a class="btn btn-primary btn-sm" href="https://wa.me/91{{$item->client_mobile}}?text={{rawurlencode($item->message)}}" target="_blank">Send Msg</a>
                                        {{-- <button type="button" class="btn btn-primary btn-sm sendBtn" value="{{$item->id}}">Send</button> --}}
                                        <button type="button" class="btn btn-primary btn-sm approveBtn" value="{{$item->id}}">Approve</button>
                                        <button type="button" class="btn btn-danger btn-sm rejectBtn" value="{{$item->id}}">Reject</button>
                                        
                                    </td>
                                    
                                    <div class="modal fade" id="wapRequestDetailModal_{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                    </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> <b>Approved Wap Request</b> </h3>
                </div>
                <div class="card-body table-responsive p-0" style="height: 450px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Req ID</th>
                                <th>User Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            {{$count = ""}}
                            @foreach ($approved_wap_request as $item)
                                <tr wap_request_id="{{$item->id}}">
                                    <td >{{++$count}}</td>
                                    <td>{{$item->id}}</td>
                                    <td>
                                        <div>{{$item->user_name}}</div>
                                        <small class="dt_color">{{date('d-m-Y', strtotime($item->approve_date)) . " " . $item->approve_time}}</small>
                                    </td>
                                    <td> 
                                        @if ($item->approve == MyApp::APPROVE)
                                            <span class="badge bg-success text-dark">Approved</span>
                                        @endif
                                    </td>
                                    <td class="hide">{{$item->template_name}}</td>
                                    <td class="hide">{{$item->client_mobile}}</td>
                                    <td class="hide" id="wap_message_{{$item->id}}">{{$item->message}}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm previewBtn" value="{{$item->id}}">Preview</button>     
                                    </td>
                                    
                                    <div class="modal fade" id="wapRequestDetailModal_{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                    </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        
                </div>

            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> <b>Rejected Wap Request</b> </h3>
                </div>
                <div class="card-body table-responsive p-0" style="height: 200px;">
                    
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Req ID</th>
                                <th>User Name</th>
                                <th>Client Mobile</th>
                                <th>Template</th>
                                <th>Reject Msg</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            {{$count = ""}}
                            @foreach ($reject_wap_request as $item)
                                <tr>
                                    <td >{{++$count}}</td>
                                    <td>{{$item->id}}</td>
                                    <td>
                                        <div>{{$item->user_name}}</div>
                                        {{-- <small class="dt_color">{{date('d-m-Y', strtotime($item->request_date)) . " " . $item->request_time}}</small> --}}
                                    </td>
                                    <td >{{$item->client_mobile}}</td>
                                    <td >{{$item->template_name}}</td>
                                    <td >{{$item->reject_msg}}</td>
                                    <td>
                                        @if ($item->reject == MyApp::STATUS)
                                            <span class="badge bg-danger text-dark">Rejected</span>
                                        @endif
                                        
                                    </td>
                                    
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
                                                                <textarea name="message" rows="4" class="form-control" disabled>{{$item->message}}</textarea>
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
        //https://wa.me/whatsappphonenumber/?text=urlencodedtext
        $(document).ready(function () {
            // $(document).on('click','#createRequest', function (e) {
            //     e.preventDefault();
            //     $('#wapRequestModal').modal('show');
            //     $('#wap_request_err').html('');
            //     $('#wap_request_err').removeClass('alert alert-danger');
            //     $("#wapRequestForm").trigger( "reset"); 
            //     $('#saveWapRequestBtn').removeClass('hide');
            //     $('#updateWapRequestBtn').addClass('hide');
            // });

            

            $(document).on('click','.previewBtn', function (e) {
                e.preventDefault();
                //const wap_request_id = $(this).attr("wap_request_id");
                const wap_request_id = $(this).val();
                $('#wapRequestDetailModal_'+wap_request_id).modal('show');
            });

            

            $(document).on('click','.sendBtn', function (e) {
                e.preventDefault();
                sendMessage();
            });

            $(document).on('click','.approveBtn', function (e) {
                e.preventDefault();
                const wap_request_id = $(this).val();
                approveWapRequest(wap_request_id);
            });

            $(document).on('click','.rejectBtn', function () {
                const wap_request_id = $(this).val();
                $('#submitRejectWapRequestBtn').val(wap_request_id);

                $('#rejectWapRequestModal').modal('show');
                $('#reject_wap_request_err').html('');
                $('#reject_wap_request_err').removeClass('alert alert-danger');
                $('#reject_msg').val('');
            });
            
            $(document).on('click','#submitRejectWapRequestBtn', function () {
                const wap_request_id = $(this).val();
                submitRejectWapRequest(wap_request_id);
            });

            // $(document).on('click','.editTemplateBtn', function (e) {
            //     e.preventDefault();
            //     const template_id = $(this).val();
            //     editTemplate(template_id);
            // });

            // $(document).on('click','#updateTemplateBtn', function (e) {
            //     e.preventDefault();
            //     const template_id = $(this).val();
            //     updateTemplate(template_id);
            // });
            
            // $(document).on('click','.deleteTemplateBtn', function (e) {
            //     e.preventDefault();
            //     const template_id = $(this).val();
            //     $('#deleteTemplateModal').modal('show');
            //     $('#yesDeleteTemplateBtn').val(template_id);
            // });

            // $(document).on('click','#yesDeleteTemplateBtn', function (e) {
            //     e.preventDefault();
            //     const template_id = $(this).val();
            //     deleteTemplate(template_id);
            // });


        });

        function approveWapRequest(wap_request_id) {
            fetch("approve-wap-request/"+wap_request_id)
            .then(response => response.json())
            .then(data =>{
                if(data.status == 200){
                    window.location.reload();
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }

        function submitRejectWapRequest(wap_request_id) {
            
            // const data = { reject_msg: 'example' };
            // //const formData = new FormData();
            // fetch('reject-wap-request/'+wap_request_id, {
            // method: 'POST', // or 'PUT'
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            // },
            // body: JSON.stringify(data),
            // })
            // .then(response => response.json())
            // .then(response => {
            //     if(response.status == 400)
            //         {
            //             $('#reject_wap_request_err').html('');
            //             $('#reject_wap_request_err').addClass('alert alert-danger');
            //             var count = 1;
            //             $.each(response.errors, function (key, err_value) { 
            //                 $('#reject_wap_request_err').append('<span>' + count++ +'.'+ err_value+'</span></br>');
            //             });
            //         }else{
            //             $('#rejectWapRequestModal').modal('hide');
            //             window.location.reload();
            //         }
            // })
            // .catch((error) => {
            // console.error('Error:', error);
            // });
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData($("#rejectWapRequestForm")[0]);
            $.ajax({
                type: "post",
                url: "reject-wap-request/"+wap_request_id,
                data: formData,
                dataType: "json",
                cache: false,
                contentType: false, 
                processData: false,
                success: function (response) {
                    console.log(response);
                    if(response.status == 400)
                    {
                        $('#reject_wap_request_err').html('');
                        $('#reject_wap_request_err').addClass('alert alert-danger');
                        var count = 1;
                        $.each(response.errors, function (key, err_value) { 
                            $('#reject_wap_request_err').append('<span>' + count++ +'.'+ err_value+'</span></br>');
                        });
                    }else{
                        $('#rejectWapRequestModal').modal('hide');
                        window.location.reload();
                    }
                }
            });
        }

        
    </script>
@endsection
  



    
    
