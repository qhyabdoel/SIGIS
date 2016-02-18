
<?php Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs = array(

	'Personalia' => array('/site/personalia'),
	'Karyawan' 	 => array('/site/karyawan'),
	
	'Administrasi Karyawan'
); 

$url 	= Yii::app()->createUrl('personalia/TbKaryawan/form_surat');
$url2 	= Yii::app()->createUrl('personalia/TbKaryawan/surat');

?>

<br><br>

<a href="<?php echo $url; ?>" class="link-button">Input Form Surat</a><br><br>
<a href="<?php echo $url2; ?>" class="link-button">Buat Surat</a><br><br>