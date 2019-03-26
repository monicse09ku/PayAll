<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PayAll') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/AdminLTE.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/_all-skins.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-jvectormap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatable.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    

    <div class="wrapper">
        
        @include('layouts.top-bar')
        
        @include('layouts.left-sidebar')
        
        @yield('content')

        @include('layouts.footer')
    </div>

    <script src="{{ asset('js/jquery.min.js') }}" ></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('js/raphael.min.js') }}" defer></script>
    <script src="{{ asset('js/morris.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.sparkline.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery-jvectormap-1.2.2.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery-jvectormap-world-mill-en.js') }}" defer></script>
    <script src="{{ asset('js/jquery.knob.min.js') }}" defer></script>
    <script src="{{ asset('js/moment.min.js') }}" defer></script>
    <script src="{{ asset('js/daterangepicker.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap3-wysihtml5.all.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.slimscroll.min.js') }}" defer></script>
    <script src="{{ asset('js/fastclick.js') }}" defer></script>
    <script src="{{ asset('js/adminlte.min.js') }}" defer></script>
    <script src="{{ asset('js/dashboard.js') }}" defer></script>
    <script src="{{ asset('js/demo.js') }}" defer></script>
    <script src="{{ asset('js/datatable.min.js') }}" defer></script>
    <script src="{{ asset('js/siteown.js') }}" defer></script>

    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('f168311b8b6cae7adac4', {
            cluster: 'ap2',
            forceTLS: true
        });
        var channel_name = 'notification-channel.'+ "<?php echo \Auth::user()->id;?>";
        //var channel_name = 'my-channel';
        var channel = pusher.subscribe(channel_name);
        channel.bind('my-event', function(data) {
            var audio_file_path = "<?php echo asset('css/notification_sound.wav')?>";
            var audio = new Audio(audio_file_path);
            audio.play();
            alert(data.message);
            if(data.reload === 'true'){
                location.reload();
            }
        });
    </script>

    <!-- <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script> -->
    
    @yield('page_scripts')
</body>
</html>
