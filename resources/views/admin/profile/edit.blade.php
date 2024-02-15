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

                        <form action="{{ route('profile.storeProfile') }}" id="user-form" method="POST" enctype="multipart/form-data">
                            @csrf

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
                                    <label for="profile_pic" class="form-label">Name </label>
                                    <input type="file" class="form-control" name="profile_pic" id="profile_pic">
                                    @if($errors->has('profile_pic'))
                                        <span class="text-danger">{{ $errors->first('profile_pic') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3 col-md-6">
                                    @if($user->image)
                                        <img src="{{ asset('storage/profile_pics/' . $user->image) }}" alt="Profile Picture" height="100" width="100">
                                    @endif
                                </div>
                            </div>

                            <a href="{{ route('profile.index') }}" class="btn btn-primary">Cancel</a>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div>
        </div>

    </div>
</div>

@endsection
