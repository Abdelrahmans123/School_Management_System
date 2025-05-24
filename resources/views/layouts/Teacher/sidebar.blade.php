<aside >
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
                        <a href="{{ route('teacher.dashboard') }}"
                            class="{{ Request::path() == App::getLocale() . '/teacher/dashboard' ? 'active' : '' }}">
                            <i class="fa-solid fa-house aside__icon"></i>
                            <span class="text aside__text">{{ trans('sidebar.Dashboard') }}</span>
                        </a>
                        <ul class="blank">
                            <li class=" linkName">{{ trans('sidebar.Dashboard') }}</li>
                        </ul>
                    </li>
                    <li class="aside__link dropdownList">
                        <a href="#"
                            class="{{ Request::path() == App::getLocale() . '/teacher/attendance' || Request::path() == App::getLocale() . '/teacher/attendance/report' ? 'active' : '' }}">
                            <i class="fas fa-calendar-check aside__icon "></i>
                            <span class="text aside__text">{{ trans('sidebar.Attendance') }}</span>
                            <i class="fa-solid fa-caret-down aside__icon dropdownIcon"></i>
                        </a>
                        <ul class="dropdown">
                            <li class=" linkName">{{ trans('sidebar.Attendance') }}</li>
                            <li><a href="{{ route('teacher.attendance.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/teacher/attendance' ? 'linkActive' : '' }}">{{ trans('sidebar.AttendanceList') }}</a>
                            </li>
                            <li><a href="{{ route('teacher.attendance.report') }}"
                                    class="{{ Request::path() == App::getLocale() . '/teacher/attendance/report' ? 'linkActive' : '' }}">{{ trans('sidebar.AttendanceReport') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="aside__link dropdownList">
                        <a href="#"
                            class="{{ Request::path() == App::getLocale() . '/teacher/exam' || Request::path() == App::getLocale() . '/teacher/quiz' || Request::path() == App::getLocale() . '/teacher/question' ? 'active' : '' }}">
                            <i class="fas fa-pencil-alt aside__icon"></i>
                            <span class="text aside__text">{{ trans('sidebar.Exam') }}</span>
                            <i class="fa-solid fa-caret-down aside__icon dropdownIcon"></i>
                        </a>
                        <ul class="dropdown">
                            <li class=" linkName">{{ trans('sidebar.ExamList') }}</li>
                            <li><a href="{{ route('teacher.exam.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/teacher/exam' ? 'linkActive' : '' }}">{{ trans('sidebar.ExamList') }}</a>
                            </li>
                            <li><a href="{{ route('teacher.quiz.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/teacher/quiz' ? 'linkActive' : '' }}">{{ trans('sidebar.QuizList') }}</a>
                            </li>
                            <li><a href="{{ route('teacher.question.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/teacher/question' ? 'linkActive' : '' }}">{{ trans('sidebar.QuestionList') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="aside__link dropdownList">
                        <a href="#"
                            class="{{ Request::path() == App::getLocale() . '/sessions' ? 'active' : '' }}">
                            <i class="fas fa-video aside__icon"></i>
                            <span class="text aside__text">{{ trans('sidebar.OnlineSessions') }}</span>
                            <i class="fa-solid fa-caret-down aside__icon dropdownIcon"></i>
                        </a>
                        <ul class="dropdown">
                            <li class=" linkName">{{ trans('sidebar.OnlineSessions') }}</li>
                            <li><a href="{{ route('teacher.sessions.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/sessions' ? 'linkActive' : '' }}">{{ trans('sidebar.OnlineSessionList') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="aside__link">
                        <a href="{{ route('teacher.profile.index') }}"
                            class="{{ Request::path() == App::getLocale() . '/teacher/profile' ? 'active' : '' }}">
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
