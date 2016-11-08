<?php

namespace App;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;


class UserLoginToken extends Model
{
	const TOKEN_EXPIREY = 120;

	protected $table = 'users_login_tokens';

	protected $fillable = ['token'];


	public function user() {

		return $this->belongsTo(User::class);

	}
	public function getRouteKeyName() {

		return 'token';

	}
	public function isexpired() {
		$this->created_at->diffinSeconds(Carbon::now()) > self::TOKEN_EXPIREY;
	}

	public function belongstoEmail($email) {
		return( $this->user->where('email' , $email)->count() === 1);
	}
	public function scopeExpired($query)
	 {
		return $query->where('created_at' ,'<' , Carbon::now()->subSeconds(self::TOKEN_EXPIREY));
	}
}
