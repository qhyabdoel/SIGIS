<?php
/* @var $this TbAbsensiController */
/* @var $model TbAbsensi */

$this->breadcrumbs=array(
	'Tb Absensis'=>array('index'),
	$model->Id_Absen=>array('view','id'=>$model->Id_Absen),
	'Update',
);

$this->menu=array(
	array('label'=>'List TbAbsensi', 'url'=>array('index')),
	array('label'=>'Create TbAbsensi', 'url'=>array('create')),
	array('label'=>'View TbAbsensi', 'url'=>array('view', 'id'=>$model->Id_Absen)),
	array('label'=>'Manage TbAbsensi', 'url'=>array('admin')),
);
?>

<h1>Update TbAbsensi <?php echo $model->Id_Absen; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>