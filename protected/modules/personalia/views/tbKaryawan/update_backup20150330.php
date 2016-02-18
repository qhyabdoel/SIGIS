<?php
/* @var $this TbKaryawanController */
/* @var $model TbKaryawan */

$this->breadcrumbs = array(
	'Personalia' 	=> array('/site/personalia'),
	'Karyawan' 		=> array('/site/karyawan'),
	'Input Data' 	=> array('create'),
);

foreach(Yii::app()->user->getFlashes() as $key=>$message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}
?>

<?php 

if(isset($button)){
	$button = 'delete';
}
else $button = 'update';

if(isset($_REQUEST['from'])){
	$from = $_REQUEST['from'];
}
else $from = 'create';

$this->renderPartial($form, array(	
	'masa_kerja_tahun' 	=> $masa_kerja_tahun,
	'masa_kerja_bulan' 	=> $masa_kerja_bulan,
	'departmens' 		=> $departmens,
	'jabatans' 			=> $jabatans,
	'jam_kerjas' 		=> $jam_kerjas,
	'confirm' 			=> $confirm,
	'button'			=> $button,
	'update' 			=> 1,
	'model' 			=> $model,
	'from'				=> $from,
	'nik'				=> $nik,
)); 

?>