@extends('layouts.app')

@section('content')

<div class="content">
    <div class="container-fluid">
        <!-- start page title -->
        <x-breadcrumb :breadcrumbs="$breadcrumbs" :page-title="$pageTitle"/>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Heading</h4>
                        <p class="text-muted font-14">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam repudiandae aliquid eius sunt neque esse ipsum numquam vel.</p>

                        <form action="{{ route('change-password.store') }}" id="user-form" method="POST">
                            @csrf

                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="current_password" class="form-label">Current Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Enter Current Password">
                                    @if($errors->has('current_password'))
                                        <span class="text-danger">{{ $errors->first('current_password') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="password" class="form-label">New Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter New Password">
                                    @if($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Enter Confirm Password">
                                    @if($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                            </div>

                            <a href="{{ route('dashboard') }}" class="btn btn-primary">Cancel</a>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div>
        </div>
    </div>
</div>

@endsection
