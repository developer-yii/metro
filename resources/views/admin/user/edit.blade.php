@extends('layouts.app')
@section('title') {{ $pageTitle . ' -' }} @endsection
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

                            <form action="{{ route('users.update', ['id' => $user->id ]) }}" id="user-form" method="POST">
                                @csrf @method('PUT')

                                <div class="row g-2">
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="{{ old('name', $user->name) }}">
                                        @if($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" value="{{ old('email', $user->email) }}">
                                        @if($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row g-2">
                                    <div class="mb-3 col-md-6">
                                        <label for="is_active" class="form-label">Status</label>
                                        <select class="form-select" id="is_active" name="is_active">
                                            <option value="1" {{ ($user->is_active == 1) ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ ($user->is_active == 0) ? 'selected' : '' }}>Deactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-2">
                                    <div class="mb-3 col-md-6">
                                        <label for="password" class="form-label">Password </label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                                        @if($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="password_confirmation" class="form-label">Confirm Password </label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Enter Confirm Password">
                                        @if($errors->has('password_confirmation'))
                                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <a href="{{ route('users.index') }}" class="btn btn-primary">Cancel</a>
                                <button type="submit" class="btn btn-success">Save</button>
                            </form>

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div>
            </div>

        </div>

    </div>
@endsection
