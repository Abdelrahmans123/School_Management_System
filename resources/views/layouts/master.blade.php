<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/icon.png') }}" />

    @include('layouts.head')
    @yield('css')
    <style>
        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
    @if (auth()->guard('admin')->check())
        <style>
            .content {
                height: 100vh;
            }

            aside {
                height: 100vh;
                overflow-y: auto;
            }
        </style>
    @endif

</head>

<body>

    <!-- Preloader -->
    <div id="pre-loader">
        <span class="loader"></span>
    </div>
    <div class="master">
        @switch(true)
            @case(auth('student')->check())
                @include('layouts.Student.sidebar')
            @break

            @case(auth('admin')->check())
                @include('layouts.Admin.sidebar')
            @break

            @case(auth('teacher')->check())
                @include('layouts.Teacher.sidebar')
            @break

            @case(auth('parent')->check())
                @include('layouts.Parent.sidebar')
            @break

            @default
                @include('layouts.main-sidebar')
        @endswitch

        <!-- Main Content -->
        <div class="content">

            <!-- Header -->
            <div class="content__header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <h1>@yield('headerTitle')</h1>
                    @hasSection('dashboard')
                        <h2>{{ trans('sidebar.hi') }} @yield('userName')</h2>
                    @endif
                </div>
                <div class="d-flex align-items-center gap-3">

                    <!-- Language Selector -->
                    <div class="languageContainer">
                        <button class="btn btn-outline-primary d-flex align-items-center" id="dropdownBtn">
                            <i class="fa-solid fa-globe"></i>
                        </button>
                        <ul class="languageDropdown d-none">
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li class="languageItem">
                                    <a rel="alternate" hreflang="{{ $localeCode }}"
                                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Dark Mode Toggle -->
                    <div class="mode d-flex align-items-center">
                        <div class="moonSun">
                            <i class="fa-solid fa-moon mode__icon moon"></i>
                            <i class="fa-solid fa-sun mode__icon sun"></i>
                        </div>
                        <div class="toggle-switch">
                            <span class="switch"></span>
                        </div>
                    </div>

                    <!-- Notifications -->
                    <i class="fa-solid fa-bell bellIcon"></i>

                    <!-- User Profile -->
                    <div class="userProfile">
                        <div class="user__image">
                            <img src="{{ asset('assets/images/profile-avatar.jpg') }}" alt="User Profile"
                                class="profile-img">
                        </div>
                        <div class="userProfile__dropdown d-none">
                            <ul>
                                <li>Profile</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

            @yield('content')

        </div>
    </div>
    <!-- Sidebar -->


    @include('layouts.footer-scripts')

</body>

</html>
