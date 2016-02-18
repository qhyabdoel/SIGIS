<?php
/* @var $this TbKetentuanController */
/* @var $model TbKetentuan */
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
		<?php echo $form->label($model,'id_golongan'); ?>
		<?php echo $form->textField($model,'id_golongan'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_jabatan'); ?>
		<?php echo $form->textField($model,'kode_jabatan'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kode_department'); ?>
		<?php echo $form->textField($model,'kode_department'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'makan_transport'); ?>
		<?php echo $form->textField($model,'makan_transport'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'premi_hadir'); ?>
		<?php echo $form->textField($model,'premi_hadir'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bonus_hadir'); ?>
		<?php echo $form->textField($model,'bonus_hadir'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lembur'); ?>
		<?php echo $form->textField($model,'lembur'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lembur_luarkota'); ?>
		<?php echo $form->textField($model,'lembur_luarkota'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'keterlambatan'); ?>
		<?php echo $form->textField($model,'keterlambatan'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kasbon'); ?>
		<?php echo $form->textField($model,'kasbon'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kesehatan'); ?>
		<?php echo $form->textField($model,'kesehatan'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->