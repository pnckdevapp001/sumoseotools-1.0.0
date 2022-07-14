<?php 

namespace App\Classes;
use App\Classes\SSTClass;

class GetHttpHeadersClass {

	public function get_data($link)
	{
        try {

            $sst = new SSTClass();
            
            $data['info'] = $sst->url_get_headers($link);

            return $data;
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}
    //

}