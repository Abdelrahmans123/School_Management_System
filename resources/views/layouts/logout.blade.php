<ul class="aside__bottom aside__list">
    <li class="aside__link">
        @if (auth('student')->check())
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                <input type="hidden" name="type" value="student">
            @elseif (auth('teacher')->check())
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    <input type="hidden" name="type" value="teacher">
                @elseif (auth('admin')->check())
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        <input type="hidden" name="type" value="admin">
                    @elseif (auth('parent')->check())
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            <input type="hidden" name="type" value="parent">
                        @else
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                <input type="hidden" name="type" value="web">
        @endif
        @csrf
        <a href="#" onclick="event.preventDefault();this.closest('form').submit();">
            <i class="fa-solid fa-right-from-bracket aside__icon"></i>
            <span class="text aside__text">{{ trans('sidebar.Logout') }}</span>
        </a>
        </form>
    </li>

</ul>
