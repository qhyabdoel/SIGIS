<?php
/* @var $this ClusterController */
/* @var $model Cluster */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cluster-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'project_id'); ?>
		<?php echo $form->textField($model,'project_id'); ?>
		<?php echo $form->error($model,'project_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cluster_name'); ?>
		<?php echo $form->textField($model,'cluster_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'cluster_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cluster_area'); ?>
		<?php echo $form->textField($model,'cluster_area',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'cluster_area'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cluster_image'); ?>
		<?php echo $form->textField($model,'cluster_image',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'cluster_image'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->