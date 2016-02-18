<?php

class Date_ina extends CApplicationComponent{
	public function getNow(){
        $months = array('januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember');
        return date('d').' '.$months[date('m')-1].' '.date('Y');
    }

    public function getdate($date){
    	$months = array('januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember');
        return date('d',$date).' '.$months[date('m',$date)-1].' '.date('Y',$date);	
    }

    public function getDate2($date){
        $BulanIndo = array(
        "Januari", "Februari", "Maret", "April", "Mei", "Juni", 
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        );

        $tahun  = substr($date, 0, 4);
        $bulan  = substr($date, 5, 2);
        $tgl    = substr($date, 8, 2);
        $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;   

        return($result);
    }
}