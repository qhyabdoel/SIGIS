<?php
/* @var $this TbAbsensiController */
/* @var $model TbAbsensi */

$this->breadcrumbs=array(
	'Absensi'=>array('index'),
	$model->Id_Absen,
);

// $this->menu=array(
// 	array('label'=>'List TbAbsensi', 'url'=>array('index')),
// 	array('label'=>'Create TbAbsensi', 'url'=>array('create')),
// 	array('label'=>'Update TbAbsensi', 'url'=>array('update', 'id'=>$model->Id_Absen)),
// 	array('label'=>'Delete TbAbsensi', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id_Absen),'confirm'=>'Are you sure you want to delete this item?')),
// 	array('label'=>'Manage TbAbsensi', 'url'=>array('admin')),
// );
?>

<h1>Detail Absensi #<?php echo $model->Id_Absen; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id_Absen',
		'NIK',
		'Tanggal',
		'Jam_Masuk',
		'Jam_Keluar',
		'Total_Jam_Kerja',
	),
)); ?>
