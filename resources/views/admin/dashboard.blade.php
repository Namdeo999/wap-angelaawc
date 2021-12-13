@extends('layouts.app')
@section('page_title','Dashboard')
 
@section('content')
  <div class="row mt-2"></div>
    <div class="row mt-2">
        <div class="col-md-12">
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
                                <th>Template</th>
                                <th>Client Mobile</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            {{$count = ""}}
                            
                            @foreach ($wap_request as $item)
                                <tr>
                                    <td>{{++$count}}</td>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->user_name}}</td>
                                    <td>{{$item->template_name}}</td>
                                    <td>{{$item->client_mobile}}</td>
                                    <td>{{$item->message}}</td>
                                    <td>
                                        {{-- <a href="https://api.whatsapp.com/send?phone=919479505099&text=testing" >whatsapp</a> --}}
                                        <a class="btn btn-primary btn-sm" href="https://wa.me/91{{$item->client_mobile}}?text={{$item->message}}" target="_blank">whatsapp</a>
                                        {{-- <a href="https://wa.me/919479505099" >whatsapp</a> --}}

                                        <button type="button" class="btn btn-info btn-sm previewBtn" value="{{$item->id}}">Preview</button>
                                        <button type="button" class="btn btn-primary btn-sm sendBtn" value="{{$item->id}}">Send</button>
                                        <button type="button" class="btn btn-danger btn-sm rejectBtn" value="{{$item->id}}">Reject</button>
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

            $(document).on('click','.sendBtn', function (e) {
                e.preventDefault();
                sendMessage();
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

        function sendMessage(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    
            //var formData = new FormData($("#wapRequestForm")[0]);
            
            $.ajax({
                type: "POST",
                url: "send-message",
                data: JSON.stringify({
                    number: 919479505099,
                    msg: "Testing",
                }),
                dataType: "json",
                success: function (response) {
                    console.log(response);
                }
            });
        }

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
  



    
    
