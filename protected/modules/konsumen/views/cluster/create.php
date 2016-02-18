<?php
/* @var $this ClusterController */
/* @var $model Cluster */

$this->breadcrumbs=array(
	'Clusters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Cluster', 'url'=>array('index')),
	array('label'=>'Manage Cluster', 'url'=>array('admin')),
);
?>

<h1>Create Cluster</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>