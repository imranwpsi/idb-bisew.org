<!DOCTYPE html>
<html lang="en" dir="ltr" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>IDB-BISEW.ORG</title>

    <!-- ==== Google Font ==== -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700%7CLobster">

    <!-- ==== Bootstrap Stylesheet ==== -->
    <link rel="stylesheet" href="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css') }}">

    <!-- ==== Main Stylesheet ==== -->
    <link rel="stylesheet" href="{{ asset('public_assets/css/style.css') }}">

    <!-- ==== HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries ==== -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <div id="app">
        <!-- Wrapper Start -->
        <div class="wrapper">
            <Mainheader></Mainheader>
            <Mainnavbar></Mainnavbar>
            <Mainbanner></Mainbanner>
            <Courseinfo></Courseinfo>
        </div>
        <!-- Wrapper End -->
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/main.js') }}"></script> -->
    <script>
		$(document).ready(function(){
			$(document).on('click', '.megamenu li', function(){
                $('.megamenu li').removeClass('active');
                $('.megamenu li').addClass('others');
                $(this).addClass('active');
                $(this).removeClass('others');

                if($('.megamenu li').hasClass('active')){
                    $('.megamenu li.others .drop-down-container').slideUp();
                    $('.megamenu li.active .drop-down-container').slideToggle();
                    return false;
                }
            });

		});
	</script>
</body>
</html>
