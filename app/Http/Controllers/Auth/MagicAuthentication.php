<?php
namespace App\Http\Controllers\Auth;
use App\User;
use Illuminate\Http\Request;

class MagicAuthentication
{
	protected $request;
	protected $identifier = 'email';

	public function __construct(Request $request) {
		$this->request = $request;
	}

	public function requestlink() {
		$user = $this->GetUserByIdentifier($this->request->get($this->identifier));
		$user->storeToken()->sendMagicLink([
			'remember' => $this->request->has('remember'),
			'email' => $user->email,
			]);
	}

	public function GetUserByIdentifier($value) {
		return User::where($this->identifier , $value)->firstORFail();
	}

}