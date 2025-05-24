<!-- jQuery (Only once) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>



<!-- Bootstrap -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- jQuery Plugins -->
<script src="{{ asset('assets/js/plugins-jquery.js') }}"></script>

<!-- Plugin Path Variable -->
<script>
    var plugin_path = '{{ asset('assets/js') }}/';
</script>

<!-- DataTables -->
<script src="{{ asset('assets/js/datatables.min.js') }}"></script>

<!-- Charts & Other Plugins -->
<script src="{{ asset('assets/js/chart-init.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/calendar.init.js') }}"></script>
<script src="{{ asset('assets/js/sparkline.init.js') }}"></script>
<script src="{{ asset('assets/js/morris.init.js') }}"></script>
<script src="{{ asset('assets/js/datepicker.js') }}"></script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- Flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Toastr -->
<script src="{{ asset('assets/js/toastr.js') }}"></script>

<!-- jQuery Validation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<!-- LobiList (Make sure it's loaded after jQuery and Bootstrap) -->
<script src="{{ asset('assets/js/lobilist.js') }}"></script>

<!-- Custom Scripts -->
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/DropdownArrow.js') }}"></script>
<script src="{{ asset('assets/js/sidebar.js') }}"></script>
<script src="{{ asset('assets/js/dashboard.js') }}"></script>

<!-- Yield Section for Additional Scripts -->
@yield('js')
<!-- jQuery UI -->
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui/1.12.1/i18n/datepicker-ar.js"></script>
