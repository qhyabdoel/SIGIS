<?php
/* @var $this AbsenController */
/* @var $model Absen */

$this->breadcrumbs=array(
	'Absens'=>array('index'),
	$model->No,
);

$this->menu=array(
	array('label'=>'List Absen', 'url'=>array('index')),
	array('label'=>'Create Absen', 'url'=>array('create')),
	array('label'=>'Update Absen', 'url'=>array('update', 'id'=>$model->No)),
	array('label'=>'Delete Absen', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->No),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Absen', 'url'=>array('admin')),
);
?>

<h1>View Absen #<?php echo $model->No; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'No',
		'NIK',
		'Tanggal',
		'Jam_Masuk',
		'Jam_Keluar',
		'Jam_Kerja',
	),
)); ?>
