<?php 

namespace App\Classes;
use App\Classes\SSTClass;

class GoogleIndexCheckerClass {

	public function get_data($link)
	{
        try {

            $sst = new SSTClass();

            $data['status'] = $sst->get_index_status($link);

            $data['link'] = $link;

            return $data;
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}
    //

}