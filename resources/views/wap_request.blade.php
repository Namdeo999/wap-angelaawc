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
                                    <option value="">  </option>
                                    <option value="" >  </option>
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

  <div>
    <div class="row ">
        <div class="offset-md-10 col-md-2">
            <button type="button" id="createRequest" class="btn btn-block btn-primary btn-flat btn-sm mt-2" >Create Request</button>
        </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title"> <b>Wap Request</b> </h3>
            </div>

            <div class="card-body table-responsive p-0" style="height: 200px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Req ID</th>
                            <th>Template</th>
                            <th>Content</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{$count = ""}}
                        
                        @foreach ($templates as $item)
                            <tr>
                                <td>{{++$count}}</td>
                                <td>{{$item->template_name}}</td>
                                <td>{{$item->template_content}}</td>
                                <td>
                                    @if ($item->status == MyApp::STATUS)
                                        <a href="{{ url('admin/template-status/0/'.$item->id )}}"><button type="button" class="btn btn-success btn-sm">Active</button></a>     
                                    @else
                                        <a href="{{ url('admin/template-status/1/'.$item->id )}}"><button type="button" class="btn btn-secondary btn-sm">Deactive</button></a>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm editTemplateBtn" value="{{$item->id}}">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm deleteTemplateBtn" value="{{$item->id}}">Delete</button>
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<div class="row">
  <div class="col-md-8">
      <div class="card">

          <div class="card-header">
              <h3 class="card-title"> <b>Approved Request</b> </h3>
          </div>

          <div class="card-body table-responsive p-0" style="height: 300px;">
              <table class="table table-head-fixed text-nowrap">
                  <thead>
                      <tr>
                          <th>SN</th>
                          <th>Req ID</th>
                          <th>Template</th>
                          <th>Manager</th>
                          <th>Status</th>
                      </tr>
                  </thead>
                  <tbody>
                      
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
            // $(document).on('click','#createRequest', function (e) {
            //     e.preventDefault();
            //     $('#wapRequestModal').modal('show');
            //     $('#wap_request_err').html('');
            //     $('#wap_request_err').removeClass('alert alert-danger');
            //     $("#wapRequestForm").trigger( "reset"); 
            //     $('#saveWapRequestBtn').removeClass('hide');
            //     $('#updateWapRequestBtn').addClass('hide');
            // });

            // $(document).on('click','#saveWapRequestBtn', function (e) {
            //     e.preventDefault();
            //     saveWapRequestBtn();
            // });
            
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

        
        
    </script>
@endsection
  



    
    
