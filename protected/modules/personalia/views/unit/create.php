<?php
/* @var $this UnitController */
/* @var $model Unit */

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(
	'Units'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Unit', 'url'=>array('index')),
	array('label'=>'Manage Unit', 'url'=>array('admin')),
);
?>

<h1>Create Unit</h1>

<?php $this->renderPartial('_form', array(
	'model' => $model,
	'data' 	=> $data,
	'role'  => $role,
)); ?>