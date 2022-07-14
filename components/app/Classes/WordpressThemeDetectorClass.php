<?php 

namespace App\Classes;
use App\Classes\SSTClass;

class WordpressThemeDetectorClass {

	public function get_data($link)
	{
        try {

            $sst = new SSTClass();
            
            $get_source = $sst->wp_post_contents('https://whatwpthemeisthat.com/wpt.px', 'f1=' . urlencode($link));

            $get_source = str_replace(array('images/plain.jpg', 'images/wpplugins.jpg', 'img-responsive', 'badge-u','plugin-title'), array('assets/img/plugins.png', 'assets/img/plugins.png', 'img-fluid', 'bg-gradient-success text-white me-2','text-bold'), $get_source);

            preg_match('/<p class="alert alert-danger fade in">(.*?)<\/p>/', $get_source , $matchAlert);

            preg_match_all('/<h3 class="panel-title"><i class="fa fa-cog"><\/i>(.*?)<\/h3>/', $get_source , $matchTitle);

            preg_match_all('/<table class="table">([\s\S]*?)<\/table>/', $get_source , $matchTable);

            if ( !empty($matchTitle[1]) ) {

                $data['title'] = $matchTitle[1];

                $data['table'] = $matchTable[1];

            } elseif ( !empty($matchAlert[1]) ) {

                $data['text'] = $matchAlert[1];

            } else $data['text'] = __( 'Whoops, Something Went Wrong!');

            return $data;

            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}
    //

}