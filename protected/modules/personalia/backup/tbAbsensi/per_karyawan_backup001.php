<?php

/* @var $this TbAbsensiController */
/* @var $dataProvider CActiveDataProvider */

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(

	'Personalia' 		  => array('/site/personalia'),
	'Gaji dan Upah'		=> array('/site/gaji'),
	'Gaji Bulanan' 		=> array('/site/bulanan'),
	'Gaji Bulanan' 		=> array('/site/perhitungan'),
	'Absensi' 			  => array('/site/absensi'),
	'Report Absensi' 	=> array('/site/report_absensi'),

	'Absensi per Karyawan'
);

function TanggalIndo($date)
{
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

$action = Yii::app()->createUrl('personalia/TbAbsensi/per_karyawan');
$url    = Yii::app()->createUrl('site/report_absensi');
$url2   = Yii::app()->createUrl('/personalia/TbAbsensi/eksport_per_karyawan?nik='.$nik.'&awal='.$awal.'&akhir='.$akhir);

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}

$actionField = 'search';
?>

<form action="<?php echo $action; ?>" method="post">

<label><b>Periode</b></label> &nbsp;
<?php if($awal!=''){
  echo CHtml::dateField('awal',$awal);
}else{
  echo CHtml::dateField('awal'); 
} ?>
-
<?php if($akhir!=''){
  echo CHtml::dateField('akhir',$akhir);
}else{
  echo CHtml::dateField('akhir'); 
} ?>

<br><br>

<label>NIK</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="nik" value="<?php echo $nik; ?>">

<br>

<label>Nama</label>
&nbsp;&nbsp;&nbsp;&nbsp;
<input name="nama" disabled="true" value="<?php echo $nama; ?>">
&nbsp;&nbsp;&nbsp;&nbsp;
<input name="action" hidden="true" value="<?php echo $actionField; ?>">

<button id="buttonSearch" hidden="true"></button>

<a class="small-button" id="linkButtonSearch">Search</a>

</form>

<br><br>

<table class="tg">
  <tr>
    <th class="tg-bsv2" rowspan="2">Tanggal</th>        
    <th class="tg-bsv2" colspan="4">Kehadiran</th>
    <th class="tg-bsv2" colspan="4">Ketidakhadiran</th>
    <th class="tg-bsv2" rowspan="2">Keterangan</th>
  </tr>
  <tr>
    <td class="tg-bsv2">Jam Datang</td>
    <td class="tg-bsv2">Terlambat</td>
    <td class="tg-bsv2">Jam Pulang</td>    
    <td class="tg-bsv2">Jam Kerja</td>    
    <td class="tg-bsv2">Cuti</td>
    <td class="tg-bsv2">Ijin</td>
    <td class="tg-bsv2">Sakit</td>
    <td class="tg-bsv2">Alpa</td>
  </tr>
  <?php 
  
	$count = 0;

  	if(count($absensis)==0){
	?>
	<tr>
		<td class="tg-031e">-</td>
		<td class="tg-031e">-</td>
		<td class="tg-031e">-</td>
		<td class="tg-031e">-</td> 
		<td class="tg-031e">-</td>
		<td class="tg-031e">-</td>
		<td class="tg-031e">-</td>
		<td class="tg-031e">-</td>
		<td class="tg-031e">-</td> 
		<td class="tg-031e">-</td> 
	</tr> 	
	<?php
	}
	
	$total_cuti 	= 0;
	$total_ijin 	= 0;
	$total_sakit 	= 0;

	foreach ($absensis as $absen){  		

	$cuti 			= '';
	$ijin 			= '';
	$sakit 			= '';

	if($absen->Ketidakhadiran=='cuti'){
		$cuti = 1;
		$total_cuti++;
	}	
	elseif($absen->Ketidakhadiran=='ijin'){
		$ijin = 1;
		$total_ijin++;	
	} 	
	elseif($absen->Ketidakhadiran=='sakit'){
		$sakit = 1;
		$total_sakit++;	
	}
	elseif($absen->Ketidakhadiran==''){
		$count++; 	
	} 

	?>

	<tr>
		<td class="tg-031e"><?php echo TanggalIndo($absen->Tanggal); ?></td>
		<td class="tg-031e"><?php echo $absen->Jam_Masuk; ?></td>
		<td class="tg-031e"></td>
		<td class="tg-031e"><?php echo $absen->Jam_Keluar; ?></td> 
		<td class="tg-031e"><?php echo $absen->Total_Jam_Kerja; ?></td>
		<td class="tg-031e"><?php echo $cuti; ?></td>
		<td class="tg-031e"><?php echo $ijin; ?></td>
		<td class="tg-031e"><?php echo $sakit; ?></td>
		<td class="tg-031e"></td> 
		<td class="tg-031e"></td> 
	</tr> 
  
	<?php 

	} 

	?>
  
  <tr>    
    <td class="tg-bsv2">Total</td>    
    <td class="tg-bsv2"></td>
    <td class="tg-bsv2"></td>
    <td class="tg-bsv2"></td>    
    <td class="tg-bsv2"></td>
    <td class="tg-bsv2"><?php echo $total_cuti; ?></td>
    <td class="tg-bsv2"><?php echo $total_ijin; ?></td>
    <td class="tg-bsv2"><?php echo $total_sakit; ?></td>
    <td class="tg-bsv2"></td> 
    <td class="tg-bsv2"></td> 
  </tr>
  <tr>
    <td class="tg-bsv2" colspan="3">Total Kehadiran (hari)</td>
    <td class="tg-bsv2" colspan="2"><?php echo $count; ?></td>
  </tr>
</table>

<a class="small-button" href="<?php echo $url; ?>">Close</a>
<a class="small-button" href="<?php echo $url2; ?>">Export to Excel</a>

<script>

$('#linkButtonSearch').click(function(){
	$('#buttonSearch').click();
});

</script>