<?php
/* @var $this SiteController */

$this->breadcrumbs = array(

	'Personalia' 	=> array('personalia'),
	'Gaji dan Upah'	=> array('gaji'),
	'Gaji Bulanan' 	=> array('bulanan'),
	
	'Gaji Bulanan',
);

$this->pageTitle 	= Yii::app()->name;
$url 			 	= Yii::app()->createUrl('site/absensi');
$url2 			 	= Yii::app()->createUrl('site/pendapatan');
$url3 			 	= Yii::app()->createUrl('site/potongan');
$url4 			 	= Yii::app()->createUrl('site/pendapatan?manual=');
$class 				= 'link-button';

if(Yii::app()->user->roles=='admin') $class = 'link-button disable';

?>

<br><br>

<a href="<?php echo $url; ?>" class="link-button">Absensi</a>
&nbsp;
<a href="<?php echo $url3; ?>" class="<?php echo $class; ?>">Potongan</a>
<br><br>

<a href="<?php echo $url2; ?>" class="<?php echo $class; ?>">Pendapatan</a>
&nbsp;
<a href="<?php echo $url4; ?>" class="<?php echo $class; ?>">Pendapatan Manual</a>