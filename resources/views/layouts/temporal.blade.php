<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PIEGRANDE ZAPATERIA</title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="PIEGRANDE ZAPATERIA">
    <meta name="keywords" content="">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#c5103c">
    <!-- Scripts -->
    @vite(['resources/css/app.scss'])
    @vite(['resources/css/responsive.scss'])
</head>
<!-- Body-->
<body>

<div id="app">
    @yield('content')
</div>

<!-- Back To Top Button--><a class="scroll-to-top-btn" href="#"><i class="scroll-to-top-btn-icon" data-feather="chevron-up"></i></a>

<script src="/js/vendor.min.js"></script>
@vite(['resources/js/app.js'])
@yield('footer-scripts')

</body>
</html>
