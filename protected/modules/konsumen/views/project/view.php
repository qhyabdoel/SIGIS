<?php
/* @var $this ProjectController */
/* @var $model Project */

$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Project', 'url'=>array('index')),
	array('label'=>'Create Project', 'url'=>array('create')),
	array('label'=>'Update Project', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Project', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Project', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->project_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		//'project_name',
		//'project_area',
	//	'project_image',
	),
)); ?>


<?php 

$clusterDataProvider=new CActiveDataProvider('Cluster',array(
'criteria'=>array(
  'condition'=>'project_id =:project_id',
  'params'=>array(':project_id'=>$model->id),
),
));
		
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$clusterDataProvider,
	'itemView'=>'_clusterview',
)); ?>

