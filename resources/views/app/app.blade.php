<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Ad Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <link rel="stylesheet" href="{{ asset('lib/timepicker/jquery.timepicker.css')}}">
    <link rel="stylesheet" href="{{ asset('css/components.css')}}">
    <link rel="stylesheet" href="{{ asset('css/icons.css')}}">
    <link rel="stylesheet" href="{{ asset('lib/ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/responsee.css')}}">
    <link rel="stylesheet" href="{{ asset('owl-carousel/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{ asset('css/template-style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bracket.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bracket.oreo.css')}}">
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display&subset=latin,latin-ext' rel='stylesheet'
          type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800&subset=latin,latin-ext'
          rel='stylesheet' type='text/css'>

</head>

<body class="size-1140">
<!-- HEADER -->
<header role="banner" class="position-absolute  background-dark">
    <!-- Top Navigation -->
    <nav class="background-transparent background-transparent-hightlight full-width sticky">
        
        <div class="top-nav s-12 l-10">
            <p class="nav-text"></p>
            <ul class="right chevron">
                <li><a href="{{url('/')}}">Home</a></li>
                @if(Auth::check())
                <li class="submenu"><a aria-haspopup="true" href="#">My Account</a>

                  
                        <ul>
                            <li><a href="{{route('administrator.index')}}">Dashboard</a></li>
                            <li><a onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">@csrf</form>

                            </li>
                        </ul>
                    @endif
                </li>
            </ul>
        </div>
    </nav>
</header>

@yield('content')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="{{ asset('lib/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/responsee.js')}}"></script>
<script type="text/javascript" src="{{ asset('owl-carousel/owl.carousel.js')}}"></script>
<script type="text/javascript" src="{{ asset('lib/timepicker/jquery.timepicker.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/template-scripts.js?v=1.0.3')}}"></script>

</body>
</html>
