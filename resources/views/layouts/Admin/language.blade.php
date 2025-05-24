<div class="languageContainer">
    <button class="btn btn-outline-primary d-flex align-items-center" id="dropdownBtn">
        <i class="fa-solid fa-globe"></i>
    </button>
    <ul class="languageDropdown d-none">
        <li class="languageItem">
            <a href="{{ route('admin.dashboard', ['locale' => 'en']) }}" class="languageLink">
                English
            </a>
        </li>
        <li class="languageItem">
            <a href="{{ route('admin.dashboard', ['locale' => 'ar']) }}" class="languageLink">
                العربية
            </a>
        </li>
    </ul>
</div>
