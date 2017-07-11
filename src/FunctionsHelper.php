<?php

namespace ivankff\yii2Helpers;

use yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use DateTime;

class FunctionsHelper {

    static function endOfWord($n, $e1 = "",$e2 = "",$e3 = ""){
        $n = (int)$n;
        switch (true){
            case ($n%10==1):
                $r = $e1;
                break;
            case ($n%10 >= 2 && $n%10 <= 4):
                $r = $e2;
                break;
            default:
                $r = $e3;
                break;
        }
        if ($n%100 >= 10 && $n%100 <= 20)
            $r = $e3;
        return $r;
    }

    static function strToUpper($text) {
        $th = array("а","б","в","г","д","е","ё","ж","з","и","й","к","л","м","н","о","п","р","с","т","у","ф","х","ц","ч","ш","щ","ъ","ы","ь","э","ю","я");
        $to = array("А","Б","В","Г","Д","Е","Ё","Ж","З","И","Й","К","Л","М","Н","О","П","Р","С","Т","У","Ф","Х","Ц","Ч","Ш","Щ","Ъ","Ы","Ь","Э","Ю","Я");
        return strtoupper(str_replace($th, $to, $text));
    }

    static function strToUpperFirst($text) {
        if (strlen($text) > 0){
            return self::strToUpper(mb_substr($text, 0, 1)).mb_substr($text, 1);
        }
        return $text;
    }

    static function strToLower($text) {
        $th = array("А","Б","В","Г","Д","Е","Ё","Ж","З","И","Й","К","Л","М","Н","О","П","Р","С","Т","У","Ф","Х","Ц","Ч","Ш","Щ","Ъ","Ы","Ь","Э","Ю","Я");
        $to = array("а","б","в","г","д","е","ё","ж","з","и","й","к","л","м","н","о","п","р","с","т","у","ф","х","ц","ч","ш","щ","ъ","ы","ь","э","ю","я");
        return strtolower(str_replace($th, $to, $text));

    }

}