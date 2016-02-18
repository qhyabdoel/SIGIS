<?php
/* @var $this SiteController */

$this->breadcrumbs=array(
	'Personalia',
);

$this->pageTitle 	= Yii::app()->name;
$url				= Yii::app()->createUrl('site/karyawan');
$url2				= Yii::app()->createUrl('site/ketentuan');
$url3 				= Yii::app()->createUrl('site/gaji');
$url4 				= Yii::app()->createUrl('site/user');
$class 				= 'link-button';

if(Yii::app()->user->roles!='superadmin') $class = 'link-button disable';
?>

<br><br>

<a href="<?php echo $url4; ?>" class="<?php echo $class; ?>">Manage User</a><br><br>
<a href="<?php echo $url; ?>" class="link-button">Data Karyawan</a><br><br>
<a href="<?php echo $url2; ?>" class="link-button">Ketentuan Personalia</a><br><br>
<a href="<?php echo $url3; ?>" class="link-button">Gaji dan Upah</a><br><br>
