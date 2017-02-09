<?php
require_once 'Database.php';

/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 11/26/16
 * Time: 1:29 PM
 */
class Calandar
{

    var $calandarDays = array();
    var $Reserves = array();
    var $month;
    function Calandar($time)
    {

        $firstDay = strtotime('first day of this month', $time);
        $lastDay = strtotime('last day of this month', $time);
        $daysMonth = getdate($lastDay)['mday'];
        $firstDN = getdate($firstDay)['wday'];
        $this->month = getdate($time)['mon'];
        for ($curDayW = 0; $curDayW < $firstDN; $curDayW++) {
            array_push($this->calandarDays, array("day" => 0, "blank" => true, "DayW" => $curDayW, "Reserved" => false, "Reservation" => null));
        }
        for ($day = 1; $day <= $daysMonth; $day++) {
            if ($curDayW == 7) {
                $curDayW = 0;
            }
            $date = new DateTime();
            $date->setTimestamp($firstDay);
            $date->add(new DateInterval('P' . ($day - 1) . 'D'));
            array_push($this->calandarDays, array("day" => $day, "date" => $date->format("Y-m-d"), "blank" => false, "DayW" => $curDayW, "Reserved" => false, "Reservation" => null));
            $curDayW++;

        }
    }

    function addReservation($resText, $ResStart, $ResEnd, $ResClass)
    {
        array_push($this->Reserves, array("Text" => $resText, "Start" => $ResStart, "End" => $ResEnd, "Class" => $ResClass));
        $start = new DateTime();
        $start->setTimestamp($ResStart);

        if ($start->format('m') == $this->month) {

        $end = new DateTime();
        $end->setTimestamp($ResEnd);
        $daterange = new DatePeriod($start, new DateInterval('P1D'), $end);
        foreach ($daterange as $date) {
            $index = array_search($date->format("d"), array_column($this->calandarDays, 'day'));
            $this->calandarDays[$index]['Reserved'] = true;
            $this->calandarDays[$index]['Reservation'] = array("Text" => $resText, "Start" => $start->format("m/d/y g:i A"), "End" => $end->format("m/d/y g:i A"), "Class" => $ResClass);

        }
    }

    }

    function draw()
    {

        $curDayW = 0;
        $CalHtml = "<div class='week'>";

        foreach ($this->calandarDays as $day) {
            if ($day['blank'] == true) {
                $CalHtml .= "<div class='day blank'></div>";

            } else {
                if ($curDayW == 7) {
                    $curDayW = 0;
                    $CalHtml .= "</div><div class='week'>";
                }
                if ($day['Reserved'] == true) {

                    $CalHtml .= "<div id='" . $day['day'] . "' class='day'><div class='DayHead'><div class='DayNum'>" . $day['day'] . "</div><div class='add' onclick=\"addReservation('" . $day['date'] . "')\" >+</div></div><div class='Reservation " . $day['Reservation']['Class'] . "' onclick=\"expand('" . $day['Reservation']['Text'] . "','" . $day['Reservation']['Start'] . "','" . $day['Reservation']['End'] . "')\">" . $day['Reservation']['Text'] . "</div></div>";

                } else {
                    $CalHtml .= "<div id='" . $day['day'] . "' class='day'><div class='DayHead'><div class='DayNum'>" . $day['day'] . "</div><div class='add' onclick=\"addReservation('" . $day['date'] . "')\" >+</div></div></div>";

                }

            }
            $curDayW++;

        }

        return $CalHtml;
    }
}