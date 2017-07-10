<?php

namespace ivankff\yii2-helpers;

use yii;
use yii\helpers\ArrayHelper;
use DateTime;

class DateTimeHelper {

    const MYSQL_DATETIME = 'Y-m-d H:i:s';
    const MYSQL_DATETIME_ICU = 'yyyy-MM-dd HH:mm:ss';
    const MYSQL_DATE = 'Y-m-d';
    const MYSQL_DATE_ICU = 'yyyy-MM-dd';

    const ICU_DNYA_MESYACA_GODA = 'd MMMM yyyy';
    const ICU_DNYA_MESYACA = 'd MMMM';
    const ICU_D_M_Y = 'dd.MM.yyyy';
    const ICU_D_M_Y_H_I_S = 'dd.MM.yyyy - HH:mm:ss';
    const ICU_D_M_Y_H_I = 'dd.MM.yyyy - HH:mm';
    const ICU_H_I = 'HH:mm';
    const ICU_H_I_S = 'HH:mm:ss';

    /**
     * @param string|integer|DateTime $date
     * unix_timestamp, DateTime, дата и время из mysql, строка с датой
     * @link http://php.net/manual/ru/datetime.formats.date.php
     *
     * @param string $toFormat
     * @link http://userguide.icu-project.org/formatparse/datetime
     *
     * @param null|string $fromFormat
     * @link http://php.net/manual/ru/function.date.php
     *
     * @return string
     */
    public static function formatIcu($date, $toFormat, $fromFormat = null)
    {
        if ($date instanceof DateTime){
            $d = $date;
        } else {
            if ($fromFormat) $d = DateTime::createFromFormat($fromFormat, $date);
            else {
                if (is_numeric($date)) $d = DateTime::createFromFormat('U', $date);
                else $d = new DateTime($date);
            }
        }
        if ($d){
            if ($d->format('d') == 2) $toFormat = str_replace(['с d'], ['со d'], $toFormat);
            return Yii::$app->formatter->asDate($d, $toFormat);
        }
        return $date;
    }


    /**
     * @param string $format
     * @param string $date
     * @return DateTime|null
     */
    public static function stringToDateTime($format, $date)
    {
        try {
            $date = \DateTime::createFromFormat($format, $date);
        } catch (\Exception $e) {
            $date = null;
        }
        return $date;
    }


    /**
     * @param string $format
     * @return array
     */
    public static function getMonthsList($format = 'MMMM')
    {
        $items = [];
        for ($i=1; $i<=12; $i++){
            $items[$i] = Yii::$app->formatter->asDate("2000-{$i}-01", $format);
        }
        return $items;
    }

}