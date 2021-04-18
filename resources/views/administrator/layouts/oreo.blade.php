<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AMS - Control Panel</title>
  <link href="{{asset('lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
  <link href="{{asset('lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('lib/summernote/summernote-bs4.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/bracket.css')}}">
  <link rel="stylesheet" href="{{asset('css/bracket.oreo.css')}}">
</head>

  <body>

  @include('administrator.leftbar')
  @include('administrator.topbar')
  @include('administrator.rightbar')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
     

      <div class="br-pagebody">

              @yield('content')

      </div><!-- br-pagebody -->

      <div class="clearfix"></div>
    
    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
    <script type="text/javascript">

  var baseurl = "<?php echo url('/'); ?>";

</script>

    <script src="{{asset('lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('lib/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <script src="{{asset('lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('lib/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('lib/moment/min/moment.min.js')}}"></script>
   

    <script src="{{asset('js/bracket.js')}}"></script>
    <script src="{{asset('js/admin.js')}}"></script>




  </body>
</html>
