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

$this->renderPartial($form, array(
	'id' 				=> $nik,
	'model' 			=> $model,
	'from' 				=> $from,
	'disable'			=> 'false',	
	'confirm'			=> $confirm,
	'jabatans'			=> $jabatans,
	'golongans'			=> $golongans,
	'departmens' 		=> $departmens,
	'masa_kerjas'		=> $masa_kerja,	
)); 

?>