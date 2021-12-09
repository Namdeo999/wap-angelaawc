@extends('layouts.app')
@section('page_title','Users')

@section('content')
    <div class="modal fade" id="userModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="userForm">
                        @csrf
                        <div class="modal-body">
                            <div id="user_err"></div>
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    <label for="userName" class="form-label">User Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="user_name" id="user_name" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    <label for="userEmail" class="form-label">Email</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" name="email" id="email" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    <label for="userMobile" class="form-label">Mobile</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="mobile" id="mobile" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    <label for="userPassword" class="form-label">Password</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="password" name="password" id="password" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="saveUserBtn" class="btn btn-primary btn-sm ">Save User</button>
                            <button type="button" id="updateUserBtn" class="btn btn-primary btn-sm hide">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{-- delete modal --}}
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Delete User </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <center>
                        <h5>Are you sure?</h5>
                            <button type="button" id="yesDeleteUserBtn" class="btn btn-primary btn-sm mx-1 ">Yes</button>
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
                <button type="button" id="addNewUser" class="btn btn-block btn-primary btn-flat btn-sm mt-2" >Add New User</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Users</h3>
                </div>

                <div class="card-body table-responsive p-0" style="height: 350px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{$count = ""}}
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{++$count}}</td>
                                   
                                    <td>{{$item->user_name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->mobile}}</td>
                                    <td>
                                        <button type="button" class="btn btn-secondary btn-sm editUserBtn" value="{{$item->id}}">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm deleteUserBtn" value="{{$item->id}}">Delete</button>
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
            $(document).on('click','#addNewUser', function (e) {
                e.preventDefault();
                $('#userModal').modal('show');
                $('#user_err').html('');
                $('#user_err').removeClass('alert alert-danger');
                $("#userForm").trigger( "reset"); 
                $('#saveUserBtn').removeClass('hide');
                $('#updateUserBtn').addClass('hide');
            });

            $(document).on('click','#saveUserBtn', function (e) {
                e.preventDefault();
                saveUser();
            });
            
            $(document).on('click','.editUserBtn', function (e) {
                e.preventDefault();
                const user_id = $(this).val();
                editUser(user_id);
            });

            $(document).on('click','#updateUserBtn', function (e) {
                e.preventDefault();
                const user_id = $(this).val();
                updateUser(user_id);
            });
            
            $(document).on('click','.deleteUserBtn', function (e) {
                e.preventDefault();
                const user_id = $(this).val();
                $('#deleteUserModal').modal('show');
                $('#yesDeleteUserBtn').val(user_id);
            });

            $(document).on('click','#yesDeleteUserBtn', function (e) {
                e.preventDefault();
                const user_id = $(this).val();
                deleteUser(user_id);
            });

        });
    
    </script>
@endsection
    
