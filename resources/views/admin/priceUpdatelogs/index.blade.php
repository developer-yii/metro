@extends('layouts.app')
@section('title')
    {{ $pageTitle . ' -' }}
@endsection
@section('css')
    <link href="{{ asset('backend/css/pages/offer-index.css') }}?{{ time() }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <x-breadcrumb :breadcrumbs="$breadcrumbs" :page-title="$pageTitle" />
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="header-title mb-0 mt-1">{{ $pageTitle }}</h4>
                            </div>

                            <p class="text-muted font-14"></p>

                            <ul class="nav nav-tabs nav-bordered mb-3"></ul>

                            <div class="tab-content">
                                <div class="tab-pane show active" id="alt-pagination-preview">
                                    <table id="priceUpdate-datatable" class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Mid</th>
                                                <th>Old Price</th>
                                                <th>New Price</th>
                                                <th>Method</th>
                                                <th>Time</th>                                                
                                            </tr>
                                        </thead>

                                    </table>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>    
@endsection
@section('script')    
    <script src="{{ asset('backend/js/priceUpdateLog/index.js') }}"></script>
    <script>
        var getLogDataLink = "{{ route('priceUpdatelogs.getData') }}";        
        // var deleteUrl = "{{ route('users.ajax.delete') }}";
    </script>
@endsection
