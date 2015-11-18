@extends('layouts.master')

@section('head')
	@parent
	<title>U-Life | {{ $thread->title }}</title>
@stop

@section('content')
	<div class="clearfix">
		<ol class="breadcrumb">
			<li><a href="{{ URL::route('forum-home')}}">Forum</a></li>
			<li><a href="{{ URL::route('forum-category', $thread->category_id)}}">{{ $thread->category->title}}</a></li>
			<li class="active">{{ $thread->title}}</li>
		</ol>
		@if (Auth::check()&&Auth::user()->isAdmin())
		<a href="{{URL::route('forum-delete-thread', $thread->id)}}" class="btn btn-danger pull-right">Delete</a>
		@endif
	</div>

	<div class="well well-lg">
		<h1>{{ $thread->title }}</h1>
		<h5><img src="../{{Auth::user()->profile_img}}" width='50' height='50'> {{$author}}</h5>
		<h5 class="pull-right"> {{ $thread->created_at}}</h5>

	<hr>
		<p>{{ nl2br(BBCode::parse($thread->body)) }}</p>
	</div>

	@foreach($thread->comments()->get() as $comment)
		<div class="well well-lg">
			<h5><img src="../../{{$comment->author->profile_img}}" width='50' height='50'> {{ $comment->author->username}}</h5>
			<h5 class="pull-right"> {{ $comment->created_at}}</h5>

		<hr>
			<p>{{ nl2br(BBCode::parse($comment->body)) }}</p>

			@if (Auth::check() && Auth::user()->isAdmin())
				<a href="{{ URL::route('forum-delete-comment', $comment->id)}}" class="btn btn-danger">Delete Comment</a>
			@endif
		</div>
	@endforeach

	@if(Auth::check())
	<form action="{{ URL::route('forum-store-comment', $thread->id) }}" method="POST">

		<div class="form-group">
			<label for ="body">Comment: </label>
			<textarea class="form-control" name="body" id="body"></textarea>
		</div>

		{{ Form::token()}}
		<div class="form-group">
			<input type="submit" value="Post" class="btn btn-primary">
		</div>
	</form>
	@endif
@stop