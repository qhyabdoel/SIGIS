<?php
/* @var $this ClusterController */
/* @var $model Cluster */

$this->breadcrumbs=array(
	'Clusters'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Cluster', 'url'=>array('index')),
	array('label'=>'Create Cluster', 'url'=>array('create')),
	array('label'=>'Update Cluster', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Cluster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Cluster', 'url'=>array('admin')),
);
?>

<h1>View Cluster #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'project_id',
		'cluster_name',
		'cluster_area',
		'cluster_image',
	),
)); ?>
