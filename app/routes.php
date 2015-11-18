<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses' => 'HomeController@hello', 'as' => 'home'));


Route::get('mail',function(){
	Mail::queue('message', array('name' => 'Max'), function($message){
		$message->to('liuxunchao1212@hotmail.com', 'Max Liu')->subject('testtest');
	});
});

Route::group(array('prefix' => '/forum'), function()
{
	Route::get('/', array('uses' => 'ForumController@index', 'as' => 'forum-home'));
	Route::get('/category/{id}', array('uses' => 'ForumController@category', 'as' => 'forum-category'));
	Route::get('/thread/{id}', array('uses' => 'ForumController@thread', 'as' => 'forum-thread'));

	Route::group(array('before' => 'admin'), function()
	{
		Route::get('/group/{id}/delete', array('uses' => 'ForumController@deleteGroup', 'as' => 'forum-delete-group'));
		Route::get('/category/{id}/delete', array('uses' => 'ForumController@deleteCategory', 'as' => 'forum-delete-category'));
		Route::get('/thread/{id}/delete', array('uses' => 'ForumController@deleteThread', 'as' => 'forum-delete-thread'));
		Route::get('/comment/{id}/delete', array('uses' => 'ForumController@deleteComment', 'as' => 'forum-delete-comment'));

		Route::group(array('before' => 'csrf'), function()
		{
			Route::post('/group', array('uses' => 'ForumController@storeGroup', 'as' => 'forum-store-group'));
			Route::post('/category/{id}/new', array('uses' => 'ForumController@storeCategory', 'as' => 'forum-store-category'));

		});
	});

	Route::group(array('before' => 'auth'), function()
	{
		Route::get('/thread/{id}/new', array('uses' => 'ForumController@newThread', 'as' => 'forum-get-new-thread'));
		Route::group(array('before' => 'csrf'), function()
		{
			Route::post('/thread/{id}/new', array('uses' => 'ForumController@storeThread', 'as' => 'forum-store-thread'));
			Route::post('/comment/{id}/new', array('uses' => 'ForumController@storeComment', 'as' => 'forum-store-comment'));
		});
	});
});

Route::group(array('before' => 'guest'), function()
{
	Route::get('/user/create', array('uses' => 'UserController@getCreate', 'as'=>'getCreate'));
	Route::get('/user/login', array('uses' => 'UserController@getLogin', 'as'=>'getLogin'));
	Route::get('/members', array('uses' => 'UserController@getMember', 'as' => 'members'));
	Route::get('/user/about', array('uses' => 'UserController@getAbout', 'as' => 'about'));
	// in case someone gets bored and mess with the server. set it to csrf
	Route::group(array('before' =>'csrf'), function()
	{
		// handle database connection
		Route::post('/user/create', array('uses' => 'UserController@postCreate', 'as' => 'postCreate'));
		Route::post('/user/login', array('uses' => 'UserController@postLogin', 'as' => 'postLogin'));
	
		/*Route::post('/user/create', function()
		{
			$image = Input::file('image');
			var_dump($image->getRealPath());
			//var_dump($image->getClientOriginalName());
			$filename = $image->getClientOriginalName();

			if(Image::make($image->getRealPath())->resize('150', '150')->save('public/profile-image/'. $filename)){
				return 'image upload';
			}
		});*/
	});
});

Route::group(array('before' => 'auth'), function()
{
	Route::get('/user/logout', array('uses' => 'UserController@getLogout', 'as' => 'getLogout'));
	Route::get('/user/changePass', array('uses' => 'UserController@changePass', 'as' => 'changePass'));
	Route::get('/user/changeProfilePic', array('uses' => 'UserController@changeProfilePic', 'as' => 'changeProfilePic'));
	Route::post('/user/changePassword', array('uses' => 'UserController@changePassword', 'as' => 'changePassword'));
	Route::post('/user/changeProfilePicture', array('uses' => 'UserController@changeProfilePicture', 'as' => 'changeProfilePicture'));
	Route::get('/user/profile', array('uses' => 'UserController@getProfile', 'as' => 'profile'));
	Route::get('/user/member', array('uses' => 'UserController@getMember', 'as' => 'member'));
	Route::get('/member/{id}', array('uses' => 'UserController@getMemberDetail', 'as' => 'memberDetail'));
	Route::get('/user/about', array('uses' => 'UserController@getAbout', 'as' => 'about'));
});