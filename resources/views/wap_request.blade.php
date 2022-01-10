@extends('layouts.app')
@section('page_title','Wap Request')
 
@section('content')
<div class="modal fade" id="wapRequestModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Wap Request</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form id="wapRequestForm">
                  @csrf
                  <div class="modal-body">
                      <div id="wap_request_err"></div>
                      
                        <div class="row mb-1">
                            <div class="col-md-4">
                                <label for="clientMobile" class="form-label">Mobile No</label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" name="client_mobile" id="client_mobile" class="form-control form-control-sm">
                            </div>
                        </div>
                      
                        <div class="row mb-1">
                            <div class="col-md-4">
                                <label for="templateId" class="form-label">Template</label>
                            </div>
                            <div class="col-md-8">
                                <select id="template_id" name="template_id" class="form-select form-select-sm">
                                    <option selected disabled >Choose...</option>
                                    @foreach ($template as $item)
                                        <option value="{{$item->id}}"> {{$item->template_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-4">
                                <label for="clientMessage" class="form-label">Message</label>
                            </div>
                            <div class="col-md-8">
                                <textarea name="message" id="message" cols="20" rows="5" class="form-control" ></textarea>
                            </div>
                        </div>
                      
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                      <button type="button" id="saveWapRequestBtn" class="btn btn-primary btn-sm ">Send Msg For Approval</button>
                      <button type="button" id="updateWapRequestBtn" class="btn btn-primary btn-sm hide">Update Wap Request</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
{{-- delete modal --}}
<div class="modal fade" id="deleteWapRequestModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Delete Wap Request </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                <center>
                    <h5>Are you sure?</h5>
                        <button type="button" id="yesDeleteWapRequestBtn" class="btn btn-primary btn-sm mx-1 ">Yes</button>
                        <button type="button" class="btn btn-secondary mx-1 btn-sm" data-bs-dismiss="modal">No</button>
                    <hr>
                </center>
            </div>
    </div>
    </div>
</div>

<div>
    <div class="row ">
        <div class="offset-md-10 col-md-2">
            <button type="button" id="createRequest" class="btn btn-block btn-primary btn-flat btn-sm mt-2" >New Request</button>
        </div>
    </div>
</div>

    <div class="row mt-2">
        <div class="col-md-7">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title"> <b>Wap Request</b> </h3>
                </div>

                <div class="card-body table-responsive p-0" style="height: 400px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Req ID</th>
                                {{-- <th>User Name</th> --}}
                                <th>Template</th>
                                <th>Client Mobile</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{$count = ""}}
                            
                            @foreach ($wap_request as $item)
                                <tr>
                                    <td>{{++$count}}</td>
                                    <td>{{$item->id}}</td>
                                    {{-- <td>{{$item->user_name}}</td> --}}
                                    <td>
                                        <div>{{$item->template_name}}</div>
                                        <small class="dt_color">{{date('d-m-Y', strtotime($item->request_date)) . " " . $item->request_time}}</small>
                                    </td>
                                    <td>{{$item->client_mobile}}</td>
                                    <td class="hide">{{$item->message}}</td>
                                    <td><span class="badge bg-warning text-dark">Wait For Approval</span></td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm previewBtn" value="{{$item->id}}">Preview</button>
                                        <button type="button" class="btn btn-secondary btn-sm editWapRequestBtn" value="{{$item->id}}">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm deleteWapRequestBtn" value="{{$item->id}}">Delete</button>
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

        <div class="col-md-5">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title"> <b>Approved Request</b> </h3>
                </div>

                <div class="card-body table-responsive p-0" style="height: 400px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Req ID</th>
                                <th>Client Mobile</th>
                                <th>Approve By</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{$count = ""}}
                            @foreach ($approve_wap_request as $item)
                                <tr>
                                    <td>{{++$count}}</td>
                                    <td>{{$item->id}}</td>
                                    <td class="hide">{{$item->template_name}}</td>
                                    <td>
                                        <div>{{$item->client_mobile}}</div>
                                        <small class="dt_color">{{date('d-m-Y', strtotime($item->approve_date)) . " " . $item->approve_time}}</small>
                                    </td>
                                    <td class="hide">{{$item->message}}</td>
                                    <td>{{$item->admin_name}}</td>
                                    <td><span class="badge bg-success text-dark">Approved</span></td>
                                    <td><button type="button" class="btn btn-info btn-sm previewBtn" value="{{$item->id}}">Preview</button></td>

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

    <div class="row">
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
                                <th>Client Mobile</th>
                                <th>Template</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{$count = ""}}
                            @foreach ($reject_wap_request as $item)
                                <tr>
                                    <td>{{++$count}}</td>
                                    <td>{{$item->id}}</td>
                                    <td>
                                        <div>{{$item->client_mobile}}</div>
                                        <small class="dt_color">{{date('d-m-Y', strtotime($item->approve_date)) . " " . $item->approve_time}}</small>
                                    </td>
                                    <td>{{$item->template_name}}</td>
                                    {{-- <td>{{$item->admin_name}}</td> --}}
                                    <td>{{$item->reject_msg}}</td>
                                    <td>
                                        @if ($item->reject == MyApp::STATUS)
                                            <span class="badge bg-danger text-dark">Rejected</span>
                                        @endif
                                    </td>
                                    <td><button type="button" class="btn btn-secondary btn-sm editWapRequestBtn" value="{{$item->id}}">Edit</button></td>

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
            $(document).on('click','#createRequest', function (e) {
                e.preventDefault();
                $('#wapRequestModal').modal('show');
                $('#wap_request_err').html('');
                $('#wap_request_err').removeClass('alert alert-danger');
                $("#wapRequestForm").trigger( "reset"); 
                $('#saveWapRequestBtn').removeClass('hide');
                $('#updateWapRequestBtn').addClass('hide');
            });

            $(document).on('change','#template_id', function () {
                const template_id = $(this).val();
                getTemplateContent(template_id);
            });

            $(document).on('click','#saveWapRequestBtn', function (e) {
                e.preventDefault();
                saveWapRequest();
            });

            $(document).on('click','.editWapRequestBtn', function (e) {
                e.preventDefault();
                const wap_request_id = $(this).val();
                editWapRequest(wap_request_id);
            });

            $(document).on('click','#updateWapRequestBtn', function (e) {
                e.preventDefault();
                const wap_request_id = $(this).val();
                updateWapRequest(wap_request_id);
            });
            
            $(document).on('click','.deleteWapRequestBtn', function (e) {
                e.preventDefault();
                const wap_request_id = $(this).val();
                $('#deleteWapRequestModal').modal('show');
                $('#yesDeleteWapRequestBtn').val(wap_request_id);
            });

            $(document).on('click','#yesDeleteWapRequestBtn', function (e) {
                e.preventDefault();
                const wap_request_id = $(this).val();
                deleteWapRequest(wap_request_id);
            });

            $(document).on('click','.previewBtn', function (e) {
                e.preventDefault();
                const wap_request_id = $(this).val();
                $('#wapRequestDetailModal_'+wap_request_id).modal('show');
            });


        });

        function getTemplateContent(template_id){
            fetch("get-template-content/"+template_id)
            .then(response => response.json())
            .then(data =>{
                document.getElementById('message').value = "";
                document.getElementById('message').value = data.data.template_content;
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }

        function saveWapRequest(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    
            var formData = new FormData($("#wapRequestForm")[0]);
            $.ajax({
                type: "POST",
                url: "save-wap-request",
                data: formData,
                dataType: "json",
                cache: false,
                contentType: false, 
                processData: false, 
                success: function (response) {
                    if(response.status == 400)
                    {
                        $('#wap_request_err').html('');
                        $('#wap_request_err').addClass('alert alert-danger');
                        var count = 1;
                        $.each(response.errors, function (key, err_value) { 
                            $('#wap_request_err').append('<span>' + count++ +'. '+ err_value+'</span></br>');
                        });

                    }else{
                        $('#wap_request_err').html('');
                        $('#wapRequestModal').modal('hide');
                        window.location.reload();
                    }
                }
            });
        }

        function editWapRequest(wap_request_id){
            fetch("edit-wap-request/"+wap_request_id)
            .then(response => response.json())
            .then(data =>{
                //console.log(data);
                if(data.status == 200){
                    $('#wapRequestModal').modal('show');
                    $('#wap_request_err').html('');
                    $('#wap_request_err').removeClass('alert alert-danger');
                    $("#wapRequestForm").trigger( "reset" ); 
                    $('#saveWapRequestBtn').addClass('hide');
                    $('#updateWapRequestBtn').removeClass('hide');
                    $('#client_mobile').val(data.wap_request.client_mobile);
                    $('#template_id').val(data.wap_request.template_id);
                    $('#message').val(data.wap_request.message);
                    $('#updateWapRequestBtn').val(data.wap_request.id);
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }

        function updateWapRequest(wap_request_id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            var formData = new FormData($("#wapRequestForm")[0]);
            $.ajax({
                type: "POST",
                url: "update-wap-request/"+wap_request_id,
                data: formData,
                dataType: "json",
                cache: false,
                contentType: false, 
                processData: false, 
                success: function (response) {
                    if(response.status == 400)
                    {
                        $('#wap_request_err').html('');
                        $('#wap_request_err').addClass('alert alert-danger');
                        var count = 1;
                        $.each(response.errors, function (key, err_value) { 
                            $('#wap_request_err').append('<span>' + count++ +'. '+ err_value+'</span></br>');
                        });

                    }else{
                        $('#wap_request_err').html('');
                        $('#wapRequestModal').modal('hide');
                        window.location.reload();
                    }
                }
            });
        }

        function deleteWapRequest(wap_request_id) {
            fetch("delete-wap-request/"+wap_request_id)
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

        
        
    </script>
@endsection
  



    
    
