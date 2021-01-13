<!DOCTYPE html>
<html lang=""{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.header')
</head>
<body class="d-flex flex-column min-vh-100">
    @include('includes.nav')
    <div class="container">
        <main role="main" class="pb-3">
            @yield('content')
        </main>
    </div>
</body>
@include('includes.footer')
</html>
