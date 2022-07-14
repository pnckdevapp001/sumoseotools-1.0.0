<?php

namespace App\Http\Livewire\Frontend\AuthPages;

use Livewire\Component;
use DateTime, Auth;
use Illuminate\Support\Facades\Hash;

class Profile extends Component
{

    public $password;
    public $fullname;

    public function mount()
    {
        $this->fullname  = Auth::user()->fullname ?? null;
    }

    public function render()
    {
        return view('livewire.frontend.auth-pages.profile');
    }

    public function onUpdateProfile()
    {
        $this->validate([
            'password' => 'required_with:password_confirmation|same:password_confirmation',
        ]);

        try {

            if ( Auth::user() && Auth::user()->email_verified_at != null ) {

                $profile             = Auth::user();
                $profile->fullname   = strip_tags($this->fullname);

                if ( $this->password != null ) {
                    $profile->password   = Hash::make($this->password);
                }
                
                $profile->updated_at = new DateTime();
                $profile->save();
                session()->flash('status', 'success');
                session()->flash('message', __( 'Data Updated Successfully!' ));

            } else {
                session()->flash('status', 'error');
                session()->flash('message', __( 'You must verify your account before using this feature!' ));
            }


        } catch (\Exception $e) {
            session()->flash('status', 'error');
            session()->flash('message', __('Unable to update profile.'));
        }
    }

}
