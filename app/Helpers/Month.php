<?php

namespace App\Helpers;

class Month
{
    /**
     * @param $lang
     * @param $month
     * @return string
     */
    public static function LayoutMonth($lang, $month)
    {
        switch ($lang) {
            case 'ru':
                return self::monthRu($month);
                break;
            case 'uz':
                return self::monthUz($month);
                break;
        }
    }

    /**
     * @param $lang
     * @param $month
     * @return string
     */
    public static function getMonth($lang, $month)
    {
        switch ($lang) {
            case 'ru':
                return self::monthRu($month);
                break;
            case 'uz':
                return self::monthUz($month);
                break;
        }
    }

    /**
     * @param $month
     * @return string
     */
    protected static function monthRu($month)
    {
        switch ($month) {
            case '01':
                return 'января';
                break;
            case '02':
                return 'февраля';
                break;
            case '03':
                return 'март';
                break;
            case '04':
                return 'апреля';
                break;
            case '05':
                return 'май';
                break;
            case '06':
                return 'июня';
                break;
            case '07':
                return 'июля';
                break;
            case '08':
                return 'августа';
                break;
            case '09':
                return 'сентября';
                break;
            case '10':
                return 'октября';
                break;
            case '11':
                return 'ноября';
                break;
            case '12':
                return 'декабря';
                break;
        }
    }

    /**
     * @param $month
     * @return string
     */
    protected static function monthUz($month)
    {
        switch ($month) {
            case '01':
                return 'yanvar';
                break;
            case '02':
                return 'fevral';
                break;
            case '03':
                return 'mart';
                break;
            case '04':
                return 'april';
                break;
            case '05':
                return 'may';
                break;
            case '06':
                return 'iyun';
                break;
            case '07':
                return 'iyul';
                break;
            case '08':
                return 'avgust';
                break;
            case '09':
                return 'sentabr';
                break;
            case '10':
                return 'oktabr';
                break;
            case '11':
                return 'noyabr';
                break;
            case '12':
                return 'dekabr';
                break;
        }
    }
}
