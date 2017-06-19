<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link type="text/css" rel="stylesheet" href="/assets/css/css.css"/>
    <script type="text/javascript" src="/assets/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="/assets/js/base.js"></script>
    <!--[if IE 6]>
    <script type="text/javascript" src="/assets/js/Png_js.js"></script>
    <script type="text/javascript">
        DD_belatedPNG.fix('*');
    </script>

    <![endif]-->
    <title>@yield('title')</title>
</head>
@yield('css')
<body>
@yield('content')
</body>
<script>
    window.location.href = '#you_jump_i_jump';
</script>
@include('home.layouts.notify')
@yield('js')
@include('flashy::message')
</html>
