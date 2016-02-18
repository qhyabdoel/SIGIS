<?php
/* @var $this UnitController */
/* @var $model Unit */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode'); ?>
		<?php echo $form->textField($model,'kode',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'project_id'); ?>
		<?php echo $form->textField($model,'project_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cluster_id'); ?>
		<?php echo $form->textField($model,'cluster_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type_id'); ?>
		<?php echo $form->textField($model,'type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jalan'); ?>
		<?php echo $form->textField($model,'jalan',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nomor'); ?>
		<?php echo $form->textField($model,'nomor',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lb'); ?>
		<?php echo $form->textField($model,'lb'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lt'); ?>
		<?php echo $form->textField($model,'lt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lb2'); ?>
		<?php echo $form->textField($model,'lb2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lt2'); ?>
		<?php echo $form->textField($model,'lt2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lt_bpn'); ?>
		<?php echo $form->textField($model,'lt_bpn'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kavling_area'); ?>
		<?php echo $form->textField($model,'kavling_area',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kavling_image'); ?>
		<?php echo $form->textField($model,'kavling_image',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->