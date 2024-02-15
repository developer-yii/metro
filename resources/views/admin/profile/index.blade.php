@php
    $baseUrl = asset('backend')."/";
@endphp
@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">

        <!-- start page title -->
        <x-breadcrumb :breadcrumbs="$breadcrumbs" :page-title="$pageTitle"/>
        <!-- end page title -->

        <div class="row">
            <div class="col-sm-12">
                <!-- Profile -->
                <div class="card bg-primary">
                    <div class="card-body profile-user-box">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar-lg">
                                            @if (Auth::user()->image)
                                                <img src="{{ asset('storage/profile_pics/'. Auth::user()->image) }}" alt="" class="rounded-circle img-thumbnail">
                                            @else
                                                <img src="{{$baseUrl}}images/users/avatar-2.jpg" alt="" class="rounded-circle img-thumbnail">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            <h4 class="mt-1 mb-1 text-white">{{ auth()->user()->name }}</h4>
                                            <p class="font-13 text-white-50"> Authorised Brand Seller</p>

                                            <ul class="mb-0 list-inline text-light">
                                                <li class="list-inline-item me-3">
                                                    <h5 class="mb-1 text-white">$ 25,184</h5>
                                                    <p class="mb-0 font-13 text-white-50">Total Revenue</p>
                                                </li>
                                                <li class="list-inline-item">
                                                    <h5 class="mb-1 text-white">5482</h5>
                                                    <p class="mb-0 font-13 text-white-50">Number of Orders</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-sm-4">
                                <div class="text-center mt-sm-0 mt-3 text-sm-end">
                                    <a href="{{ route('profile.editProfile') }}" class="btn btn-light">
                                        <i class="mdi mdi-account-edit me-1"></i> Edit Profile
                                    </a>
                                </div>
                            </div> <!-- end col-->
                        </div> <!-- end row -->

                    </div> <!-- end card-body/ profile-user-box-->
                </div><!--end profile/ card -->
            </div> <!-- end col-->
        </div>

    </div>
</div>
@endsection
