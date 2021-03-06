@extends('layouts.master')

@section('head')
	@parent
	<title>Member Detail</title>
@stop

@section('content')
	@if(!Auth::check())
		
		{{ Redirect::route('getLogin') ->with('fail', 'You must login to use this function')}}
	@else
		<head><link rel="stylesheet" type="text/css" href="../css/profile-style.css"></head>
		<header></header>
	<div class="container">
		<div class="page-title">Member {{$detail->id}} Detail</div> 
 
			<div id="item-header" role="complementary">
	 	 	 
 
<div id="item-header-avatar">
	 
		<!--<img src="http://gravatar.com/avatar/8c87602c823e133a6e63e70aa95f9a2a?d=mm&amp;s=150&amp;r=G" class="avatar user-1-avatar avatar-150 photo" width="150" height="150" alt="Profile picture of user" />-->
	 	<!--<img src="../profile-image/default.png">-->
	 	<img src="{{ $detail->profile_img }}" width='150' height='150'>

</div><!-- #item-header-avatar -->
	 
<div id="item-header-content"> 
	<h2>
	 
	<p>UserId :	{{$detail->id}}</p>
	 
	<p>User Name: {{$detail->username}}</p>
	 </h2>
	 
	
	  
	 
<div id="item-meta">

	

  
	 
	<div id="latest-update"> 
		</div>
	 
	<div id="item-buttons"> 
		</div><!-- #item-buttons -->
	</div><!-- #item-meta -->
	 
</div><!-- #item-header-content -->
	 
			</div><!-- #item-header -->
	 
			<div id="item-body">	 
<div id="tabs-container">
	 
<div id="mytabs" role="tabpanel">	 
       	<ul id="tabs "class="nav nav-tabs" data-tabs="tabs" role="tablist">
 
               <li role="presentation" class="active" ><a href="#mypost" role="tab" data-toggle="tab">Member Posts</a></li>
	 
             
	 

	 
               <li role="presentation"><a href="#friends" role="tab" data-toggle="tab">Member Friends <span class="no-count">[0]</span></a></li>
	
          </ul>	 
</div>
	 
<div id="tab-contents" class="tab-content">	 
	<ul id="mypost" class="tab-pane fade active in" role="tabpanel">
	 
    	<div id="message" >
	 
       		<p>Haven't post anything.</p>
		</div>
	<br />
	</ul>
	
	<ul id="notification" class="tab-pane fade active in" role="tabpanel">
		<div id="message" >
			<p>You have no notification.</p>
		</div>
	<br />
	</ul>
 
<ul id="friends" class="tab-pane fade" role="tabpanel">
	 
 <div id="message" >
	 
      <p>Have not add friend yet</p>
	 
  </div><br />
 
</ul>
	 
	 
</div> <!-- List Wrap -->	 
</div> 
	</div><!-- #item-body -->
 
</div><!-- #content -->
</div>
	@endif
	
@stop