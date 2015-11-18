<?php

class UserController extends BaseController
{

	

	// get the view for the register page
	public function getCreate()
	{
		//return "register page";
		return View::make('user.register');
	}

	// get the view for the login page
	public function getLogin()
	{
		//return "login page";
		return View::make('user.login');
	}
	
	public function changePass()
	{
		//return "change Password page";
		
		return View::make('user.changePass');
	}
	
	public function getProfile()
	{
		//return "profile page";
		return View::make('user.profile')->with('user', Auth::user());
	}

	public function changeProfilePic()
	{
	//return "change Password page";

	return View::make('user.changeProfilePic');
	}
	
	public function getMember()
	{
		//return "profile page";
		return View::make('user.members')->with('users', User::all());
	}
	
	public function getAbout()
	{
		//return "profile page";
		return View::make('user.about');
	}
	

	public function postCreate()
	{
		$validate = Validator::make(Input::all(), array(
			'username' => 'required|unique:users|min:4',
			'password' => 'required|min:6',
			'repass' => 'required|same:password',
		));

		if($validate->fails())
		{
			return Redirect::route('getCreate')->withErrors($validate)->withInput();
		}
		else
		{
			$user = new User();
			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('password'));

			if($user->save())
			{
				Mail::queue('user.welcome', array('username'=>Input::get('username')), function($message){
        			$message->to(Input::get('email'), Input::get('username'))->subject('Welcome to the U-Life Forum!');
    			});
				return Redirect::route('home')->with('success', 'You registered successfully. You may log in now');
			}
			else
			{
				return Redirect::route('home')->with('fail', 'An error occured while creating account');
			}
		}
	}

	public function postLogin()
	{
		$validator = Validator::make(Input::all(), array(
			'username' => 'required',
			'password' => 'required'
		));

		if($validator->fails())
		{
			return Redirect::route('getLogin')->withErrors($validator)->withInput();
		}
		else
		{
			// if theres a variable named remember then its true
			// from checkbox
			$remember = (Input::has('remember')) ? true : false;

			$auth = Auth::attempt(array(
				'username' => Input::get('username'),
				'password' => Input::get('password')
			), $remember);

			if($auth)
			{
				
				return Redirect::intended('/');
			}
			else
			{
				return Redirect::route('getLogin')->with('fail', 'You entered wrong info');
			}
		}
	}
	
	public function changePassword(){
		$validate = Validator::make(Input::all(), array(
			'oldPassword' => 'required',
			'password' => 'required|min:6',
			'repass' => 'required|same:password',
		));

		if($validate->fails())
		{
			return Redirect::route('changePass')->withErrors($validate)->withInput();
		}
		else
		{
			$oldPassword = Input::get('oldPassword');
			
			
			if(Hash::check($oldPassword, Auth::user()->password))
			{
				$user = Auth::user();

				$user->password = Hash::make(Input::get('password'));
				
				if($user->save()){
					return Redirect::route('profile')->with('success', 'success in changing password');
				}else{
					return Redirect::route('changePass')->with('fail', 'new password not in database');
				}
			}
			else
			{
				return Redirect::route('changePass')->with('fail', 'You entered wrong old Password');
			}
			
		}
	}

	public function changeProfilePicture()
	{		
			$image = Input::file('image');
			////$image_path = $image->getRealPath();
			
			//$image_data= file_get_contents($image_path);
			//$type = pathinfo($image_path, PATHINFO_EXTENSION);
			
			$filename = $image->getClientOriginalName();
			$path = public_path('../public/profile-image/'.$filename);
			Image::make($image->getRealPath())->resize(150,150)->save($path);
			//$image->move(public_path().'/profile-image/');
			////Image::make($image->getRealPath())->save('../profile-image/',$filename);
			
			/* $user = Auth::user();
			
			$user->type = $type;
			$user->image = $image_data;
			if($user->save()){
					return Redirect::route('profile')->with('success', 'success in changing profile picture');
				}else{
					return Redirect::route('changeProfilePicture')->with('fail', 'image was not upload to database');
				} */
			$user = Auth::user();
			$user->profile_img = '../public/profile-image/'.$filename;

			if($user->save()){
				return Redirect::route('profile')->with('success', 'success in changing profile picture');
			}else{
				return Redirect::route('changeProfilePicture')->with('fail', 'image was not upload to database');
			}
	}

	public function getMemberDetail($id)
	{	
		return View::make('user.memberDetail')->with('detail', User::find($id));
	}
	
	public function getLogout()
	{
		Auth::logout();
		return Redirect::route('home');
	}


}