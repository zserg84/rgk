<?php

namespace app\components;

class Helper
{

    public static function getRusMonth($month){
        if($month > 12 || $month < 1)
            return false;
        $aMonth = [
            'января',
            'февраля',
            'марта',
            'апреля',
            'мая',
            'июня',
            'июля',
            'августа',
            'сентября',
            'октября',
            'ноября',
            'декабря'
        ];
        return $aMonth[$month - 1];
    }

    public static function getDateFromTime($time){
        $curTime = time();
        $yesterday = date('d.m.Y', strtotime('yesterday'));
        $today = date('d.m.Y', strtotime('today'));
        $tomorrow = date('d.m.Y', strtotime('tomorrow'));

        $date = date('d.m.Y', $time);
        switch($date){
            case $yesterday:
                $return = 'Вчера';
                break;
            case $today:
                $return = 'Сегодня';
                break;
            case $tomorrow:
                $return = 'Завтра';
                break;
            default:
                $return = date("d ".Helper::getRusMonth(date('m', $time))." Y", $time);
        }
        return $return;
    }
}