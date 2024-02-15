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
                                <h4 class="header-title mb-0 mt-1">{{ $pageTitle }}</h4>
                                <button type="button" id="create-user" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#user-modal">Create User</button>
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

    <!--Create/Update Modal -->
    <div id="user-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="user-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="user-modalLabel">Create User</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form id="user-form" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="0" id="edit-id">

                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="{{ old('name') }}">

                                <span class="text-danger error nameErr"></span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" value="{{ old('email') }}">
                                <span class="text-danger error emailErr"></span>
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="is_active" class="form-label">Status</label>
                                <select class="form-select" id="is_active" name="is_active">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-2" id="password-section">
                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                                <span class="text-danger error passwordErr"></span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Enter Confirm Password">
                                <span class="text-danger error password_confirmationErr"></span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submit-button">Save changes</button>
                    </div>
                    </form>
            </div>
        </div>
    </div>
    <!--End Create/Update Modal -->


    <!--View Modal -->
    <div id="user-view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="user-view-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="user-view-modalLabel">Create User</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form id="user-view">
                        <div class="row g-2">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="view_name" placeholder="Enter Name" value="{{ old('name') }}" readonly>

                                <span class="text-danger error nameErr"></span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="view_email" placeholder="Enter Email" value="{{ old('email') }}" readonly>
                                <span class="text-danger error emailErr"></span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                    </form>
            </div>
        </div>
    </div>
    <!--End Create Modal -->


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

@endsection
@section('script')
    <script src="{{ asset('backend/js/user/ajax_user.js') }}"></script>
    <script>
        var getUserDataLink = "{{ route('users.ajax.getData') }}";
        var detailUrl = "{{ route('users.ajax.detail') }}";
        var addEditUrl = "{{ route('users.ajax.addupdate') }}";
        var deleteUrl = "{{ route('users.ajax.delete') }}";
    </script>
@endsection
