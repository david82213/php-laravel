@extends('layouts.master')

@section('head')
	@parent
	<title>Change Profile Picture</title>
@stop

@section('content')
	@if(Session::has('success'))
		<div class="alert alert-success">{{ Session::get('success') }}</div>
	@elseif(Session::has('fail'))
		<div class="alert alert-danger">{{ Session::get('fail') }}</div>
	@endif
	<div class="container">
		<h1>Change Profile Picture</h1>
		
		<form role="form" method="post" action="{{ URL::route('changeProfilePicture') }}" enctype="multipart/form-data">
			
			<div class="form-group{{ ($errors->has('image')) ? ' has-error' : '' }}">
				<label for="image">Select Picture: </label>
				<input id="image" name="image" type="file" class="form-control">
				<br>
				<input type="submit" name="change_pic" value="Change Picture" class="btn btn-default">
			</div>
			
			
			<!--{{ Form::token() }}

			<div class="form-group">
				<input type="submit" value="Change Picture" class="btn btn-default">-->
		</form>
	</div>
@stop