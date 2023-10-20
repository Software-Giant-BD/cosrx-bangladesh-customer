<?php

namespace App\Services;

class DateTimeService
{
    public function calculateDifferenceBetweenTwoDate($date1, $date2)
    {
        $date1 = new \DateTime($date1);
        $date2 = new \DateTime($date2);
        $interval = $date1->diff($date2);

        return 'difference '.$interval->y.' years, '.$interval->m.' months, '.$interval->d.' days ';
    }

    public function addDayToDate($numberDay, $oldMonth)
    {
        $numberDay = '+'.$numberDay.' days';
        $newMonth = date('Y-m-d', strtotime($numberDay, strtotime($oldMonth)));

        return $newMonth;
    }

    public function addMonthToDate($numberMonth, $oldMonth)
    {
        $numberMonth = '+'.$numberMonth.' months';
        $newMonth = date('Y-m-d', strtotime($numberMonth, strtotime($oldMonth)));

        return $newMonth;
    }

    public static function staticAddMonthToDate($numberMonth, $oldMonth)
    {
        $numberMonth = '+'.$numberMonth.' months';
        $newMonth = date('Y-m-d', strtotime($numberMonth, strtotime($oldMonth)));

        return $newMonth;
    }

    //get minute differnce
    public function calculateMinDifference($future, $past)
    {
        $future = strtotime($future); //Future date.
        $past = strtotime($past);
        $timeleft = $future - $past;
        $min = round(($timeleft) / 60);

        return $min;
    }

    //get monthly differnce
    public function calculateMonthDifference($future, $past)
    {
        $ts1 = strtotime($past);
        $ts2 = strtotime($future);

        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);

        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);

        $diff = (($year2 - $year1) * 12) + ($month2 - $month1);

        return $diff;
    }

    public function remainingDayBetweenTwoDate($future, $timefromdb)
    {
        $future = strtotime($future); //Future date.
        $timefromdb = strtotime($timefromdb);
        $timeleft = $future - $timefromdb;
        $daysleft = round((($timeleft / 24) / 60) / 60);

        return $daysleft;
    }

    //for warenty due day
    public static function getDueDay($month, $purchase)
    {
        $warrenty = (new self)->addMonthToDate($month, $purchase);
        $due = (new self)->remainingDayBetweenTwoDate($warrenty, date('Y-m-d'));

        return $due;
    }
}
