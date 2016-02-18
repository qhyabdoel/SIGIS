<?php
/* @var $this SiteController */

$this->breadcrumbs = array(

	'Personalia' 	=> array('personalia'),
	'Gaji dan Upah'	=> array('gaji'),
	'Gaji Bulanan' 	=> array('bulanan'),
	
	'Gaji Bulanan',
);

$this->pageTitle = Yii::app()->name;
$url 			 = Yii::app()->createUrl('site/absensi');
$url2 			 = Yii::app()->createUrl('site/pendapatan');
$url3 			 = Yii::app()->createUrl('site/potongan');
$url4 			 = Yii::app()->createUrl('site/pendapatan?manual=');

?>

<br><br>

<a href="<?php echo $url; ?>" class="link-button">Absensi</a>
&nbsp;
<a href="<?php echo $url3; ?>" class="link-button">Potongan</a>
<br><br>

<a href="<?php echo $url2; ?>" class="link-button">Pendapatan</a>
&nbsp;
<a href="<?php echo $url4; ?>" class="link-button">Pendapatan Manual</a>