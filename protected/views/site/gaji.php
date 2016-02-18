<?php
/* @var $this SiteController */

$this->breadcrumbs=array(
	'Personalia'=>array('personalia'),
	'Gaji dan Upah'
);

$this->pageTitle 	= Yii::app()->name;
$url 				= Yii::app()->createUrl('site/bulanan');
?>

<br><br>

<a href="<?php echo $url; ?>" class="link-button">Bulanan</a><br><br>
<a href="#" class="link-button">Harian</a><br><br>
