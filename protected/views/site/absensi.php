
<?php
/* @var $this SiteController */

$this->breadcrumbs=array(
	'Personalia' 	=> array('personalia'),
	'Gaji dan Upah'	=> array('gaji'),
	'Gaji Bulanan' 	=> array('bulanan'),
	'Gaji Bulanan' 	=> array('perhitungan'),
	'Absensi'
);

$this->pageTitle 	= Yii::app()->name;
$url 				= Yii::app()->createUrl('site/report_absensi');
$url2 				= Yii::app()->createUrl('/personalia/tbAbsensi/verifikasi');
$url3 				= Yii::app()->createUrl('site/tanggal_libur');
?>

<br><br>

<a href="<?php echo $url2; ?>" class="link-button">Verifikasi Absen</a>
<br><br>
<a href="<?php echo $url; ?>" class="link-button">Report</a>
<br><br>
<a href="<?php echo $url3; ?>" class="link-button">Tanggal Libur</a>