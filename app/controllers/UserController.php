<?php

class UserController extends BaseController{
	

	public static function login(){
		View::make('user/login.html');
	}

	public static function register(){
		View::make('user/register.html');
	}


	public static function handle_login(){
		$params = $_POST;


		$user = User::authenticate($params['username'], $params['password']);

		if(!$user){
			View::make('user/login.html', array('error' => 'Invalid username or password', 'username' => $params['username']));
		} else {
			$_SESSION['user'] = $user->id;

			Redirect::to('/');
		}

	}

	public static function logout(){
		$_SESSION['user'] = null;
		Redirect::to('/login', array('message' => 'You have been logged out!'));

	}


	public static function store(){
		$params = $_POST;

		if($params['password'] != $params['password2']){
			Redirect::to('/register' , array('message' => 'Passwords do not match!'));
		}


		$user = new User(array(
			'name' => $params['name'],
			'password' => $params['password']
			));


		$errors = $user->errors();

		if(count($errors)  > 0){
			View::make('/user/register.html', array('errors' => $errors));
		} else {
			$user->save();
			Redirect::to('/login', array('message' => 'Registration complete!'));
		}
	}




}