@extends('layouts.app')
@section('page_title','Wap Admins')

@section('content')

<div class="modal fade" id="adminModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="adminForm">
                    @csrf
                    <div class="modal-body">
                        <div id="admin_err"></div>
                        <div class="row mb-1">
                            <div class="col-md-4">
                                <label for="adminRole" class="form-label">Admin Role</label>
                            </div>
                            <div class="col-md-8">
                                <select id="admin_role" name="admin_role" class="form-select form-select-sm">
                                    <option selected disabled >Choose...</option>
                                    <option value="{{MyApp::ADMINISTRATOR}}"> Administrator </option>
                                    <option value="{{MyApp::MANAGER}}" selected> Manager </option>
                                   
                                </select>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-4">
                                <label for="adminName" class="form-label">Name</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="name" id="name" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-4">
                                <label for="adminEmail" class="form-label">Email</label>
                            </div>
                            <div class="col-md-8">
                                <input type="email" name="email" id="email" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-4">
                                <label for="adminPassword" class="form-label">Password</label>
                            </div>
                            <div class="col-md-8">
                                <input type="password" name="password" id="password" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="saveAdminBtn" class="btn btn-primary btn-sm ">Save Admin</button>
                        <button type="button" id="updateAdminBtn" class="btn btn-primary btn-sm hide">Update Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- delete modal --}}
<div class="modal fade" id="deleteAdminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Delete Admin </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                <center>
                    <h5>Are you sure?</h5>
                        <button type="button" id="yesDeleteAdminBtn" class="btn btn-primary btn-sm mx-1 ">Yes</button>
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
                <button type="button" id="addNewAdmin" class="btn btn-block btn-primary btn-flat btn-sm mt-2" >Add New Admin</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Admins</h3>
                </div>

                <div class="card-body table-responsive p-0" style="height: 350px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Admin Role</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{$count = ""}}
                            @foreach ($admins as $item)
                                <tr>
                                    <td>{{++$count}}</td>
                                    @if ($item->role == MyApp::ADMINISTRATOR)
                                        <td>{{'ADMINISTRATOR'}}</td>
                                        @else
                                        <td>{{'MANAGER'}}</td>
                                    @endif
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>
                                        <button type="button" class="btn btn-secondary btn-sm editAdminBtn" value="{{$item->id}}">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm deleteAdminBtn" value="{{$item->id}}">Delete</button>
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
            $(document).on('click','#addNewAdmin', function (e) {
                e.preventDefault();
                $('#adminModal').modal('show');
                $('#admin_err').html('');
                $('#admin_err').removeClass('alert alert-danger');
                $("#adminForm").trigger( "reset"); 
                $('#saveAdminBtn').removeClass('hide');
                $('#updateAdminBtn').addClass('hide');
            });

            $(document).on('click','#saveAdminBtn', function (e) {
                e.preventDefault();
                // var formData = new FormData($("#adminForm")[0]);

                // fetch('save-admin', {
                // method: 'POST',
                // body: JSON.stringify(formData),
                // headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     },
                // })
                // .then((response) => response.json())
                // .then((data) => console.log(data));
                saveAdmin();
            });
            
            // $(document).on('click','.editStateBtn', function (e) {
            //     e.preventDefault();
            //     const state_id = $(this).val();
            //     editState(state_id);
            // });

            // $(document).on('click','#updateStateBtn', function (e) {
            //     e.preventDefault();
            //     const state_id = $(this).val();
            //     updateState(state_id);
            // });
            
            // $(document).on('click','.deleteStateBtn', function (e) {
            //     e.preventDefault();
            //     const state_id = $(this).val();
            //     $('#deleteStateModal').modal('show');
            //     $('#yesDeleteStateBtn').val(state_id);
            // });

            // $(document).on('click','#yesDeleteStateBtn', function (e) {
            //     e.preventDefault();
            //     const state_id = $(this).val();
            //     deleteState(state_id);
            // });


        });

        function saveAdmin(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            var formData = new FormData($("#adminForm")[0]);
            $.ajax({
                type: "POST",
                url: "save-admin",
                data: formData,
                dataType: "json",
                cache: false,
                contentType: false, 
                processData: false, 
                success: function (response) {
                    console.log(response.status);
                    if(response.status == 400)
                    {
                        $('#admin_err').html('');
                        $('#admin_err').addClass('alert alert-danger');
                        var count = 1;
                        $.each(response.errors, function (key, err_value) { 
                            $('#admin_err').append('<span>' + count++ +'. '+ err_value+'</span></br>');
                        });

                    }else{
                        $('#admin_err').html('');
                        $('#adminModal').modal('hide');
                        window.location.reload();
                    }
                }
                // error: function (xhr) {
                //     console.log(xhr.responseText);
                // }
            });
            
        }
        
    </script>
@endsection