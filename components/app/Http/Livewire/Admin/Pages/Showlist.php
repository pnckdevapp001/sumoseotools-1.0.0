<?php

namespace App\Http\Livewire\Admin\Pages;

use Livewire\Component;
use App\Models\Admin\Page;
use App\Models\Admin\PageTranslation;
use App\Models\Admin\Languages;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use DateTime;

class Showlist extends Component
{

    use WithPagination;

    public $searchQuery = '';
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['onDeletePage', 'sendUpdatePageStatus' => 'onUpdatePageStatus'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.pages.showlist', [
            'default_lang'         => Languages::where('default', true)->first()->code,
            'pages'                => Page::where('slug', 'like', '%'.$this->searchQuery.'%')->whereIn('type', ['page', 'home', 'contact', 'report'])->orderBy('id', 'DESC')->paginate(15),
            'total_lang'           => DB::table('languages')->count(),
            'translation_progress' => PageTranslation::select( 'page_id', DB::raw('count(*) as progress') )->groupBy('page_id')->get()->toArray()
        ]);
    }

    public function onUpdatePageStatus(){
        $this->render();
    }

    /**
     * -------------------------------------------------------------------------------
     *  Show Modal Edit
     * -------------------------------------------------------------------------------
    **/

    public function onShowEditPageModal($id)
    {
        $page        = Page::findOrFail($id);
        $this->emit('sendDataEditPage', ['id' => $page->id]);
        $this->dispatchBrowserEvent('showModal', ['id' => 'editPage']);
    }

    /**
     * -------------------------------------------------------------------------------
     *  onEnablePage
     * -------------------------------------------------------------------------------
    **/
    public function onEnablePage($id)
    {
        try {

            $post              = Page::findOrFail($id);
            $post->post_status = true;
            $post->updated_at  = new DateTime();
            $post->save();

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data enabled successfully!') ]);
            $this->mount();
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    /**
     * -------------------------------------------------------------------------------
     *  onDisablePage
     * -------------------------------------------------------------------------------
    **/
    public function onDisablePage($id)
    {
        try {

            $post              = Page::findOrFail($id);
            $post->post_status = false;
            $post->updated_at  = new DateTime();
            $post->save();

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data disabled successfully!') ]);
            $this->mount();
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    /**
     * -------------------------------------------------------------------------------
     *  Delete Page
     * -------------------------------------------------------------------------------
    **/

    public function onDeleteConfirmPage($id)
    {

        $this->dispatchBrowserEvent('swal:modal', ['id' => $id, 'type' => 'warning', 'title' => __('Are you sure?'), 'text' => __('You won\'t be able to revert this!') ]);
    }

    public function onDeletePage($id)
    {
        try {
            $page = Page::findOrFail($id);

            $page->delete($id);

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!') ]);
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
