<!-- Topbar Start -->
<div class="navbar navbar-expand flex-column flex-md-row navbar-custom">
    <div class="container-fluid">
        <!-- LOGO -->
        <a href="{{route('home') }}" class="navbar-brand mr-0 mr-md-2 logo">
            <span class="logo-lg">
                @if(\Cookie::get('theme') == 'dark')
                <img src="{{('/frontend/assets/images/fulllogo.png')}}" alt="" height="48" />
                @else
                <img src="{{('/frontend/assets/images/fulllogo.png')}}" alt="" height="48" />
                @endif
            </span>
            <span class="logo-sm">
                <img src="/frontend/assets/images/smLogo.svg" alt="" height="24">
            </span>
        </a>

        <ul class="navbar-nav bd-navbar-nav flex-row list-unstyled menu-left mb-0">
            <li class="">
                <button class="button-menu-mobile open-left disable-btn">
                    <i data-feather="menu" class="menu-icon"></i>
                    <i data-feather="x" class="close-icon"></i>
                </button>
            </li>
        </ul>

        <ul class="navbar-nav flex-row ml-auto d-flex list-unstyled topnav-menu float-right mb-0">
            <li class="d-none d-sm-block">
                <div class="app-search">
                    <button class="btn btn-primary back-home-button">
                        <a href="{{route('dashboard')}}" style="color: white">Back to home</a>
                    </button>

                </div>
            </li>
            <li>
                <div class="media user-profile mt-2 mb-2">

                    @php
                    $profile_picture = Cookie::get('profile_picture');
                    $profile_picture = rtrim($profile_picture);
                    $profile_picture_path = str_replace(" ","/", $profile_picture);
                    @endphp
                    <object data="https://res.cloudinary.com/{{ $profile_picture_path }}" type="image/jpg"
                        class="avatar-sm rounded-circle mr-2" data-toggle="modal" data-target="#profilePhoto">
                        <img src="/backend/assets/images/users/default.png" class="avatar-sm rounded-circle mr-2"
                            alt="Profile Picture" />
                    </object>
                    <div class="media-body">
                        <h6 class="pro-user-name mt-0 mb-0">{{Cookie::get('first_name')}} {{Cookie::get('last_name')}}
                        </h6>
                        <span class="pro-user-desc">
                            @if ( \Cookie::get('user_role') == "store_admin")
                            STORE ADMIN
                            @elseif ( \Cookie::get('user_role') == "super_admin")
                            SUPER ADMIN
                            @elseif ( \Cookie::get('user_role') == "store_assistant")
                            STORE ASSISTANT
                            @endif
                        </span>
                    </div>
                    <div class="dropdown align-self-center profile-dropdown-menu">
                        <a class="dropdown-toggle mr-0" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <span data-feather="chevron-down"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown">

                            <a href="{{ route('setting') }}" class="dropdown-item notify-item">
                                <i data-feather="user" class="icon-dual icon-xs mr-2"></i>
                                <span>My Account</span>
                            </a>

                            <div class="dropdown-divider"></div>
                            @if(\Cookie::get('theme') == 'dark')
                            <a href="{{route('theme.change','light')}}" class="dropdown-item notify-item">
                                <i data-feather="sun" class="icon-dual icon-xs mr-2"></i>
                                <span>Switch to light mode</span>
                            </a>
                            @else
                            <a href="{{route('theme.change','dark')}}" class="dropdown-item notify-item">
                                <i data-feather="moon" class="icon-dual icon-xs mr-2"></i>
                                <span>Switch to dark mode</span>
                            </a>
                            @endif

                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item notify-item">
                                <i data-feather="log-out" class="icon-dual icon-xs mr-2"></i>
                                <span>Logout</span>
                            </a>

                        </div>
                    </div>
                </div>
            </li>

        </ul>
    </div>

</div>
