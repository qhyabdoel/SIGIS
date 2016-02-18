<?php
/* @var $this SiteController */

$this->breadcrumbs=array(
	'Personalia' 	=> array('personalia'),
	'Gaji dan Upah'	=> array('gaji'),
	'Gaji Bulanan' 	=> array('bulanan'),
	'Gaji Bulanan' 	=> array('perhitungan'),
	'Absensi' 		=> array('absensi'),
	'Report Absensi'
);

$this->pageTitle 	= Yii::app()->name;
$url 				= Yii::app()->createUrl('/personalia/tbAbsensi');
$url2				= Yii::app()->createUrl('/personalia/tbAbsensi/per_karyawan');
?>

<br><br>

<a href="<?php echo $url2; ?>" class="link-button">Absensi per Karyawan</a>
<br><br>
<a href="<?php echo $url; ?>" class="link-button">Rekapitulasi</a>