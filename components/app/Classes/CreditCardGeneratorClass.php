<?php 

namespace App\Classes;
use App\Classes\SSTClass;

class CreditCardGeneratorClass{
    
    protected static $visaPrefixList       = array("4539","4556","4916","4532","4929","40240071","4485","4716","4");
    protected static $mastercardPrefixList = array("51","52","53","54", "55");
    protected static $amexPrefixList       = array("34", "37");
    protected static $discoverPrefixList   = array("6011");
    protected static $dinersPrefixList     = array("300","301","302","303","36","38");
    protected static $enRoutePrefixList    = array("2014","2149");
    protected static $jcbPrefixList        = array("35");
    protected static $voyagerPrefixList    = array("8699");
    
    /*
    'prefix' is the start of the CC number as a string, any number of digits.
    'length' is the length of the CC number to generate. Typically 13 or 16
    */
    private static function completed_number($prefix, $length) {

        $ccnumber = $prefix;

        # generate digits

        while ( strlen($ccnumber) < ($length - 1) ) {
            $ccnumber .= rand(0,9);
        }

        # Calculate sum

        $sum = 0;
        $pos = 0;

        $reversedCCnumber = strrev( $ccnumber );

        while ( $pos < $length - 1 ) {

            $odd = $reversedCCnumber[ $pos ] * 2;
            if ( $odd > 9 ) {
                $odd -= 9;
            }

            $sum += $odd;

            if ( $pos != ($length - 2) ) {

                $sum += $reversedCCnumber[ $pos +1 ];
            }
            $pos += 2;
        }

        # Calculate check digit

        $checkdigit = (( floor($sum/10) + 1) * 10 - $sum) % 10;
        $ccnumber .= $checkdigit;

        return $ccnumber;
    }

    public static function credit_card_number($prefixList, $length, $howMany) {

        for ($i = 0; $i < $howMany; $i++) {
            $ccnumber = $prefixList[ array_rand($prefixList) ];
            $result[] = self::completed_number($ccnumber, $length);
        }
        if($howMany == 1){
            return array_pop($result);
        }else{
            return $result;
        }

    }

    public static function get_mastercard($count = 1){
        return self::credit_card_number(self::$mastercardPrefixList, 16, $count);
    }

    public static function get_visa($count = 1){
        return self::credit_card_number(self::$visaPrefixList, 16, $count);
    }

    public static function get_amex($count = 1){
        return self::credit_card_number(self::$amexPrefixList, 15, $count);
    }

    public static function get_diners($count = 1){
        return self::credit_card_number(self::$dinersPrefixList, 14, $count);
    }

    public static function get_discover($count = 1){
        return self::credit_card_number(self::$discoverPrefixList, 16, $count);
    }

    public static function get_jcb($count = 1){
        return self::credit_card_number(self::$jcbPrefixList, 16, $count);
    }
}