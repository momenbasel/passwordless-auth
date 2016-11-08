<?php

namespace App\Http\Controllers\Auth;

use App\UserLoginToken;

use App\Http\Controllers\Auth\MagicAuthentication;

use App\Http\Controllers\Controller;

use App\Http\Requests;

use Illuminate\Http\Request;

use Auth;
class MagicLoginController extends Controller
{

	public function show() {
		return view('auth.magic.login');
	}

	public function sendToken(Request $request, MagicAuthentication $auth) {
		$this->validate($request, [

			'email' => 'required|email|max:255|exists:users,email'

		]);
		$auth->requestlink();

		return redirect()->to('/login/magic')->with('success' , 'we\'ve sent you a magic link!');
	}
		public function ValidateToken(Request $request , UserLoginToken $token) {
			$token->delete();
			if($token->isexpired()) {
				return redirect()->to('/login/magic')->with('error', 'that magic link has been expired');
			}
			if(!$token->belongsToEmail($request->email)) {
				return redirect()->to('/login/magic')->with('error', 'the link seems to be invalid.');
			}
			Auth::login($token->user, $request->remember);

			return redirect()->intended();
		}
}
