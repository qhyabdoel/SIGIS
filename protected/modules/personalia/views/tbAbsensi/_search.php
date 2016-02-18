<?php
/* @var $this TbAbsensiController */
/* @var $model TbAbsensi */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'Id_Absen'); ?>
		<?php echo $form->textField($model,'Id_Absen'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NIK'); ?>
		<?php echo $form->textField($model,'NIK'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Tanggal'); ?>
		<?php echo $form->textField($model,'Tanggal'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Jam_Masuk'); ?>
		<?php echo $form->textField($model,'Jam_Masuk'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Jam_Keluar'); ?>
		<?php echo $form->textField($model,'Jam_Keluar'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Total_Jam_Kerja'); ?>
		<?php echo $form->textField($model,'Total_Jam_Kerja'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->