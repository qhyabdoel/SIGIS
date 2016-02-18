<?php
/* @var $this TbKetentuanController */
/* @var $model TbKetentuan */

$this->breadcrumbs=array(
	'Tb Ketentuans'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TbKetentuan', 'url'=>array('index')),
	array('label'=>'Create TbKetentuan', 'url'=>array('create')),
	array('label'=>'Update TbKetentuan', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TbKetentuan', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TbKetentuan', 'url'=>array('admin')),
);
?>

<h1>View TbKetentuan #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_golongan',
		'kode_jabatan',
		'kode_department',
		'makan_transport',
		'premi_hadir',
		'bonus_hadir',
		'lembur',
		'lembur_luarkota',
		'keterlambatan',
		'kasbon',
		'kesehatan',
	),
)); ?>
