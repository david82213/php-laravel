@extends('layouts.master')

@section('head')
	@parent
	<title>Register</title>
@stop

@section('content')
	<div class="container">
		<h1>Register</h1>
		
		<form role="form" method="post" action="{{ URL::route('postCreate') }}">
			<div class="form-group{{ ($errors->has('username')) ? ' has-error' : '' }}">
				<label for="username">Username: </label>
				<input id="username" name="username" type="text" class="form-control">
				@if($errors->has('username'))
					{{ $errors->first('username') }}
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

			<div class="form-group{{ ($errors->has('email')) ? ' has-error' : '' }}">
				<label for="email">Email: </label>
				<input id="email" name="email" type="text" class="form-control">
				@if($errors->has('email'))
					{{ $errors->first('email') }}
				@endif
			</div>
		<!--{{Form::open(array('url' => 'upload', 'files'=>true))}}
		{{Form::file('image')}}
		{{Form::submit('upload')}}
		{{Form::close()}}-->

			{{ Form::token() }}

			<div class="form-group">
				<input type="submit" value="Register" class="btn btn-default">
		</form>
	</div>
@stop