<?php 

namespace App\Classes;
use App\Classes\SSTClass;
use Jenssegers\Agent\Agent;

class WhatIsMyUserAgentClass {

	public function get_data()
	{
        try {
                
                $agent                   = new Agent();
                $browser                 = $browser = $agent->browser();
                $browser_version         = $agent->version($browser);
                $user_agent              = $_SERVER['HTTP_USER_AGENT'];
                $os                      = $agent->platform();
                $os_version              = $agent->version($os);
                $languages               = $agent->languages()[0];
                
                $data['browser']         = ( $browser ) ? $browser : 'None';
                $data['browser_version'] = ( $browser_version ) ? $browser_version : 'None';
                $data['user_agent']      = ( $user_agent ) ? $user_agent : 'None';
                $data['os']              = ( $os ) ? $os : 'None';
                $data['os_version']      = ( $os_version ) ? $os_version : 'None';
                $data['languages']       = ( $languages ) ? $languages : 'None';

                return $data;
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}
    //

}