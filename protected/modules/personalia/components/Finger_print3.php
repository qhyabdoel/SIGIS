<?php

$con = mysql_connect('db.ppsdm.com', 'ppsdm', 'ppsdM2014') or die("Unable to connect to MySQL");
	
mysql_select_db('sigis', $con);
	if (mysql_error()) {
	exit('Connection to <b>' . self::MYSQL_NAME . '</b> failed.');
}

$raw_absens = mysql_query('select * from raw_absen');

while($row = mysql_fetch_array($raw_absens, MYSQL_ASSOC))
{
    $PIN 		= $row['pin'];
    $Verified 	= $row['verified'];
    $Tanggal 	= $row['date'];
    $Waktu 		= $row['time'];
    $Status 	= $row['status_absen'];

    $result 		= mysql_query('select count(*) as jumlah from tb_absensi where Tanggal = '.$Tanggal.' and NIK = '.$PIN);
	$data 			= mysql_fetch_assoc($result);
	$count_check 	= $data['jumlah'];

	if($Status==0 and $PIN!=0 and $count_check==0){
		$insert = mysql_query('insert into tb_absensi(NIK,Jam_Masuk,Tanggal) values("'.$PIN.'","'.$Waktu.'","'.$Tanggal.'")');
	}
	elseif($Status==1 and $PIN!=0 and $count_check!=0){
		$result 			= mysql_query('select * from tb_absensi where Tanggal = '.$Tanggal.' and NIK = '.$PIN);
		$data 				= mysql_fetch_assoc($result);
		$Jam_Masuk 			= $data['Jam_Masuk'];
		$seconds 			= strtotime($Waktu)-strtotime($Jam_Masuk);
		$hours 				= floor($seconds/3600);
		$minutes 			= floor(($seconds-($hours*3600))/60);
		$seconds 			= $seconds-(($minutes*60)+($hours*3600));
		$Total_Jam_Kerja	= $hours.':'.$minutes.':'.$seconds;		
		
		$update 			= mysql_query('update tb_absensi set Jam_Keluar = '.$Waktu.', Total_Jam_Kerja = '.$Total_Jam_Kerja.' where Tanggal = '.$Tanggal.' and NIK = '.$PIN);
	}					
}

mysql_close($con);