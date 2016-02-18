<?php
/* @var $this TbKaryawanController */
/* @var $model TbKaryawan */

// $this->breadcrumbs=array(
// 	'Karyawans'=>array('index'),
// 	$model->NIK,
// );

?>

<h1>Data Karyawan #<?php echo $model->NIK; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'NIK',
		'Nama',
		'Kode_Departement',
		'Kode_Jabatan',
		'Tanggal_Masuk',
		'Masa_Kerja',
		'Kontrak_Awal',
		'Kontrak_Akhir',
		'Jenis_ID',
		'No_ID',
		'Status',
		'Tempat_Lahir',
		'Tanggal_Lahir',
		'Alamat_Rumah',
		'No_Telp_Rumah',
		'No_HP',
		'No_HP2',
		'Alamat_Email',
		'No_NPWP',
		'No_KPJ',		
	),
)); ?>
