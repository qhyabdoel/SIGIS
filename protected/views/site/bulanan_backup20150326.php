<?php
/* @var $this SiteController */

$this->breadcrumbs=array(
	'Personalia' 	=> array('personalia'),
	'Gaji dan Upah'	=> array('gaji'),
	'Gaji Bulanan'
);

$this->pageTitle = Yii::app()->name;
$url 			 = Yii::app()->createUrl('site/perhitungan');
$url2 			 = Yii::app()->createUrl('personalia/TbPenggajian/input');
$url3			 = Yii::app()->createUrl('site/payroll');
$url4 			 = Yii::app()->createUrl('site/rekapitulasi');
$url5 			 = Yii::app()->createUrl('personalia/TbPenggajian/slip');
$url6 			 = Yii::app()->createUrl('personalia/TbPenggajian/slip?manual=');


?>

<br><br>

<a href="<?php echo $url2; ?>" class="link-button">Input Gaji</a>
&nbsp;
<a href="<?php echo $url; ?>" class="link-button">Perhitungan</a>
<br><br>
<a href="<?php echo $url4; ?>" class="link-button">Rekapitulasi</a>
&nbsp;
<a href="<?php echo $url5; ?>" class="link-button">Slip Gaji</a>
<br><br>
<a href="<?php echo $url3; ?>" class="link-button">Payroll</a>
&nbsp;
<a href="<?php echo $url6; ?>" class="link-button">Slip Gaji Manual</a>
<br><br>