<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Lamoda quest</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" />
    <!-- Custom Theme files -->
    <link href="/css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
    <link href="/css/style.css" type="text/css" rel="stylesheet" media="all">
    <!-- font-awesome icons -->
    <link href="/css/fontawesome-all.min.css" rel="stylesheet">
    <!-- //Custom Theme files -->
    <!-- online-fonts -->
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet">
    <!-- //online-fonts -->

</head>
<body>
    <div class="sidenav">
		<div class="row side_top">
		<div class="col-4 side_top_left">
		</div>
		<div class="col-8 side_top_right">
			<h6>Родионов Станислав</h6>
			<p>Lamoda quest</p>
		</div>
		</div>
       <header>
			<div class="container-fluid px-md-5 ">
				<nav class="mnu mx-auto">
                    <label for="drop" class="toggle">Menu</label>
                    <input type="checkbox" id="drop">
						<ul class="menu">
							<li class="{{ app('url')->current() == url('/') ? 'active' : '' }}"><a href="/" class="scroll">Главная</a></li>
                            <li class="{{ app('url')->current() == url('/get-list') ? 'active' : '' }} mt-sm-3"><a href="/get-list" class="scroll">Решение хитрым алгоритмом</a></li>
                            <li class="{{ app('url')->current() == url('/get-list') ? 'active' : '' }} mt-sm-3"><a href="/decisions" class="scroll">Решение перебором</a></li>
                            <li class="{{ (app('url')->current() == url('/containers') || app('url')->current() == url('/containers/generate')) ? 'active' : '' }} mt-sm-3"><a href="/containers" class="scroll">Контейнеры</a></li>
							<li class="{{ app('url')->current() == url('/info') ? 'active' : '' }} mt-sm-3"><a href="/info" class="scroll">Информация</a></li>
							<li class="{{ app('url')->current() == url('/#contacts') ? 'active' : '' }} mt-sm-3"><a href="/#contact" class="scroll">Контакты</a></li>
                        </ul>
				</nav>
			</div>
		</header>
    </div>
    <div class="main" id="home">
		@yield('content')
    </div>
</body>
</html>