<aside>
    <header>
        <div class="image-text">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo" class="image">
            <img src="{{ asset('assets/images/icon.png') }}" alt="logo" class="icon d-none">
        </div>
        <i class="fa-solid fa-angle-right toggleIcon"></i>
    </header>
    <div class="d-flex flex-column ">
        <div class="aside__content">
            <div class="aside__body">
                <div class="aside__search">
                    <input type="text" class="form-control" placeholder="Search...">
                    <a href="#" class="btn btn-secondary">
                        <i class="fa-solid fa-magnifying-glass searchIcon"></i>
                    </a>
                </div>
                <ul class="aside__list">
                    <li class="aside__link">
                        <a href="{{ route('student.dashboard') }}"
                            class="{{ Request::path() == App::getLocale() . '/student/dashboard' ? 'active' : '' }}">
                            <i class="fa-solid fa-house aside__icon"></i>
                            <span class="text aside__text">{{ trans('sidebar.Dashboard') }}</span>
                        </a>
                        <ul class="blank">
                            <li class=" linkName">{{ trans('sidebar.Dashboard') }}</li>
                        </ul>
                    </li>
                    <li class="aside__link">
                        <a href="{{ route('student.exam.index') }}"
                            class="{{ Request::path() == App::getLocale() . '/student/exam' ? 'active' : '' }}">
                            <i class="fa-solid fa-house aside__icon"></i>
                            <span class="text aside__text">{{ trans('sidebar.Exam') }}</span>
                        </a>
                        <ul class="blank">
                            <li class=" linkName">{{ trans('sidebar.Exam') }}</li>
                        </ul>
                    </li>
                    <li class="aside__link">
                        <a href="{{ route('student.profile.index') }}"
                            class="{{ Request::path() == App::getLocale() . '/student/profile' ? 'active' : '' }}">
                            <i class="fa-solid fa-id-badge aside__icon"></i>
                            <span class="text aside__text">{{ trans('sidebar.Profile') }}</span>
                        </a>
                        <ul class="blank">
                            <li class=" linkName">{{ trans('sidebar.Profile') }}</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        @include('layouts.logout')
    </div>
</aside>
