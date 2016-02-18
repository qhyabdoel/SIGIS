<?php

$this->breadcrumbs=array(
	'Personalia'=>array('personalia'),
	'Karyawan',
);

$this->pageTitle 	= Yii::app()->name;
$url_input			= Yii::app()->createUrl('personalia/TbKaryawan/create');
$url_report 		= Yii::app()->createUrl('personalia/TbKaryawan/index');
$url_administrasi 	= Yii::app()->createUrl('personalia/TbKaryawan/administrasi');

?>

<br><br>

<a href="<?php echo $url_input; ?>" class="link-button">Input Data Karyawan</a><br><br>
<a href="<?php echo $url_report; ?>" class="link-button">Report</a><br><br>
<a href="<?php echo $url_administrasi; ?>" class="link-button">Administrasi Karyawan</a><br><br
