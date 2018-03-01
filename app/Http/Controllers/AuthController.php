<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Socialite;
use Hash;

class AuthController extends Controller
{
    public function registerTeacherStore()
	{
	   $this->validate(request(),[
		'firstName' => 'required|string',
		'lastName' => 'required|string',
		'email' => 'required|email|unique:users,email',
		'password' => 'required|string',
	   ]);

	   User::create([
		'firstName' => request('firstName'),
		'lastName' => request('lastName'),
		'type' => 'Teacher',
		'email' => request('email'),
		'password' => bcrypt(request('password')),
		'provider' => 'Email'
	   ]);

	   session()->flash('message','Registration Complete !');

	   return redirect('users');
	}

	public function registerStudentStore()
	{
	   $this->validate(request(),[
		'firstName' => 'required|string',
		'lastName' => 'required|string',
		'email' => 'required|email|unique:users,email',
		'password' => 'required|string',
	   ]);

	   User::create([
		'firstName' => request('firstName'),
		'lastName' => request('lastName'),
		'type' => 'Student',
		'email' => request('email'),
		'password' => bcrypt(request('password')),
		'provider' => 'Email'
	   ]);

	   session()->flash('message','Registration Complete !');

	   return redirect('users');
	}

	public function changeCallbackUrl($type, $provider)
    {
		if($type == 'student')
		{
			switch ($provider) 
			{
				case 'google':
					$redirectUrl = env('GOOGLE_CALLBACK_STUDENT');
					break;
				
				case 'facebook':				
					$redirectUrl = env('FACEBOOK_CALLBACK_STUDENT');
					break;
			}
		}

		if($type == 'teacher')
		{
			switch ($provider) 
			{
				case 'google':
					$redirectUrl = env('GOOGLE_CALLBACK_TEACHER');
					break;
				
				case 'facebook':				
					$redirectUrl = env('FACEBOOK_CALLBACK_TEACHER');
					break;
			}
		}
		
		return $redirectUrl;
	}

	public function RedirectToProvider($type, $provider)
	{
		$redirectUrl = $this->changeCallbackUrl($type, $provider);

		return Socialite::with($provider)->redirectUrl($redirectUrl)->redirect();
	}
	
	public function ProviderCallback($type,$provider)
	{
		$redirectUrl = $this->changeCallbackUrl($type, $provider);

		config(["services.$provider.redirect" => $redirectUrl]);

		$allowedTypes = array('student','teacher');

		if(in_array($type, $allowedTypes))
		{
			try
			{
				$user = Socialite::driver($provider)->stateless()->user();
		
				$userDB = User::where('email', $user->email)->first();

				if(!$userDB) 
				{
					if($provider === 'google')
					{
						$lastName = $user->user['name']['familyName'];
						$firstName = $user->user['name']['givenName'];
					}
					if($provider === 'linkedin')
					{
						$lastName = $user->user['name']['lastName'];
						$firstName = $user->user['name']['firstName'];
					}

					User::create([
						'firstName' => $firstName,
						'lastName' => $lastName,
						'type' => $type,
						'email' => $user->email,
						'provider' => $provider,
						'provider_id' 	 => $user->id,
					]);

					session()->flash('message','Registration Complete !');
				}
				else
				{
					session()->flash('error','user already exists');
				}

				return redirect('users');
			
			} 
			catch (\Exception $e) 
			{
				return redirect('/');
			}
		}
		else
		{
			return redirect('/');
		}
	}

   public function usersDisplay()
   	{
	   $users = User::all();

	   return view('users',compact('users'));
   	}
}
