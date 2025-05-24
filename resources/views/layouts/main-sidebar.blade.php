<aside class="overflow-y-auto">
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

                        <a href="{{ route('dashboard') }}"
                            class="{{ Request::path() == App::getLocale() . '/dashboard' ? 'active' : '' }}">
                            <i class="fa-solid fa-house aside__icon"></i>
                            <span class="text aside__text">{{ trans('sidebar.Dashboard') }}</span>
                        </a>
                        <ul class="blank">
                            <li class=" linkName">{{ trans('sidebar.Dashboard') }}</li>
                        </ul>
                    </li>
                    <li class="aside__link dropdownList">
                        <a href="#" class="{{ Request::path() == App::getLocale() . '/stage' ? 'active' : '' }}">
                            <i class="fa-solid fa-bars-staggered aside__icon"></i>
                            <span class="text aside__text">{{ trans('sidebar.Stage') }}</span>
                            <i class="fa-solid fa-caret-down aside__icon dropdownIcon"></i>
                        </a>
                        <ul class="dropdown">
                            <li class=" linkName">{{ trans('sidebar.Stage') }}</li>
                            <li><a href="{{ route('stage.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/stage' ? 'linkActive' : '' }}">{{ trans('sidebar.StageList') }}</a>
                            </li>
                        </ul>
                    </li>

                    <li class="aside__link dropdownList">
                        <a href="#" class="{{ Request::path() == App::getLocale() . '/grade' ? 'active' : '' }}">
                            <i class="fa-solid fa-graduation-cap aside__icon"></i>
                            <span class="text aside__text">{{ trans('sidebar.Grade') }}</span>
                            <i class="fa-solid fa-caret-down aside__icon dropdownIcon"></i>
                        </a>
                        <ul class="dropdown">
                            <li class=" linkName">{{ trans('sidebar.Grade') }}</li>
                            <li><a href="{{ route('grade.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/grade' ? 'linkActive' : '' }}">{{ trans('sidebar.GradeList') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="aside__link dropdownList">
                        <a href="#"
                            class="{{ Request::path() == App::getLocale() . '/section' ? 'active' : '' }}">
                            <i class="fa-solid fa-network-wired aside__icon"></i>
                            <span class="text aside__text">{{ trans('sidebar.Section') }}</span>
                            <i class="fa-solid fa-caret-down aside__icon dropdownIcon"></i>
                        </a>
                        <ul class="dropdown">
                            <li class=" linkName">{{ trans('sidebar.Section') }}</li>
                            <li><a href="{{ route('section.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/section' ? 'linkActive' : '' }}">{{ trans('sidebar.SectionList') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="aside__link dropdownList">
                        <a href="#"
                            class="{{ Request::path() == App::getLocale() . '/parent' ? 'active' : '' }}">
                            <i class="fa-solid fa-person-breastfeeding aside__icon"></i>
                            <span class="text aside__text">{{ trans('sidebar.Parent') }}</span>
                            <i class="fa-solid fa-caret-down aside__icon dropdownIcon"></i>
                        </a>
                        <ul class="dropdown">
                            <li class="linkName">{{ trans('sidebar.Parent') }}</li>
                            <li><a href="{{ route('parent.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/parent' ? 'linkActive' : '' }}">{{ trans('sidebar.parentList') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="aside__link dropdownList">
                        <a href="#"
                            class="{{ Request::path() == App::getLocale() . '/teacher' ? 'active' : (Request::path() == App::getLocale() . '/teacherSection' ? 'active' : '') }}">
                            <i class="fa-solid fa-chalkboard-user aside__icon"></i>
                            <span class="text aside__text">{{ trans('sidebar.Teacher') }}</span>
                            <i class="fa-solid fa-caret-down aside__icon dropdownIcon"></i>
                        </a>
                        <ul class="dropdown">
                            <li class="linkName">{{ trans('sidebar.Teacher') }}</li>
                            <li><a href="{{ route('teacher.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/teacher' ? 'linkActive' : '' }}">{{ trans('sidebar.teacherList') }}</a>
                                <a href="{{ route('teacherSection.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/teacherSection' ? 'linkActive' : '' }}">{{ trans('sidebar.SectionList') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="aside__link dropdownList">
                        <a href="#"
                            class="{{ Request::path() == App::getLocale() . '/student' ? 'active' : (Request::path() == App::getLocale() . '/promotion' || Request::path() == App::getLocale() . '/promotion/create' || Request::path() == App::getLocale() . '/graduated' || Request::path() == App::getLocale() . '/graduated/create' ? 'active' : '') }}">
                            <i class="fa-solid fa-user-graduate  aside__icon"></i>
                            <span class="text aside__text">{{ trans('sidebar.Student') }}</span>
                            <i class="fa-solid fa-caret-down aside__icon dropdownIcon"></i>
                        </a>
                        <ul class="dropdown">
                            <li class="linkName">{{ trans('sidebar.Student') }}</li>
                            <li><a href="{{ route('student.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/student' ? 'linkActive' : '' }}">{{ trans('sidebar.studentList') }}</a>
                            </li>
                            <li><a href="{{ route('promotion.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/promotion' || Request::path() == App::getLocale() . '/promotion/create' ? 'linkActive' : '' }}">
                                    {{ trans('sidebar.studentPromotion') }}
                                </a>
                            </li>
                            <li><a href="{{ route('graduated.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/graduated' || Request::path() == App::getLocale() . '/graduated/create' ? 'linkActive' : '' }}">
                                    {{ trans('sidebar.studentGraduated') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="aside__link dropdownList">
                        <a href="#"
                            class="{{ Request::path() == App::getLocale() . '/fee' || Request::path() == App::getLocale() . '/invoice' || Request::path() == App::getLocale() . '/processing' || Request::path() == App::getLocale() . '/payment' ? 'active' : '' }}">
                            <i class="fa-solid fa-file-invoice-dollar aside__icon"></i>
                            <span class="text aside__text">{{ trans('sidebar.Fee') }}</span>
                            <i class="fa-solid fa-caret-down aside__icon dropdownIcon"></i>
                        </a>
                        <ul class="dropdown">
                            <li class=" linkName">{{ trans('sidebar.Fee') }}</li>
                            <li><a href="{{ route('fee.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/fee' ? 'linkActive' : '' }}">{{ trans('sidebar.FeeList') }}</a>
                            </li>
                            <li><a href="{{ route('invoice.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/invoice' ? 'linkActive' : '' }}">{{ trans('invoice.InvoiceList') }}</a>
                            </li>
                            <li><a href="{{ route('processing.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/processing' ? 'linkActive' : '' }}">{{ trans('sidebar.processingFee') }}</a>
                            </li>
                            <li><a href="{{ route('payment.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/payment' ? 'linkActive' : '' }}">{{ trans('sidebar.payment') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="aside__link dropdownList">
                        <a href="#"
                            class="{{ Request::path() == App::getLocale() . '/attendance' ? 'active' : '' }}">
                            <i class="fas fa-calendar-check aside__icon "></i>
                            <span class="text aside__text">{{ trans('sidebar.Attendance') }}</span>
                            <i class="fa-solid fa-caret-down aside__icon dropdownIcon"></i>
                        </a>
                        <ul class="dropdown">
                            <li class=" linkName">{{ trans('sidebar.Attendance') }}</li>
                            <li><a href="{{ route('attendance.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/attendance' ? 'linkActive' : '' }}">{{ trans('sidebar.AttendanceList') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="aside__link dropdownList">
                        <a href="#"
                            class="{{ Request::path() == App::getLocale() . '/subject' ? 'active' : '' }}">
                            <i class="fas fa-book aside__icon"></i>
                            <span class="text aside__text">{{ trans('sidebar.Subject') }}</span>
                            <i class="fa-solid fa-caret-down aside__icon dropdownIcon"></i>
                        </a>
                        <ul class="dropdown">
                            <li class=" linkName">{{ trans('sidebar.SubjectList') }}</li>
                            <li><a href="{{ route('subject.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/subject' ? 'linkActive' : '' }}">{{ trans('sidebar.SubjectList') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="aside__link dropdownList">
                        <a href="#"
                            class="{{ Request::path() == App::getLocale() . '/exam' || Request::path() == App::getLocale() . '/quiz' || Request::path() == App::getLocale() . '/question' ? 'active' : '' }}">
                            <i class="fas fa-pencil-alt aside__icon"></i>
                            <span class="text aside__text">{{ trans('sidebar.Exam') }}</span>
                            <i class="fa-solid fa-caret-down aside__icon dropdownIcon"></i>
                        </a>
                        <ul class="dropdown">
                            <li class=" linkName">{{ trans('sidebar.ExamList') }}</li>
                            <li><a href="{{ route('exam.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/exam' ? 'linkActive' : '' }}">{{ trans('sidebar.ExamList') }}</a>
                            </li>
                            <li><a href="{{ route('quiz.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/quiz' ? 'linkActive' : '' }}">{{ trans('sidebar.QuizList') }}</a>
                            </li>
                            <li><a href="{{ route('question.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/question' ? 'linkActive' : '' }}">{{ trans('sidebar.QuestionList') }}</a>
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
                            <li><a href="{{ route('sessions.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/sessions' ? 'linkActive' : '' }}">{{ trans('sidebar.OnlineSessionList') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="aside__link dropdownList">
                        <a href="#"
                            class="{{ Request::path() == App::getLocale() . '/library' ? 'active' : '' }}">
                            <i class="fas fa-book-open aside__icon"></i>

                            <span class="text aside__text">{{ trans('sidebar.Library') }}</span>
                            <i class="fa-solid fa-caret-down aside__icon dropdownIcon"></i>
                        </a>
                        <ul class="dropdown">
                            <li class=" linkName">{{ trans('sidebar.Library') }}</li>
                            <li><a href="{{ route('library.index') }}"
                                    class="{{ Request::path() == App::getLocale() . '/library' ? 'linkActive' : '' }}">{{ trans('sidebar.LibraryList') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="aside__link">
                        <a href="{{ route('settings.index') }}"
                            class="{{ Request::path() == App::getLocale() . '/settings' ? 'active' : '' }}">
                            <i class="fa-solid fa-gear  aside__icon"></i>
                            <span class="text aside__text">{{ trans('sidebar.Settings') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <ul class="aside__bottom aside__list">
            <li class="aside__link">
                @if (auth('student')->check())
                    <form id="logout-form" action="{{ route('logout', 'student') }}" method="GET">
                    @elseif (auth('teacher')->check())
                        <form id="logout-form" action="{{ route('logout', 'teacher') }}" method="GET">
                        @elseif (auth('admin')->check())
                            <form id="logout-form" action="{{ route('logout', 'admin') }}" method="GET">
                            @elseif (auth('parent')->check())
                                <form id="logout-form" action="{{ route('logout', 'parent') }}" method="GET">
                                @else
                                    <form id="logout-form" action="{{ route('logout', 'web') }}" method="GET">
                @endif
                @csrf
                <a href="#" onclick="event.preventDefault();this.closest('form').submit();">
                    <i class="fa-solid fa-right-from-bracket aside__icon"></i>
                    <span class="text aside__text">{{ trans('sidebar.Logout') }}</span>
                </a>
                </form>
            </li>

        </ul>
    </div>

</aside>
