<?php
/* @var $this TbKaryawanController */
/* @var $model TbKaryawan */

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs =array(

	'Personalia' 	=>array('/site/personalia'),
	'Karyawan' 		=>array('/site/karyawan'),
	'Input Data' 	=>array('create'),
);

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}
?>

<?php 

$this->renderPartial($form, array(
	'masa_kerja_tahun' 	=> $masa_kerja_tahun,
	'masa_kerja_bulan' 	=> $masa_kerja_bulan,
	'departmens'		=> $departmens,
	'jabatans'			=> $jabatans,
	'jam_kerjas' 		=> $jam_kerjas,
	'jam_kerjas2' 		=> $jam_kerjas2,
	'confirm'			=> $confirm,
	'model'				=> $model,
	'from'				=> $from,
	'nik'				=> $nik,
)); 

?>