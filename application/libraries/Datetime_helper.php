<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**********************************************************************************
	- File Info -
		File name		: Datetime_helper.php
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 28th Sep 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/

class Datetime_helper
{
    public function now($format_str='r')
    {
        $now = new DateTime('now', new DateTimeZone(DATE_TIME_ZONE));
        return $now->format($format_str);
    }

    public function today($format_str='r')
    {
        $today = new DateTime('today', new DateTimeZone(DATE_TIME_ZONE));
        return $today->format($format_str);
    }

	public function format_dd_mm_yyyy_dash($date_str)
    {
        $datetime = new DateTime($date_str, new DateTimeZone(DATE_TIME_ZONE));
        return $datetime->format('d-m-Y');
    }

    public function format_dd_mm_yyyy_slash($date_str)
    {
        $datetime = new DateTime($date_str, new DateTimeZone(DATE_TIME_ZONE));
        return $datetime->format('d/m/Y');
    }

    public function format_mm_dd_yyyy_dash($date_str)
    {
        $datetime = new DateTime($date_str, new DateTimeZone(DATE_TIME_ZONE));
        return $datetime->format('m-d-Y');
    }

    public function format_yyyy_mm_dd_dash($date_str)
    {
        $datetime = new DateTime($date_str, new DateTimeZone(DATE_TIME_ZONE));
        return $datetime->format('Y-m-d');
    }

    public function format_yyyy_mm_dd_slash($date_str)
    {
        $datetime = new DateTime($date_str, new DateTimeZone(DATE_TIME_ZONE));
        return $datetime->format('Y/m/d');
    }

    public function format_dd_mmm_yyyy_space($date_str)
    {
        $datetime = new DateTime($date_str, new DateTimeZone(DATE_TIME_ZONE));
        return $datetime->format('d M Y');
    }

    public function format_dd_mm_yyyy_hh_ii_ss($date_str)
    {
        $datetime = new DateTime($date_str, new DateTimeZone(DATE_TIME_ZONE));
        return $datetime->format('d-m-Y, H:i:s');
    }

    public function format_dd_mmm_yyyy_hh_ii_ss($date_str)
    {
        $datetime = new DateTime($date_str, new DateTimeZone(DATE_TIME_ZONE));
        return $datetime->format('d M Y, H:i:s');
    }

    public function format_for_db($date_str)
    {
        $datetime = new DateTime($date_str, new DateTimeZone(DATE_TIME_ZONE));
        return $datetime->format('c');
    }

    public function format_internet_standard($date_str)
    {
        $datetime = new DateTime($date_str, new DateTimeZone(DATE_TIME_ZONE));
        return $datetime->format('r');
    }
	
} // end Datetime_helper controller class