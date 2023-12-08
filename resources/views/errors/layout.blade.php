<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('theme/images/favicon.png') }}"/>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Arvo'>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    
    <style>
        .page_404 {
            padding: 100px 0;
            background: #fff;
            font-family: 'Arvo', serif;
        }

        .page_404 img {
            width: 100%;
        }

        .four_zero_four_bg {
            background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
            height: 400px;
            background-position: center;
            background-repeat: no-repeat;
        }

        .four_zero_four_bg h1 {
            font-size: 80px;
        }

        .four_zero_four_bg h3 {
            font-size: 80px;
        }

        .link_404 {
            color: #fff !important;
            padding: 10px 20px;
            background: #39ac31;
            margin: 20px 0;
            display: inline-block;
            border-radius: 4px;
            transition: all 0.2s ease-in-out;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
        }

        .link_404:hover {
            background: #3db833;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
        }

        .content_box_404 {
            margin-top: -50px;
        }
    </style>
</head>
<body>

<section class="page_404">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 d-flex justify-content-center">
                <div class="col-sm-10  text-center">
                    <div class="four_zero_four_bg">
                        <h1 class="text-center">
                            @yield('code')
                        </h1>
                    </div>

                    <div class="content_box_404">
                        <h3 class="h2">
                            Look like you're lost
                        </h3>

                        <p>@yield('message')</p>

                        <a href="{{ url('/') }}" class="link_404">
                            Go to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
