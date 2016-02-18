<?php
/* @var $this KalenderController */
/* @var $model Kalender */

$this->breadcrumbs=array(
	'Kalenders'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Kalender', 'url'=>array('index')),
	array('label'=>'Create Kalender', 'url'=>array('create')),
	array('label'=>'Update Kalender', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Kalender', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Kalender', 'url'=>array('admin')),
);
?>

<h1>View Kalender #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nama_perayaan',
		'tanggal',
	),
)); ?>
