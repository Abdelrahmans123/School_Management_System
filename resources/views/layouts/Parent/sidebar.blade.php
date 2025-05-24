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
                        <a href="{{ route('parent.dashboard') }}"
                            class="{{ Request::path() == App::getLocale() . '/parent/dashboard' ? 'active' : '' }}">
                            <i class="fa-solid fa-house aside__icon"></i>
                            <span class="text aside__text">{{ trans('sidebar.Dashboard') }}</span>
                        </a>
                        <ul class="blank">
                            <li class=" linkName">{{ trans('sidebar.Dashboard') }}</li>
                        </ul>
                    </li>
                    <li class="aside__link">
                        <a href="{{ route('parent.students') }}"
                            class="{{ Request::path() == App::getLocale() . '/parent/students' ? 'active' : '' }}">
                            <i class="fa-solid fa-user-graduate  aside__icon"></i>
                            <span class="text aside__text">{{ trans('sidebar.Student') }}</span>
                        </a>
                        <ul class="blank">
                            <li class=" linkName">{{ trans('sidebar.Student') }}</li>
                        </ul>
                    </li>
                    <li class="aside__link">
                        <a href="{{ route('parent.student.attendance') }}"
                            class="{{ Request::path() == App::getLocale() . '/parent/student/attendance' ? 'active' : '' }}">
                            <i class="fas fa-calendar-check aside__icon "></i>
                            <span class="text aside__text">{{ trans('sidebar.Attendance') }}</span>
                        </a>
                        <ul class="blank">
                            <li class=" linkName">{{ trans('sidebar.Attendance') }}</li>
                        </ul>
                    </li>
                    <li class="aside__link">
                        <a href="{{ route('parent.student.fee') }}"
                            class="{{ Request::path() == App::getLocale() . '/parent/student/fee' ? 'active' : '' }}">
                            <i class="fa-solid fa-file-invoice-dollar aside__icon"></i>
                            <span class="text aside__text">{{ trans('sidebar.Fee') }}</span>
                        </a>
                        <ul class="blank">
                            <li class=" linkName">{{ trans('sidebar.Fee') }}</li>
                        </ul>
                    </li>
                    <li class="aside__link">
                        <a href="{{ route('parent.profile.index') }}"
                            class="{{ Request::path() == App::getLocale() . '/parent/profile' ? 'active' : '' }}">
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
