<?php
/* @var $this KalenderController */
/* @var $model Kalender */

$this->breadcrumbs = array(
	'Personalia' 			=> array('/site/personalia'),
	'Gaji dan Upah'			=> array('/site/gaji'),
	'Gaji Bulanan' 			=> array('/site/bulanan'),
	'Gaji Bulanan' 			=> array('/site/perhitungan'),
	'Absensi' 				=> array('/site/absensi'),
	'Tanggal Libur' 		=> array('/site/tanggal_libur'),	
	'Daftar Tanggal Libur' 	=> array('index'),
	'Update',
);

$this->menu=array(
	array('label'=>'List Kalender', 'url'=>array('index')),
	array('label'=>'Create Kalender', 'url'=>array('create')),
	array('label'=>'View Kalender', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Kalender', 'url'=>array('admin')),
);

$index = 0;

if(isset($_REQUEST['index'])) $index = 1;

?>

<?php $this->renderPartial('_form', array('model'=>$model,'index'=>$index)); ?>