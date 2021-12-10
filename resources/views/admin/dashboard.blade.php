@extends('layouts.app')
@section('page_title','Dashboard')
 
@section('content')
  <div class="row mt-2"></div>
    <div class="row mt-2">
        <div class="col-md-8">
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
                                    <td>
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
  



    
    
