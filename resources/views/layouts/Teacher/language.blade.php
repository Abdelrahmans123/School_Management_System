<div class="languageContainer">
    <button class="btn btn-outline-primary d-flex align-items-center" id="dropdownBtn">
        <i class="fa-solid fa-globe"></i>
    </button>
    <ul class="languageDropdown d-none">
        <li class="languageItem">
            <a href="{{ route('teacher.dashboard', ['locale' => 'en']) }}" class="languageLink"
                onclick="{{ app()->setLocale('en') }}">
                English
            </a>
        </li>
        <li class="languageItem">
            <a href="{{ route('teacher.dashboard', ['locale' => 'ar']) }}" class="languageLink"
                onclick="{{ app()->setLocale('ar') }}">
                العربية
            </a>
        </li>
    </ul>
</div>
