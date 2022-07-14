<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use App\Models\Admin\Page;
use App\Models\Admin\Sidebar as SB;
use DateTime;

class Sidebar extends Component
{
    public $post_status;
    public $post_count;
    public $post_align;
    public $post_background;
    public $tool_status;
    public $tool_align;
    public $tool_background;
    public $pages = [];

    public function render()
    {
        return view('livewire.admin.settings.sidebar');
    }

    public function mount()
    {
        $this->pages           = Page::where('type', 'tool')->orderBy('id', 'DESC')->get()->toArray();

        $sidebar               = SB::findOrFail(1);
        $this->post_status     = $sidebar->post_status;
        $this->post_count      = $sidebar->post_count;
        $this->post_align      = $sidebar->post_align;
        $this->post_background = $sidebar->post_background;
        $this->tool_status     = $sidebar->tool_status;
        $this->tool_align      = $sidebar->tool_align;
        $this->tool_background = $sidebar->tool_background;

    }

    public function onUpdateSidebar()
    {
        try {

            $sidebar                  = SB::findOrFail(1);
            $sidebar->tool_status     = $this->tool_status;
            $sidebar->tool_align      = $this->tool_align;
            $sidebar->tool_background = $this->tool_background;
            $sidebar->post_status     = $this->post_status;
            $sidebar->post_count      = $this->post_count;
            $sidebar->post_align      = $this->post_align;
            $sidebar->post_background = $this->post_background;

            $sidebar->updated_at   = new DateTime();
            $sidebar->save();
            
            foreach ($this->pages as $key => $value) {
                $page             = Page::findOrFail($value['id']);
                $page->popular    = $value['popular'];
                $page->updated_at = new DateTime();
                $page->save();
            }

            $this->mount();
            $this->render();
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
