<?php 

namespace App\Classes;
use App\Classes\SSTClass;

class AlexaRankCheckerClass {

	public function get_data($link)
	{
        try {

            $sst = new SSTClass();
            
            $get_source = $sst->url_get_contents('https://xml.alexa.com/data?cli=10&dat=nsa&ver=quirk-searchstatus&url=' . urlencode($link));
            
            $xmlObject  = simplexml_load_string($get_source);

            $json       = json_encode($xmlObject);

            $deJson     = json_decode($json, true); 

            $data['global']  = ( $deJson['SD'][1]['POPULARITY'] ) ? $deJson['SD'][1]['POPULARITY']['@attributes']['TEXT'] : 'None';
            $data['reach']   = ( $deJson['SD'][1]['REACH'] ) ? $deJson['SD'][1]['REACH']['@attributes']['RANK'] : 'None';
            $data['country'] = ( $deJson['SD'][1]['COUNTRY'] ) ? $deJson['SD'][1]['COUNTRY']['@attributes']['NAME'] : 'None';
            $data['rank']    = ( $deJson['SD'][1]['COUNTRY'] ) ? $deJson['SD'][1]['COUNTRY']['@attributes']['RANK'] : 'None';
            $data['change']  = ( $deJson['SD'][1]['RANK'] ) ? $deJson['SD'][1]['RANK']['@attributes']['DELTA'] : 'None';

            return $data;
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}
    //

}