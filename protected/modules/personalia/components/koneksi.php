<?php
ini_set('display_errors',FALSE);
$my['host']	= "localhost";
$my['user']	= "root";
$my['pass']	= "";
$my['dbs']	= "absensi";
$entries=3;
//$tanggal=date("d-m-Y H:i:s");

$koneksi	= mysql_connect($my['host'], 
							$my['user'], 
							$my['pass']);
if (!$koneksi) {
  echo "Koneksi gagal";
  mysql_error();
}
mysql_select_db($my['dbs'])
	 or die ("Database tidak ada".mysql_error());

?>
