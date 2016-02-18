<?php
/* @var $this TbAbsensiController */
/* @var $model TbAbsensi */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tb-absensi-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row" hidden="true">
		<?php echo $form->labelEx($model,'Id_Absen'); ?>
		<?php echo $form->textField($model,'Id_Absen',array('value'=>$id)); ?>
		<?php echo $form->error($model,'Id_Absen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NIK'); ?>		
		<?php echo $form->textField($model,'NIK'); ?>
		<?php echo $form->error($model,'NIK'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Tanggal'); ?>
		<input value="<?php echo $date; ?>" disabled="true">
		<?php echo $form->textField($model,'Tanggal',array('value'=>$date,'hidden'=>'true')); ?>
		<?php echo $form->error($model,'Tanggal'); ?>
	</div>

	<div class="row" hidden="true">
		<?php echo $form->labelEx($model,'Jam_Masuk'); ?>
		<?php echo $form->textField($model,'Jam_Masuk'); ?>
		<?php echo $form->error($model,'Jam_Masuk'); ?>
	</div>

	<div class="row" hidden="true">
		<?php echo $form->labelEx($model,'Jam_Keluar'); ?>
		<?php echo $form->textField($model,'Jam_Keluar'); ?>
		<?php echo $form->error($model,'Jam_Keluar'); ?>
	</div>

	<div class="row" hidden="true">
		<?php echo $form->labelEx($model,'Total_Jam_Kerja'); ?>
		<?php echo $form->textField($model,'Total_Jam_Kerja'); ?>
		<?php echo $form->error($model,'Total_Jam_Kerja'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->