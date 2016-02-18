<?php
/* @var $this ClusterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Clusters',
);

$this->menu=array(
	array('label'=>'Create Cluster', 'url'=>array('create')),
	array('label'=>'Manage Cluster', 'url'=>array('admin')),
);
?>

<h1>Clusters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
