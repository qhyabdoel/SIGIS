<?php

$this->breadcrumbs=array(
	'Personalia'=>array('personalia'),
	'User',
);

$this->pageTitle 	= Yii::app()->name;
$url_input			= Yii::app()->createUrl('personalia/User/create');
$url_report 		= Yii::app()->createUrl('personalia/User/index');

?>

<br><br>

<a href="<?php echo $url_input; ?>" class="link-button">Input Data User</a><br><br>
<a href="<?php echo $url_report; ?>" class="link-button">Report</a><br><br>
