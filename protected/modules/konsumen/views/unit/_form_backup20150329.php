<?php
/* @var $this UnitController */
/* @var $model Unit */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'unit-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'kode'); ?>
		<?php echo $form->textField($model,'kode',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'kode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'project_id'); ?>
		<?php echo $form->textField($model,'project_id'); ?>
		<?php echo $form->error($model,'project_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cluster_id'); ?>
		<?php echo $form->textField($model,'cluster_id'); ?>
		<?php echo $form->error($model,'cluster_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type_id'); ?>
		<?php echo $form->textField($model,'type_id'); ?>
		<?php echo $form->error($model,'type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jalan'); ?>
		<?php echo $form->textField($model,'jalan',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'jalan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nomor'); ?>
		<?php echo $form->textField($model,'nomor',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nomor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lb'); ?>
		<?php echo $form->textField($model,'lb'); ?>
		<?php echo $form->error($model,'lb'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lt'); ?>
		<?php echo $form->textField($model,'lt'); ?>
		<?php echo $form->error($model,'lt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lb2'); ?>
		<?php echo $form->textField($model,'lb2'); ?>
		<?php echo $form->error($model,'lb2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lt2'); ?>
		<?php echo $form->textField($model,'lt2'); ?>
		<?php echo $form->error($model,'lt2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lt_bpn'); ?>
		<?php echo $form->textField($model,'lt_bpn'); ?>
		<?php echo $form->error($model,'lt_bpn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>9,'maxlength'=>9)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kavling_area'); ?>
		<?php echo $form->textField($model,'kavling_area',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'kavling_area'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kavling_image'); ?>
		<?php echo $form->textField($model,'kavling_image',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'kavling_image'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->