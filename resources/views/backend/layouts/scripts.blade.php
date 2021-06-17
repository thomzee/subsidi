<!-- Bootstrap core JavaScript-->
<script src="{{ asset(config('paths.theme').'vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset(config('paths.theme').'vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset(config('paths.theme').'vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset(config('paths.theme').'js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
{{--<script src="{{ asset(config('paths.theme').'vendor/chart.js/Chart.min.js') }}"></script>--}}

<!-- Page level custom scripts -->
{{--<script src="{{ asset(config('paths.theme').'js/demo/chart-area-demo.js') }}"></script>--}}
{{--<script src="{{ asset(config('paths.theme').'js/demo/chart-pie-demo.js') }}"></script>--}}

<script src="{{ asset(config('paths.plugins').'pace/js/pace.min.js') }}"></script>

<script src="{{ asset(config('paths.plugins').'DataTables/datatables.min.js') }}"></script>

<script src="{{ asset(config('paths.plugins').'holder/holder.min.js') }}"></script>

<script src="{{ asset(config('paths.plugins').'toggle/js/bootstrap4-toggle.min.js') }}"></script>

<script src="{{ asset(config('paths.plugins').'select2/dist/js/select2.min.js') }}"></script>

<script src="{{ asset(config('paths.plugins').'datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<script src="{{ asset(config('paths.plugins').'numerictext/autonumeric.js') }}"></script>

<script src="{{ asset(config('paths.plugins').'sweetalert2/sweetalert2.all.min.js') }}"></script>

<script src="{{ asset(config('paths.app.js').'scripts.js') }}"></script>

@stack('scripts')
