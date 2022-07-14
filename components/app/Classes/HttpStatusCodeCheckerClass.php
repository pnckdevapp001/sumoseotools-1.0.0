<?php 

namespace App\Classes;
use App\Classes\SSTClass;

class HttpStatusCodeCheckerClass {

    public function get_data($link)
    {
        try {

            $sst = new SSTClass();
            
            $status = $sst->url_get_status($link);

            if ( !empty($status) ) {

                $data['status'] = $status;

                $data['link'] = $link;

                return $data;
                
            } else{
                session()->flash('status', 'error');
                session()->flash('message', __( 'Whoops! Something went wrong.'));
                return;
            }
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

    }


    //

}