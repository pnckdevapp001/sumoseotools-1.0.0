<?php

namespace App\Http\Livewire\Admin\Pages\Categories;

use Livewire\Component;
use Auth;
use DateTime;
use App\Models\Admin\PageCategory;
use App\Models\Admin\Page;
use GrahamCampbell\Security\Facades\Security;

class Showlist extends Component
{

    public $title;
    public $description;
    public $align = 'start';
    public $background;
    public $categories = [];
    public $cateID;

    protected $listeners = ['onUpdateCategory'];

    public function mount()
    {
        $this->categories = PageCategory::orderBy('sort','ASC')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.admin.pages.categories.showlist');
    }

    private function resetInputFields()
    {
        $this->reset(['title', 'description', 'align', 'background', 'cateID']);
    }

    public function addNewCategory()
    {
        try {

            if ( $this->cateID != null ) {

                $cate              = PageCategory::findOrFail($this->cateID);
                $cate->title       = Security::clean( strip_tags($this->title) );
                $cate->description = Security::clean( strip_tags($this->description) );
                $cate->align       = Security::clean( strip_tags($this->align) );
                $cate->background  = Security::clean( strip_tags($this->background) );
                $cate->updated_at  = new DateTime();
                $cate->save();

                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);

            } else{

                $cate              = new PageCategory;
                $cate->title       = Security::clean( strip_tags($this->title) );
                $cate->description = Security::clean( strip_tags($this->description) );
                $cate->align       = Security::clean( strip_tags($this->align) );
                $cate->background  = Security::clean( strip_tags($this->background) );
                $cate->created_at  = new DateTime();
                $cate->save();
                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data created successfully!')]);
            }

            $this->mount();
            $this->render();
            $this->resetInputFields();
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }
    }

    public function editCategory($id)
    {
        try {

            $this->cateID      = $id;
            $cate              = PageCategory::findOrFail($id);
            $this->title       = Security::clean( strip_tags($cate->title) );
            $this->description = Security::clean( strip_tags($cate->description) );
            $this->align       = Security::clean( strip_tags($cate->align) );
            $this->background  = Security::clean( strip_tags($cate->background) );

        } catch (\Exception $e) {
           $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    public function removeCategory($id)
    {

        try {
            $cate = PageCategory::findOrFail($id);

            $cate->delete($id);
            return redirect()->route('categories');

        } catch (\Exception $e) {
           $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    public function parseJsonArray($jsonArray, $parentID = 0) {

      $return = array();

      foreach ($jsonArray as $subArray) {

        $returnSubSubArray = array();

        $return[] = array('id' => $subArray['id']);

        $return = array_merge($return, $returnSubSubArray);
      }
      return $return;
    }

    public function onUpdateCategory($data)
    {

        try {

            $data = $this->parseJsonArray($data);

            $i = 0;

            foreach ($data as $row) {

                $i++;
                $cate             = PageCategory::findOrFail($row['id']);
                $cate->sort       = $i;
                $cate->updated_at = new DateTime();
                $cate->save();
            }
            
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);
            $this->mount();

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }
        
    }

}
