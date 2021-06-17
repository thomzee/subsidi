<!-- Custom fonts for this template-->
<link href="{{ asset(config('paths.theme').'vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="{{ asset(config('paths.theme').'css/sb-admin-2.min.css') }}" rel="stylesheet">

<link href="{{ asset(config('paths.plugins').'pace/css/pace.css') }}" rel="stylesheet">

<link href="{{ asset(config('paths.plugins').'DataTables/datatables.min.css') }}" rel="stylesheet">

<link href="{{ asset(config('paths.plugins').'toggle/css/bootstrap4-toggle.min.css') }}" rel="stylesheet">

<link href="{{ asset(config('paths.plugins').'select2/dist/css/select2.min.css') }}" rel="stylesheet">

<link href="{{ asset(config('paths.plugins').'datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">

<link href="{{ asset(config('paths.app.css').'styles.css') }}" rel="stylesheet">

@stack('styles')
