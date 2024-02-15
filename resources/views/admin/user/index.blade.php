@extends('layouts.app')
@section('title') {{ $pageTitle . ' -' }} @endsection
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
                <x-breadcrumb :breadcrumbs="$breadcrumbs" :page-title="$pageTitle"/>
            <!-- end page title -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="header-title mb-0 mt-1">{{ $pageTitle }} List</h4>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('users.generatePdf') }}" class="btn btn-info me-2">Generate PDF</a>
                                    <button type="button" id="import-file-btn" class="btn btn-secondary me-2" data-bs-toggle="modal" data-bs-target="#import-file-modal">Import File</button>
                                    <a href="{{ route('users.export-excel') }}" class="btn btn-success me-2">Export Excel File</a>
                                    <a href="{{ route('users.export-csv') }}" class="btn btn-success me-2">Export CSV File</a>
                                    <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
                                </div>
                            </div>

                            <p class="text-muted font-14"></p>

                            <ul class="nav nav-tabs nav-bordered mb-3"></ul>

                            <div class="tab-content">
                                <div class="tab-pane show active" id="alt-pagination-preview">
                                    <table id="user-datatable" class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Action</th>
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

    {{-- Import File model --}}
    <div id="import-file-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="import-file-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="import-file-modalLabel">Import File</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form id="import-form" method="POST" action="" enctype="multipart/form-data">
                        <div class="row g-2">
                            <div class="mb-3 col-md-12">
                                <label for="file_type" class="form-label">File Type<span class="text-danger">*</span></label>
                                <select name="file_type" id="file_type" class="form-control">
                                    <option value="csv">CSV</option>
                                    <option value="excel">Excel</option>
                                </select>

                                <span class="text-danger error file_typeErr"></span>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-12">
                                <label for="file" class="form-label">File <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="file" id="file" accept=".csv">
                                <span class="text-danger error fileErr"></span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="{{ asset('sample_file/User Sample.csv') }}" id="download_sample_file" class="btn btn-info" download>Download Sample File</a>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submit-button">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Delete data modal --}}
    <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled bg-danger">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="ri-close-circle-line h1"></i>
                        <h4 class="mt-2">Oh snap!</h4>
                        <p class="mt-3">Are you sure you want to delete it !</p>
                        <input type="hidden" id="delete-id" value="0">
                        <button type="button" class="btn btn-light my-2" id="continue">Continue</button>
                        <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Import Errors --}}
    <div id="importErrorModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="importErrorModal-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Errors</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <ul id="importErrorList"></ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('script')
    <script src="{{ asset('backend/js/user/user.js') }}"></script>
    <script>
        var getUserDataLink = "{{ route('users.getData') }}";
        var deleteUrl = "{{ route('users.delete') }}";
        var importUrl = "{{ route('users.import') }}";
        var csvUrl = "{{ asset('sample_file/User Sample.csv') }}";
        var excelUrl = "{{ asset('sample_file/User Sample.xlsx') }}";
    </script>
@endsection
