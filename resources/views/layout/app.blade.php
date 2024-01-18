<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex, nofollow" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('assets/img/icons/icon-48x48.png') }}" />
    <title>@yield('title')</title>
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/toaster.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- [ Style Directive ] start -->
    @stack('style')
    <!-- [ Style Directive ] end -->
</head>

<body>
    <div class="wrapper">
        <!-- [ Sidebar ] start -->
        @include('layout.sidebar')
        <!-- [ Sidebar ] end -->
        <div class="main">
            <!-- [ Header ] start -->
            @include('layout.header')
            <!-- [ Header ] end -->

            <!-- [ Main Content ] start -->
            @section('content') @show()
            <!-- [ Main Content ] end -->

            <!-- [ Footer ] start -->
            @include('layout.footer')
            <!-- [ Footer ] end -->
        </div>
    </div>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('assets/js/toaster.js') }}"></script>
    @if(Session::has('msg'))
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
    </script>
    @switch((Session::get('msg'))['code'])
    @case(200)
    <script>
        toastr.success("{{(Session::get('msg'))['message']}}")
    </script>
    @break
    @case(100)
    <script>
        toastr.info("{{(Session::get('msg'))['message']}}")
    </script>
    @break
    @case(111)
    <script>
        toastr.warning("{{(Session::get('msg'))['message']}}")
    </script>
    @break
    @case(400)
    <script>
        toastr.error("{{(Session::get('msg'))['message']}}")
    </script>
    @break
    @endswitch
    </script>
    @endif
    <!-- [ Script Directive ] start -->
    @stack('script')
    <!-- [ Script Directive ] end -->
</body>

</html>