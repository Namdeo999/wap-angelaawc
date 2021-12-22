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
    <div class="row"></div>
    <div class="row mt-2">
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-table"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Request</span>
                    <span class="info-box-number">10</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="far fa-window-close"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Rejected</span>
                    <span class="info-box-number">15</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-tasks"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Approved</span>
                    <span class="info-box-number">760</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Users</span>
                    <span class="info-box-number">2,000</span>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Wap Request</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body table-responsive p-0" style="height: 400px;">
                <table class="table table-striped table-head-fixed ">
                    <thead>
                        <tr>
                            <th style="width: 2%">#</th>
                            <th style="width: 10%">Req ID</th>
                            <th style="width: 15%">Client Name</th>
                            <th style="width: 25%">Template</th>
                            <th style="width: 15%">User Name</th>
                            <th style="width: 15%">Approved By</th>
                            <th style="width: 8s%" class="text-center">Status</th>
                            <th style="width: 10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="mb-2">
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </section>

@endsection

@section('script')
    <script>
         
    </script>
@endsection
  



    
    
