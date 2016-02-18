<?php
/* @var $this TbKetentuanController */
/* @var $model TbKetentuan */

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(
	'Personalia'=>array('/site/personalia'),
	'Ketentuan'=>array('/site/ketentuan'),
	'Input Data'=>array('create'),
);

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}
?>

<?php 
$this->renderPartial($form, array(
	'departmens' 	=> $departmens,
	'golongans'		=> $golongans,
	'jabatans'		=> $jabatans,
	'confirm'		=> $confirm,
	'disable'		=> $disable,	
	'update'		=> 1,
	'model' 		=> $model,
	'nik' 			=> $nik,
	));
?>