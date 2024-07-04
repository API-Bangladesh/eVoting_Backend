<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en-US"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="en-US"> <![endif]-->
<!--[if gt IE 8]><!-->
<!--<![endif]-->
<!--[if gte IE 9] <style type="text/css"> .gradient {filter: none;}</style><![endif]-->
<!--[if !IE]>
<html lang="en"><![endif]-->
<html lang="en-US" class="no-js">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ get_uploaded_file_url(setting()->get('icon')) }}"/>
    <meta name="misapplication-TileColor" content="#ffffff"/>
    <meta name="theme-color" content="#ffffff"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="base-url" content="{{ url('/') }}"/>
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    {{-- CSS Styles --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-icons.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"/>

    {{-- JS Scripts & Plugins --}}
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY') }}/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment-precise-range-plugin@1.3.0/moment-precise-range.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script
            src="https://cdnjs.cloudflare.com/ajax/libs/eonasdan-bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
    </script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            height: 300
        });
    </script>
    <style>
        .tox.tox-silver-sink.tox-tinymce-aux {
            display: none;
        }
    </style>
</head>

<body>
