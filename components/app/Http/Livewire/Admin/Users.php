<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Admin\User;
use Livewire\WithPagination;
use Auth;

class Users extends Component
{

    use WithPagination;

    public $searchQuery        = '';
    protected $paginationTheme = 'bootstrap';
    protected $listeners       = ['onDeleteUser', 'sendUpdateUserStatus' => 'onUpdateUserStatus'];

    public function render()
    {
        return view('livewire.admin.users', [
            'users' => User::where('email', 'like', '%'.$this->searchQuery.'%')->orWhere('fullname', 'like', '%'.$this->searchQuery.'%')->orderBy('id', 'DESC')->paginate(15)
        ]);
    }

    public function onUpdateUserStatus(){
        $this->render();
    }

    /**
     * -------------------------------------------------------------------------------
     *  Show Modal Edit
     * -------------------------------------------------------------------------------
    **/

    public function onShowEditUserModal($id)
    {
        $user        = User::findOrFail($id);
        $this->emit('sendDataEditUser', ['id' => $user->id]);
        $this->dispatchBrowserEvent('showModal', ['id' => 'editUser']);
    }

    /**
     * -------------------------------------------------------------------------------
     *  Delete User
     * -------------------------------------------------------------------------------
    **/

    public function onDeleteConfirmUser($id)
    {

        $this->dispatchBrowserEvent('swal:modal', ['id' => $id, 'type' => 'warning', 'title' => __('Are you sure?'), 'text' => __('You won\'t be able to revert this!') ]);
    }

    public function onDeleteUser($id)
    {
        try {

            if ( Auth::user()->is_admin == 1 ) {

                $user = User::findOrFail($id);
                $user->delete($id);

                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!') ]);
            }
            else $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('Access denied!')]);
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
