<?php

namespace App\Http\Livewire\Admin\Pages;

use Livewire\Component;
use App\Models\Admin\AuthPages as AuthenticationPages;
use Livewire\WithPagination;
use DateTime;

class AuthPages extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.admin.pages.auth-pages', [
            'auth_pages'                => AuthenticationPages::orderBy('id', 'DESC')->paginate(15),
        ]);
    }

    //Enable
    public function onEnablePage($id)
    {
        try {

            $page             = AuthenticationPages::findOrFail($id);
            $page->status     = true;
            $page->updated_at = new DateTime();
            $page->save();

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data enabled successfully!') ]);
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    //Disable
    public function onDisablePage($id)
    {
        try {

            $page             = AuthenticationPages::findOrFail($id);
            $page->status     = false;
            $page->updated_at = new DateTime();
            $page->save();

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data disabled successfully!') ]);
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }
}
