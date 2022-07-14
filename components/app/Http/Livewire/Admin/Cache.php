<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Artisan;

class Cache extends Component
{
    protected $listeners = ['onClearCache'];

    public function render()
    {
        return view('livewire.admin.cache');
    }

    public function onClearCache()
    {
        Artisan::call('config:cache');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('All caches have been cleared!') ]);
    }
}
