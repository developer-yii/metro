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
                                    <table id="offer-datatable" class="table table-striped table-fixed-col dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Mid</th>
                                                <th>Offer Price</th>
                                                <th>Percentage</th>
                                                <th>Destination</th>
                                                <th>Status</th>
                                                <th>Interested</th>
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
    <div id="offer-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="offer-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="offer-modalLabel">Edit Offer</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form id="offer-form" method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" value="0" id="edit-id">
                        <div class="row g-2">
                            <label for="offer_name" class="form-label">Product Name:</label>
                            <span class="mt-0 mb-3" id="offer_name"></span>
                            <br>
                        </div>

                        <div class="row g-2">
                            <div class="mb-3 col-md-12">
                                <label for="name" class="form-label">Percentage</label>
                                <input type="text" class="form-control" name="percentage" id="percentage"
                                    placeholder="Enter percentage" value="{{ old('percentage') }}">
                                <span class="text-danger error"></span>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="mb-3 col-md-12">
                                <div class="form-check form-checkbox-info mb-2">
                                    <input type="checkbox" class="form-check-input" id="is_interested_product"
                                        name="is_interested_product">
                                    <label class="form-check-label" for="is_interested_product">Interested Product</label>
                                </div>
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
    <div id="user-view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="user-view-modalLabel"
        aria-hidden="true">
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
                                <input type="text" class="form-control" name="name" id="view_name"
                                    placeholder="Enter Name" value="{{ old('name') }}" readonly>

                                <span class="text-danger error nameErr"></span>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="view_email"
                                    placeholder="Enter Email" value="{{ old('email') }}" readonly>
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
    <script src="{{ asset('backend/vendor/jquery-validate/jquery.validate.min.js') }}?{{time()}}"></script>
    <script src="{{ asset('backend/js/offers/index.js') }}"></script>
    <script>
        var getOfferDataLink = "{{ route('offers.getData') }}";
        var detailUrl = "{{ route('offers.detail') }}";
        var addEditUrl = "{{ route('offers.addupdate') }}";
        var syncUrl = "{{ route('offers.product.sync') }}";
        // var deleteUrl = "{{ route('users.ajax.delete') }}";
    </script>
@endsection
