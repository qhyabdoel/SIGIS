<?php
/* @var $this SiteController */

$this->breadcrumbs=array(
	'Personalia' 	=> array('personalia'),
	'Gaji dan Upah'	=> array('gaji'),
	'Gaji Bulanan'
);

$this->pageTitle 	= Yii::app()->name;
$url 			 	= Yii::app()->createUrl('site/perhitungan');
$url2 			 	= Yii::app()->createUrl('personalia/TbPenggajian/input');
$url3			 	= Yii::app()->createUrl('site/payroll');
$url4 			 	= Yii::app()->createUrl('site/rekapitulasi');
$url5 			 	= Yii::app()->createUrl('personalia/TbPenggajian/slip');
$url6 			 	= Yii::app()->createUrl('personalia/TbPenggajian/slip?manual=');
$class 				= 'link-button';

if(Yii::app()->user->roles=='admin') $class = 'link-button disable';

?>

<br><br>

<a href="<?php echo $url2; ?>" class="<?php echo $class; ?>">Input Gaji</a>
&nbsp;
<a href="<?php echo $url; ?>" class="link-button">Perhitungan</a>
<br><br>
<a href="<?php echo $url4; ?>" class="<?php echo $class; ?>">Rekapitulasi</a>
&nbsp;
<a href="<?php echo $url5; ?>" class="<?php echo $class; ?>">Slip Gaji</a>
<br><br>
<a href="<?php echo $url3; ?>" class="<?php echo $class; ?>">Payroll</a>
&nbsp;
<!-- <a href="<?php echo $url6; ?>" class="link-button">Slip Gaji Manual</a> -->
<br><br>