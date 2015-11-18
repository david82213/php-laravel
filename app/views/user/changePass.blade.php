@extends('layouts.master')

@section('head')
	@parent
	<title>Register</title>
@stop

@section('content')
	<!--@if(Session::has('success'))
		<div class="alert alert-success">{{ Session::get('success') }}</div>
	@elseif(Session::has('fail'))
		<div class="alert alert-danger">{{ Session::get('fail') }}</div>
	@endif-->
	<div class="container">
		<h1>Change Password</h1>
		
		<form role="form" method="post" action="{{ URL::route('changePassword') }}">
			
			<div class="form-group{{ ($errors->has('oldPassword')) ? ' has-error' : '' }}">
				<label for="oldPassword">Old Password: </label>
				<input id="oldPassword" name="oldPassword" type="password" class="form-control">
				@if($errors->has('oldPassword'))
					{{ $errors->first('oldPassword') }}
				@endif
			</div>
			
			<div class="form-group{{ ($errors->has('password')) ? ' has-error' : '' }}">
				<label for="password">Password: </label>
				<input id="password" name="password" type="password" class="form-control">
				@if($errors->has('password'))
					{{ $errors->first('password') }}
				@endif
			</div>

			<div class="form-group{{ ($errors->has('repass')) ? ' has-error' : '' }}">
				<label for="repass">Confirm password: </label>
				<input id="repass" name="repass" type="password" class="form-control">
				@if($errors->has('repass'))
					{{ $errors->first('repass') }}
				@endif
			</div>
			{{ Form::token() }}

			<div class="form-group">
				<input type="submit" value="Change Password" class="btn btn-default">
		</form>
	</div>
@stop