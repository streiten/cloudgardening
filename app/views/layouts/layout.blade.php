<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{ HTML::style('css/bootstrap.min.css'); }}
    {{ HTML::style('css/bootstrap-theme.css'); }}
    {{ HTML::style('css/main.css'); }}
    {{ HTML::style('css/font-awesome.min.css'); }}
{{--
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
--}}

    {{ HTML::script('js/vendor/modernizr-2.6.2-respond-1.1.0.min.js'); }}

</head>
<body class="{{{$body_class}}}">

<header>
    <a class="" data-toggle="collapse" href="#menu" >+</a>
    <div class="collapse" id="menu">
        <ul class='list-unstyled'>
            <li><a href="{{{ URL::route('home') }}}">Home</a></li>
            <li><a href="{{{ URL::route('create') }}}">Create</a></li>
            <li><a href="{{{ URL::route('manage') }}}">Manage</a></li>
            <li>-</li>
            @if (Auth::check())
            <li><a href="{{{ URL::route('logout') }}}">Logout</a></li>
            @else
            <li><a href="{{{ URL::route('login') }}}">Login</a></li>
            <li><a href="{{{ URL::route('userCreate') }}}">Register</a></li>
            @endif
            <li>-</li>
            <li><a href="{{{ URL::route('legal') }}}">Legal<br>Privacy</a></li>
        </ul>
    </div>
</header> 

@yield('content')

{{ HTML::script('js/vendor/jquery-1.11.0.min.js'); }}
{{ HTML::script('js/vendor/jquery.lettering.js'); }}
{{ HTML::script('js/vendor/textFit.min.js'); }}
{{ HTML::script('js/vendor/bootstrap.min.js'); }}
{{ HTML::script('js/main.js'); }}


</body>
</html>
