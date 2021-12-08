@extends('layouts.app')
@section('page_title','Template')
 
@section('content')

    <div class="modal fade" id="templateModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Template</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="templateForm">
                        @csrf
                        <div class="modal-body">
                            <div id="template_err"></div>
                            <div class="row mb-1">
                                <div class="col-md-12">
                                    <input type="text" name="template_name" id="template_name" class="form-control form-control-sm" placeholder="Template name">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-md-12">
                                    <textarea name="template_content" id="template_content" cols="20" rows="5" class="form-control" placeholder="Template content"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="saveTemplateBtn" class="btn btn-primary btn-sm ">Save Template</button>
                            <button type="button" id="updateTemplateBtn" class="btn btn-primary btn-sm hide">Update Template</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  
    <div>
        <div class="row ">
            <div class="offset-md-10 col-md-2">
                <button type="button" id="addTemplate" class="btn btn-block btn-primary btn-flat btn-sm mt-2" >Add Template</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title"> <b>Templates</b> </h3>
                </div>

                <div class="card-body table-responsive p-0" style="height: 350px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Template</th>
                                <th>Content</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{$count = ""}}
                            
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
            $(document).on('click','#addTemplate', function (e) {
                e.preventDefault();
                $('#templateModal').modal('show');
                $('#template_err').html('');
                $('#template_err').removeClass('alert alert-danger');
                $("#templateForm").trigger( "reset"); 
                $('#saveTemplateBtn').removeClass('hide');
                $('#updateTemplateBtn').addClass('hide');
            });

            $(document).on('click','#saveTemplateBtn', function (e) {
                e.preventDefault();
                saveTemplate();
            });
            
            // $(document).on('click','.editAdminBtn', function (e) {
            //     e.preventDefault();
            //     const admin_id = $(this).val();
            //     editAdmin(admin_id);
            // });

            // $(document).on('click','#updateAdminBtn', function (e) {
            //     e.preventDefault();
            //     const admin_id = $(this).val();
            //     updateAdmin(admin_id);
            // });
            
            // $(document).on('click','.deleteAdminBtn', function (e) {
            //     e.preventDefault();
            //     const admin_id = $(this).val();
            //     $('#deleteAdminModal').modal('show');
            //     $('#yesDeleteAdminBtn').val(admin_id);
            // });

            // $(document).on('click','#yesDeleteAdminBtn', function (e) {
            //     e.preventDefault();
            //     const admin_id = $(this).val();
            //     deleteAdmin(admin_id);
            // });


        });

        
        
    </script>
@endsection
  



    
    
