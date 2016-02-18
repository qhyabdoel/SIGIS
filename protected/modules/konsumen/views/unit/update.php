<?php
/* @var $this UnitController */
/* @var $model Unit */

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(
	'Units'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Unit', 'url'=>array('index')),
	array('label'=>'Create Unit', 'url'=>array('create')),
	array('label'=>'View Unit', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Unit', 'url'=>array('admin')),
);
?>

<h1>Update Unit <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'data'=>$data,'role'=>$role)); ?>