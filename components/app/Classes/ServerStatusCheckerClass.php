<?php 

namespace App\Classes;
use App\Classes\SSTClass;

class ServerStatusCheckerClass {

	public function get_data($link)
	{
        try {

            $sst = new SSTClass();

            $http_code = $sst->url_get_status($link);

            $data['link']      = $link;

            $data['http_code'] = (is_numeric($http_code)) ? $http_code : 'None';

            $data['status'] = (is_numeric($http_code)) ? $sst->STATUS_CODES[$http_code] : 'None';

            return $data;
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}
    //
}