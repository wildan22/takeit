<?php
class myHelpers {
    public static function randStr($length){
        $pool = 'abcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle(str_repeat($pool, 5)) , 0, $length);
    }

    public static function cleanspecialchar($string){
        //$string = str_replace(' ', ' ', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^a-zA-Z ]/', '', $string); // Removes special chars.

        return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
    }

    public static function dateConvert($date){
        $yrdata= strtotime($date);
        return date('F Y', $yrdata);
    }

    public static function cleanNumber($string){
        $res = preg_replace('/\d+/u', '', $string);
        return $res;
    }
}
?>