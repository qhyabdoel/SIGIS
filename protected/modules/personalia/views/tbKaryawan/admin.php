<?php
/* @var $this TbKaryawanController */
/* @var $model TbKaryawan */

$this->breadcrumbs=array(
	'Karyawans'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TbKaryawan', 'url'=>array('index')),
	array('label'=>'Create TbKaryawan', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tb-karyawan-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Tb Karyawans</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tb-karyawan-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'NIK',
		'Nama',
		'Kode_Departement',
		'Kode_Jabatan',
		'Tanggal_Masuk',
		'Masa_Kerja',
		/*
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
		'Bank_Rek',
		'No_Rek',
		'Nama_Pemilik_Rek',
		'Nama_Jabatan',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
