<?php
/* @var $this TbKetentuanController */
/* @var $model TbKetentuan */

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(
	'Personalia'=>array('/site/personalia'),
	'Ketentuan'=>array('/site/ketentuan'),
	'Input Data'=>array('create'),
);

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}
?>

<?php 

$this->renderPartial($form, array(
	'nik' 				=> $nik,
	'model' 			=> $model,
	'disable'			=> 'false',
	'confirm'			=> $confirm,
	'jabatans'			=> $jabatans,
	'golongans'			=> $golongans,
	'departmens' 		=> $departmens,
	'masa_kerja_tahun' 	=> $masa_kerja_tahun,
	'masa_kerja_bulan' 	=> $masa_kerja_bulan,
)); 

?>