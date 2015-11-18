@extends('layouts.master')

@section('head')
	@parent
	<title>New post</title>
@stop
@section('content')
	<h1>New post</h1>

	<form action="{{ URL::route('forum-store-thread', $id) }}" method="POST">
		<div class="form-group">
			<label for="title">Topic Title: </label>
			<input type="text" class="form-control" name="title" id="title">
		</div>

		<div class="form-group">
			<label for="body">Content: </label>
			<textarea class="form-control" name="body" id="body"></textarea>
		</div>

		{{ Form::token()}}
		<div class="form-group">
			<input type="submit" value="Post" class="btn btn-primary">
		</div>
	</form>
@stop