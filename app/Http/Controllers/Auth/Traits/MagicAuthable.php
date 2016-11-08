<?php 
namespace App\Http\Controllers\Auth\Traits;
use App\UserLoginToken;
use Mail;
use App\Mail\MagicLoginRequested;
trait MagicAuthable 
{
	public function storeToken() {
		$this->token()->delete();
		$this->token()->create([
			'token' => str_random(255)
		 	]);
		 return $this;
	}
	public function sendMagicLink(array $options) {
		Mail::to($this)->send(new MagicLoginRequested($this,$options));
	}
	public function token() {
		return $this->hasOne(UserLoginToken::class);
	}

}