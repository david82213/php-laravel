@extends('layouts.master')

@section('head')
	@parent
	<title>Members</title>
@stop

@section('content')
	@if(!Auth::check())
		
		{{ Redirect::route('getLogin') ->with('fail', 'You must login to use this function')}}
	@else
		<head><link rel="stylesheet" type="text/css" href="../css/profile-style.css"></head>
		<div class="container">
			<div class="page-title">Profile</div> 
			<ul>
			@foreach($users as $user)
				<li>{{HTML::linkRoute('memberDetail',$user->username, array($user->id))}}</li>
			@endforeach
			</ul>
		</div>
	@endif
	
@stop