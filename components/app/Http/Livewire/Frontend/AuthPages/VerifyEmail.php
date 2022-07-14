<?php

namespace App\Http\Livewire\Frontend\AuthPages;

use Livewire\Component;

class VerifyEmail extends Component
{
    public function render()
    {
        return view('livewire.frontend.auth-pages.verify-email');
    }

    public function onResendEmail()
    {
        try {

            auth()->user()->sendEmailVerificationNotification(); 

            session()->flash('status', 'success');
            session()->flash('message', __('A new verification link has been sent to the email address you provided during registration.'));

        } catch (\Exception $e) {
            session()->flash('status', 'error');
            session()->flash('message', __('Could not send verification link.'));
        }
        
    }

}
