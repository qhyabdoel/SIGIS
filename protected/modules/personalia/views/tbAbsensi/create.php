<?php
/* @var $this TbAbsensiController */
/* @var $model TbAbsensi */

// $this->breadcrumbs=array(
// 	'Tb Absensis'=>array('index'),
// 	'Create',
// );

// $this->menu=array(
// 	array('label'=>'List TbAbsensi', 'url'=>array('index')),
// 	array('label'=>'Manage TbAbsensi', 'url'=>array('admin')),
// );

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}
?>

<h1>Absensi </h1>

<?php 
$this->renderPartial('_form', array(
	
	'model' => $model,
	'date'	=> $date,
	'id' 	=> $id,
)); 
?>