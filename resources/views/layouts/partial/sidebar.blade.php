<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{ route('offers.index') }}" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{$baseUrl}}images/logo.png" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="{{$baseUrl}}images/logo-sm.png" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="{{ route('offers.index') }}" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{$baseUrl}}images/logo-dark.png" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="{{$baseUrl}}images/logo-dark-sm.png" alt="small logo">
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </div>

    <!-- Full Sidebar Menu Close Button -->
    <div class="button-close-fullsidebar">
        <i class="ri-close-fill align-middle"></i>
    </div>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!-- Leftbar User -->
        <div class="leftbar-user">
            <a href="pages-profile.html">
                <img src="{{$baseUrl}}images/users/avatar-1.jpg" alt="user-image" height="42" class="rounded-circle shadow-sm">
                <span class="leftbar-user-name mt-2">Dominic Keller</span>
            </a>
        </div>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title">Navigation</li>

            {{-- <li class="side-nav-item {{ Request::is('dashboard') ? 'menuitem-active' : '' }}">
                <a href="{{ route('dashboard') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span class="badge bg-success float-end">5</span>
                    <span> Dashboards </span>
                </a>
            </li> --}}

            <li class="side-nav-item {{ Request::is('offers') ? 'menuitem-active' : '' }}">
                <a href="{{ route('offers.index') }}" class="side-nav-link">
                    <i class="uil-pricetag-alt"></i>                    
                    <span> Offers </span>
                </a>
            </li>

            <li class="side-nav-item {{ Request::is('priceUpdatelogs') ? 'menuitem-active' : '' }}">
                <a href="{{ route('priceUpdatelogs.index') }}" class="side-nav-link">
                    <i class="uil-history-alt"></i>                    
                    <span> Price Update Log </span>
                </a>
            </li>

            <li class="side-nav-item {{ Request::is('jobLogs') ? 'menuitem-active' : '' }}">
                <a href="{{ route('jobLogs.index') }}" class="side-nav-link">
                    <i class="uil-database-alt"></i>                    
                    <span> Job Log </span>
                </a>
            </li>

            <li class="side-nav-item {{ Request::is('users') ? 'menuitem-active' : '' }}">
                <a href="{{ route('users.ajax.index') }}" class="side-nav-link">
                    <i class="uil-user"></i>                    
                    <span> Users </span>
                </a>
            </li>           

        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->
