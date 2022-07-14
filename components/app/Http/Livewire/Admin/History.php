<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Admin\History as HT;

class History extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.admin.history', [
            'histories' => HT::orderBy('id', 'DESC')->paginate(15)
        ]);
    }
}
