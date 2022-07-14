<?php 

namespace App\Classes;
use App\Classes\SSTClass;

class OpenGraphCheckerClass {

    public function get_data($link)
    {
        try {

            $sst = new SSTClass();

            $data = $sst->get_open_graph_tags($link, array (
                'og:url',
                'og:title',
                'og:type',
                'og:description',
                'og:site_name',
                'og:image',
                'fb:app_id',
                'og:type',
                'og:locale',
                'og:video',
                'og:video:url',
                'og:video:secure_url',
                'og:video:type',
                'og:video:width',
                'og:video:height',
                'og:image',
                'og:image:url',
                'og:image:secure_url',
                'og:image:type',
                'og:image:width',
                'og:image:height'
            ));

            return $data;
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

    }
    //

}