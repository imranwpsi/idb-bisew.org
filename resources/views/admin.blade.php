<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>ADMIN-IDB-BISEW.ORG</title>


	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link href="{{ asset('admin_assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
	<link href="{{ asset('admin_assets/css/core.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('admin_assets/css/components.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('admin_assets/css/style.css') }}" rel="stylesheet" type="text/css">



	<script type="text/javascript" src="{{ asset('admin_assets/js/plugins/loaders/pace.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin_assets/js/core/libraries/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin_assets/js/core/libraries/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin_assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-strap/1.1.40/vue-strap.min.js"></script>


	<script type="text/javascript" src="{{ asset('admin_assets/js/core/app.js') }}"></script>


</head>

<body>
    <div id="app">
        <Myheader></Myheader>
        <!-- Page container -->
        <div class="page-container">
            <!-- Page content -->
            <div class="page-content">
                <Leftsidebar></Leftsidebar>
                <main role="main" class="col-md-12" style="margin-top: 20px;">
                    <router-view></router-view>
                </main>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
