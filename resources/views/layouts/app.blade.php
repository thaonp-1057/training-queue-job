<!DOCTYPE html>
<html>
<head>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div  class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                <div class="nav-side-menu">
                    <div class="brand"></div>
                    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
                    <div class="menu-list">
                        <ul id="menu-content" class="menu-content collapse out">
                            <li>
                                <a href="{{ route('schedules.create') }}">
                                    {{-- <i class="fa fa-dashboard fa-lg"></i>  --}}
                                    @lang('app.layout.new_schedule')
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('schedules.index') }}">
                                    {{-- <i class="fa fa-dashboard fa-lg"></i>  --}}
                                    @lang('app.layout.schedules')
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-10">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>