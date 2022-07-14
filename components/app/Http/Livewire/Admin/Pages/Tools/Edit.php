<?php

namespace App\Http\Livewire\Admin\Pages\Tools;

use Livewire\Component;
use DateTime;
use App\Models\Admin\Page;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\PageCategory;

class Edit extends Component
{
    public $page_id;
    public $tool_name;
    public $category_id;
    public $custom_tool_link;
    public $position;
    public $slug;
    public $icon_image;
    public $featured_image;
    public $type;
    public $tools = [];
    public $categories = [];
    
    protected $listeners = ['onSetFeaturedImage', 'onSetIconImage', 'sendDataEditPage' => 'onDataEditPage'];

    public function mount()
    {
        $this->tools = Storage::disk('local')->get('tools.json');
        $this->categories = PageCategory::orderBy('sort','ASC')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.admin.pages.tools.edit');
    }

    public function onDataEditPage(Page $page)
    {
        $this->page_id          = $page->id;
        $this->tool_name        = $page->tool_name;
        $this->category_id      = $page->category_id;
        $this->slug             = $page->slug;
        $this->type             = $page->type;
        $this->icon_image       = $page->icon_image;
        $this->featured_image   = $page->featured_image;
        $this->custom_tool_link = $page->custom_tool_link;
        $this->position         = $page->position;
    }

    public function createSlug()
    {
        $this->slug = SlugService::createSlug(Page::class, 'slug', $this->slug);
    }
    
    private function resetInputFields()
    {
        $this->reset(['page_id', 'tool_name', 'slug', 'type', 'icon_image', 'custom_tool_link', 'featured_image']);
    }

    public function onSetFeaturedImage($value)
    {
        $this->featured_image = $value;
    }

    public function onSetIconImage($value)
    {
        $this->icon_image = $value;
    }

    public function onEditPage($id)
    {
        if ( $this->tool_name !== 'custom_tool_link') {

            $this->validate([
                'slug'      => 'required',
                'tool_name' => 'required',
            ]);

        }

        try {

            $page                   = Page::findOrFail($id);
            $page->slug             = strip_tags($this->slug);
            $page->type             = 'tool';
            $page->icon_image       = strip_tags($this->icon_image);
            $page->featured_image   = strip_tags($this->featured_image);
            $page->tool_name        = $this->tool_name;
            $page->category_id      = $this->category_id;
            $page->custom_tool_link = $this->custom_tool_link;
            $page->position         = $this->position;
            $page->updated_at       = new DateTime();
            $page->save();
                   
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!') ]);
            $this->dispatchBrowserEvent('closeModal', ['id' => 'editPage']);
            $this->resetInputFields();
            $this->emit('sendUpdatePageStatus');
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }
    }

}
