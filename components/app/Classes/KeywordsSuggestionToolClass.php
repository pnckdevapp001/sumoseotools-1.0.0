<?php 

namespace App\Classes;
use App\Classes\SSTClass;

class KeywordsSuggestionToolClass {

	public function get_data($query)
	{
        try {

            $sst = new SSTClass();
            
            $get_source = $sst->url_get_contents('https://suggestqueries.google.com/complete/search?output=toolbar&q=' . urlencode($query));
            
            $xmlObject  = simplexml_load_string($get_source);

            $json       = json_encode($xmlObject);

            $deJson     = json_decode($json, true);

            $data = array();

            if ( $deJson['CompleteSuggestion'] ) {

                foreach ($deJson['CompleteSuggestion'] as $value) {

                    array_push($data, array(
                        "keyword"      => $value['suggestion']['@attributes']['data']
                    ));

                }
            }
            
            return $data;
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}
    //

}