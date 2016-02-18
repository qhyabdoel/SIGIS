<?php
/* @var $this SiteController */

$this->breadcrumbs=array(
	'Personalia'=>array('personalia'),
	'Ketentuan',
);

$this->pageTitle 	= Yii::app()->name;
$url				= Yii::app()->createUrl('personalia/TbKetentuan/create');
$url2				= Yii::app()->createUrl('personalia/TbKetentuan/index');
?>

<br><br>

<a href="<?php echo $url; ?>" class="link-button">Input Data</a><br><br>
<a href="<?php echo $url2; ?>" class="link-button">Report</a><br><br>