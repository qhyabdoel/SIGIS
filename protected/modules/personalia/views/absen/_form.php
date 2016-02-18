<?php
/* @var $this AbsenController */
/* @var $model Absen */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'absen-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NIK'); ?>
		<?php echo $form->textField($model,'NIK'); ?>
		<?php echo $form->error($model,'NIK'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Tanggal'); ?>
		<?php echo $form->textField($model,'Tanggal'); ?>
		<?php echo $form->error($model,'Tanggal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Jam_Masuk'); ?>
		<?php echo $form->textField($model,'Jam_Masuk'); ?>
		<?php echo $form->error($model,'Jam_Masuk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Jam_Keluar'); ?>
		<?php echo $form->textField($model,'Jam_Keluar'); ?>
		<?php echo $form->error($model,'Jam_Keluar'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Jam_Kerja'); ?>
		<?php echo $form->textField($model,'Jam_Kerja'); ?>
		<?php echo $form->error($model,'Jam_Kerja'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->