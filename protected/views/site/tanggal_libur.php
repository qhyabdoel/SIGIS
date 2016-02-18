<?php
/* @var $this SiteController */

$this->breadcrumbs=array(
	'Personalia' 	=> array('personalia'),
	'Gaji dan Upah'	=> array('gaji'),
	'Gaji Bulanan' 	=> array('bulanan'),
	'Gaji Bulanan' 	=> array('perhitungan'),
	'Absensi' 		=> array('absensi'),
	'Tanggal Libur'
);

$this->pageTitle 	= Yii::app()->name;
$url 				= Yii::app()->createUrl('/personalia/kalender/create');
$url2				= Yii::app()->createUrl('/personalia/kalender/index');
?>

<br><br>

<a href="<?php echo $url; ?>" class="link-button">Input Tanggal Libur</a>
<br><br>
<a href="<?php echo $url2; ?>" class="link-button">Report</a>