<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
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
                                <a href="#">
                                    <i class="fa fa-dashboard fa-lg"></i> Dashboard
                                </a>
                            </li>
                            <li data-toggle="collapse" data-target="#new" class="collapsed">
                                <a href="#"><i class="fa fa-car fa-lg"></i> New <span class="arrow"></span></a>
                            </li>
                            <ul class="sub-menu collapse" id="new">
                                <li>New New 1</li>
                            </ul>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-10">
                <h1>Welcome To Dashboard Panel :)</h1>
                <p>
                    this  is test text.this  is test text.this  is test text.this  is test text.
                    this  is test text.this  is test text.this  is test text.this  is test text.
                    this  is test text.this  is test text.this  is test text.this  is test text.
                    this  is test text.this  is test text.this  is test text.this  is test text.
                    this  is test text.this  is test text.
                </p>
            </div>
        </div>
    </div>
</body>
</html>