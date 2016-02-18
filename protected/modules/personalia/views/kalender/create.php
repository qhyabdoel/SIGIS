<?php
/* @var $this KalenderController */
/* @var $model Kalender */

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(
	'Personalia' 	=> array('/site/personalia'),
	'Gaji dan Upah'	=> array('/site/gaji'),
	'Gaji Bulanan' 	=> array('/site/bulanan'),
	'Gaji Bulanan' 	=> array('/site/perhitungan'),
	'Absensi' 		=> array('/site/absensi'),
	'Tanggal Libur' => array('/site/tanggal_libur'),
	'Input'
);

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}

?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>