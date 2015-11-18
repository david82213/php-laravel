@extends('layouts.master')

@section('head')
	@parent
	<title>Home Page</title>
@stop

@section('content')
	@if(Session::has('success'))
		<div class="alert alert-success">{{ Session::get('success') }}</div>
	@elseif (Session::has('fail'))
		<div class="alert alert-danger">{{ Session::get('fail') }}</div>
	@endif

	<head><link rel="stylesheet" type="text/css" href="../public/css/home-style.css"></head>
	<header>

		<div id="header-left">
			<div id="logo"><a href="../public/" title="Home"><img src="../image/u-life-logo.jpg" alt="Home" /></a></div>
		</div><!-- #header-left -->

	<div id="header-right">
		<div id="header-right-1">
			<a class="tile tile-forum" href="../public/chat"><img src="../image/tile-forum.png" alt="FORUM" /><span class="tile-title">CHAT ROOM</span></a>

			<a class="tile tile-groups" href="../public/forum" alt="GROUPS" /><img src="../image/tile-groups.png" alt="GROUP" /><span class="tile-title">GROUPS</span></a>
			<a class="tile tile-help" href="{{ URL::route('about') }}"><img src="../image/tile-info.png" alt="ABOUT US" /><span class="tile-title">ABOUT US</span></a>
			<a class="tile tile-activities" href="../public/forum/book"><img src="../image/tile-activities.png" alt="BOOK" /><span class="tile-title">U-BOOK</span></a>
		</div><!-- #header-right-1 -->

	<div id="header-right-2">
	<div class="tile2">

				<div id="tile-user">
					
					@if(!Auth::check())
					<div class="tile-username">Hello! <br> </div><span class="tile-title"><a  href="{{ URL::route('getLogin') }}"> Sign In</a> /&nbsp; <a href="{{ URL::route('getCreate') }}"> Register</a></span>
					@else
					<div class="tile-avatar"><img src="{{ Auth::user()->profile_img }}" alt="Avatar" width="88" height="88" /></div>
					<a class="tile-username" href="../public/user/profile"> Hello! </br>View Profile</a>
					
					<!--<span class="tile-title"><a href="..public/user/login">Log In</a> <span class="tile-register">or&nbsp;<a href="..public/user/create">Sign Up</a></span></span>-->
					@endif
				</div>

		</div><!-- .tile2 -->

		<div class="header-right-2-bottom">
			@if(!Auth::check())
			<a class="tile tile-users" href="{{ URL::route('members') }}"><img src="../image/tile-members.png" alt="MEMBERS" /><span class="tile-title">MEMBERS</span></a>
			@else
			<a class="tile tile-users" href="{{ URL::route('member') }}"><img src="../image/tile-members.png" alt="MEMBERS" /><span class="tile-title">MEMBERS</span></a>
			@endif
			<a class="tile tile-blog" href="../public/post"><img src="../image/tile-blog.png" alt="QUICK POST" /><span class="tile-title">QUICK POST</span></a>
		</div><!-- .header-right-2-bottom -->
	</div><!-- .header-right-2 -->
	</div><!-- #header-right -->

	</header>




	<div class="frontpage">

		<div id="tabs-container">
			<div id="mytabs" role="tabpanel">

			        	<ul id="tabs "class="nav nav-tabs" data-tabs="tabs" role="tablist">
			                <li role="presentation" class="active" ><a href="#popular" role="tab" data-toggle="tab">Popular</a></li>
			 
			                <li role="presentation"><a href="#newest" role="tab" data-toggle="tab">Newest</a></li>
			            </ul>
			</div>

			<div id="tab-contents" class="tab-content">


				<ul id="popular" class="tab-pane fade active in" role="tabpanel">
				    <div id="message" >
				        <p>There were no groups found-popular.</p>
				    </div>
				<br />
				</ul>

				<ul id="newest" class="tab-pane fade" role="tabpanel">
				    <div id="message" >
				        <p>There were no groups found-newest.</p>
				    </div><br />
				</ul>
			</div> <!-- List Wrap -->
		</div> <!-- tabs-container -->
	</div><!-- .frontpage -->
@stop