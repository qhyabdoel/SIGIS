<?php

class CountDay extends CApplicationComponent{	
	public function getNo_weekend($tglawal,$tglakhir,$delimiter,$weekend){		
		    $tgl_awal = $tgl_akhir = $minggu = $sabtu = $koreksi = $libur = 0;
		    		    
		    
		//    memecah tanggal untuk mendapatkan hari, bulan dan tahun
		    $pecah_tglawal = explode($delimiter, $tglawal);
		    $pecah_tglakhir = explode($delimiter, $tglakhir);
		    
		//    mengubah Gregorian date menjadi Julian Day Count
		    $tgl_awal = gregoriantojd($pecah_tglawal[1], $pecah_tglawal[0], $pecah_tglawal[2]);
		    $tgl_akhir = gregoriantojd($pecah_tglakhir[1], $pecah_tglakhir[0], $pecah_tglakhir[2]);		    

		//    mengubah ke unix timestamp
		    $jmldetik = 24*3600;
		    $a = strtotime($tglawal);
		    $b = strtotime($tglakhir);

		    $liburnasional = Kalender::model()->findAll(array(
		    	'condition' => 'tanggal between :awal and :akhir',
		    	'params' 	=> array(':awal'=>date('Y-m-d',$a),':akhir'=>date('Y-m-d',$b)),
		    ));
		    
		//    menghitung jumlah libur nasional 
		    for($i=$a; $i<$b; $i+=$jmldetik){
		        foreach ($liburnasional as $key => $tgllibur) {
		            if($tgllibur==date("d-m-Y",$i)){
		                $libur++;
		            }
		        }
		    }
		    
		//    menghitung jumlah hari minggu
		    for($i=$a; $i<$b; $i+=$jmldetik){
		        if(date("w",$i)=="0"){
		            $minggu++;
		        }
		    }
		    
		//    menghitung jumlah hari sabtu
		    for($i=$a; $i<$b; $i+=$jmldetik){
		        if(date("w",$i)=="6"){
		            $sabtu++;
		        }
		    }

		//    dijalankan jika $tglakhir adalah hari sabtu atau minggu
		    if(date("w",$b)=="0" || date("w",$b)=="6"){
		        $koreksi = 1;
		    }
		    
		//    mengitung selisih dengan pengurangan kemudian ditambahkan 1 agar tanggal awal cuti juga dihitung
		    $jumlahcuti =  $tgl_akhir - $tgl_awal - count($liburnasional) - $minggu - $sabtu - $koreksi + 1;

		    if($weekend==1) $jumlahcuti =  $tgl_akhir - $tgl_awal - count($liburnasional) - $minggu - $koreksi + 1;

		    return $jumlahcuti;
	}
}