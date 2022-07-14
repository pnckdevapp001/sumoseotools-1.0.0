<?php

namespace App\Http\Livewire\Frontend\AuthPages;

use Livewire\Component;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends Component
{
    public $email;

    public function render()
    {
        return view('livewire.frontend.auth-pages.forgot-password');
    }

    public function onForgotPassword()
    {
        $this->validate([
            'email'    => 'required|email'
        ]);

        try {

            $status = Password::sendResetLink(['email' => $this->email]);

            if ( $status === Password::RESET_LINK_SENT ) {

                session()->flash('status', 'success');
                session()->flash('message', __($status));

            } else $this->addError('401', __( $status ));

        } catch (\Exception $e) {
            session()->flash('status', 'error');
            session()->flash('message', __('Could not send reset link.'));
        }
    }

}
