<?php
/* @var $this ClusterController */
/* @var $model Cluster */

$this->breadcrumbs=array(
	'Clusters'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Cluster', 'url'=>array('index')),
	array('label'=>'Create Cluster', 'url'=>array('create')),
	array('label'=>'View Cluster', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Cluster', 'url'=>array('admin')),
);
?>

<h1>Update Cluster <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'projects'=>$projects)); ?>