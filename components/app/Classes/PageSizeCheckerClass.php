<?php 

namespace App\Classes;
use App\Classes\SSTClass;

class PageSizeCheckerClass {

	public function get_data($link)
	{
        try {

            $sst           = new SSTClass();
            
            $get_source    = $sst->url_get_contents($link);
            
            $data['link'] = $link;

            $data['bytes'] = strlen($get_source);

            $data['kb']    = $sst->format_size(strlen($get_source), 'kB');

            return $data;
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}
    //

}