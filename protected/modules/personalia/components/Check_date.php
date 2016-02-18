<?php

class Check_date extends CApplicationComponent{
	function isWeekend($date) {
        return (date('N', strtotime($date)) >= 6);
    }
}