
<?php Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs = array(

	'Personalia' 			=> array('/site/personalia'),
	'Karyawan' 	 			=> array('/site/karyawan'),	
	'Administrasi Karyawan' => array('/personalia/TbKaryawan/administrasi'),

	'Input Form Surat'
); 

$url  = Yii::app()->createUrl('personalia/TbKaryawan/tugas');
$url2 = Yii::app()->createUrl('personalia/TbKaryawan/kontrak');
$url3 = Yii::app()->createUrl('personalia/TbKaryawan/pengangkatan');

?>

<br><br>

<a href="#" class="link-button">Surat Tugas Percobaan</a><br><br>
<a href="#" class="link-button">Kontrak Karyawan</a><br><br>
<a href="#" class="link-button">Pengangkatan Karyawan Tetap</a><br><br>