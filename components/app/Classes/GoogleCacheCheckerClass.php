<?php 

namespace App\Classes;
use App\Classes\SSTClass;

class GoogleCacheCheckerClass {

    public function get_data($link)
    {
        try {

            $sst = new SSTClass();
            
            $get_source = $sst->url_get_contents('https://webcache.googleusercontent.com/search?hl=en&gl=en&ie=UTF-8&oe=UTF-8&q=cache:' . urlencode($link));

            preg_match('/([0-9]{1,2} [A-Za-z]{3} [0-9]{4}) [0-9]{2}:[0-9]{2}:[0-9]{2}/', $get_source, $match);

            if ( isset($match[0]) ) {

                $data['date'] = $match[0] . ' GMT';

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