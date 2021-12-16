@extends('layouts.app')
@section('page_title','Dashboard')

@section('style')
@section('style')
<style>
    .wap_request_row{
        cursor: pointer;
    }
    
</style>
@endsection
@endsection
 
@section('content')
  <div class="row mt-2"></div>
  
    <div class="row mt-2">
        <div class="col-md-6">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title"> <b>Pending Wap Request</b> </h3>
                </div>

                <div class="card-body table-responsive p-0" style="height: 200px;">
                    
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
                                <tr wap_request_id="{{$item->id}}">
                                    <td >{{++$count}}</td>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->user_name}}</td>
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
        <div class="col-md-6">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title"> <b>Approved Wap Request</b> </h3>
                </div>

                <div class="card-body table-responsive p-0" style="height: 200px;">
                    
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
                                    <td>{{$item->user_name}}</td>
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
                                    </div>
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

            // $(document).on('change','#template_id', function () {
            //     const template_id = $(this).val();
            //     getTemplateContent(template_id);
            // });

            $(document).on('click','.previewBtn', function (e) {
                e.preventDefault();
                //const wap_request_id = $(this).attr("wap_request_id");
                //$('#show_wap_message').text($('#wap_message_'+wap_request_id).text());
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

        // function getTemplateContent(template_id){
        //     fetch("get-template-content/"+template_id)
        //     .then(response => response.json())
        //     .then(data =>{
        //         document.getElementById('message').value = "";
        //         document.getElementById('message').value = data.data.template_content;
        //     })
        //     .catch((error) => {
        //         console.error('Error:', error);
        //     });
        // }

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

        // function sendMessage(){
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
    
        //     var formData = new FormData($("#wapRequestForm")[0]);
            
        //     $.ajax({
        //         type: "POST",
        //         url: "send-message",
        //         data: JSON.stringify({
        //             number: 919479505099,
        //             msg: "Testing",
        //         }),
        //         dataType: "json",
        //         success: function (response) {
        //             console.log(response);
        //         }
        //     });
        // }

        // function editTemplate(template_id){
        //     $.ajax({
        //         type: "get",
        //         url: "edit-template/"+template_id,
        //         dataType: "json",
        //         success: function (response) {
        //             if(response.status == 200){
        //                 $('#templateModal').modal('show');
        //                 $('#template_err').html('');
        //                 $('#template_err').removeClass('alert alert-danger');
        //                 $("#templateForm").trigger( "reset" ); 
        //                 $('#saveTemplateBtn').addClass('hide');
        //                 $('#updateTemplateBtn').removeClass('hide');
        //                 $('#template_name').val(response.template.template_name);
        //                 $('#template_content').val(response.template.template_content);
        //                 $('#updateTemplateBtn').val(response.template.id);
        //             }
        //         }
        //     });
        // }

        // function updateTemplate(template_id){
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
            
        //     var formData = new FormData($("#templateForm")[0]);
        //     $.ajax({
        //         type: "POST",
        //         url: "update-template/"+template_id,
        //         data: formData,
        //         dataType: "json",
        //         cache: false,
        //         contentType: false, 
        //         processData: false, 
        //         success: function (response) {
        //             if(response.status == 400)
        //             {
        //                 $('#template_err').html('');
        //                 $('#template_err').addClass('alert alert-danger');
        //                 var count = 1;
        //                 $.each(response.errors, function (key, err_value) { 
        //                     $('#template_err').append('<span>' + count++ +'. '+ err_value+'</span></br>');
        //                 });

        //             }else{
        //                 $('#template_err').html('');
        //                 $('#templateModal').modal('hide');
        //                 window.location.reload();
        //             }
        //         }
        //     });
        // }

        // function deleteTemplate(template_id) {
        //     $.ajax({
        //         type: "get",
        //         url: "delete-template/"+template_id,
        //         dataType: "json",
        //         success: function (response) {
        //             if(response.status == 200){
        //                 window.location.reload();
        //             }
        //         }
        //     });
        // }

        
        
    </script>
@endsection
  



    
    
