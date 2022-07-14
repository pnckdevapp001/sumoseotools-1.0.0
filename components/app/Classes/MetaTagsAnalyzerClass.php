<?php 

namespace App\Classes;
use App\Classes\SSTClass;

class MetaTagsAnalyzerClass {

	public function get_data($link)
	{
        try {

            $sst = new SSTClass();
            
            $data = $sst->get_meta_tags($link, array ('title','description' ,'keywords', 'viewport', 'robots', 'author'));

            return $data;
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}
    //

}