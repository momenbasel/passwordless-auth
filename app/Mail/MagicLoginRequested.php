<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
class MagicLoginRequested extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $users;
    public $options;
    public function __construct(User $user, array $options) 
    {
        $this->user = $user;
        $this->options = $options;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
    return $this->subject('your magic link is just here')->view('email.auth.magic.link')->with([
       'link' => $this->buildlink()
        ]);
    }
    public function buildlink() {
        return url('/login/magic/'. $this->user->token->token  . '?' . http_build_query($this->options));
    }
}
