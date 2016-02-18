<?php

/* @var $this KalenderController */
/* @var $model Kalender */
/* @var $form CActiveForm */

$urlClose 	= Yii::app()->createUrl('personalia/kalender/index');

if(!isset($index)){
	$index 		= 0;	
	$urlClose 	= Yii::app()->createUrl('site/tanggal_libur');;
} 

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kalender-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<input name="index" value="<?php echo $index; ?>" hidden>

	<table>
		<tr>
			<th><?php echo $form->labelEx($model,'nama_perayaan'); ?></th>
			<td>
				<?php echo $form->textField($model,'nama_perayaan',array('style'=>'width:200px;')); ?>
				<?php echo $form->error($model,'nama_perayaan'); ?>
			</td>
		</tr>
		<tr>
			<th><?php echo $form->labelEx($model,'tanggal'); ?></th>
			<td>
				<?php echo $form->dateField($model,'tanggal',array('style'=>'width:200px;')); ?>
				<?php echo $form->error($model,'tanggal'); ?>
			</td>
		</tr>
	</table>

	<div class="row buttons">
		<a href="<?php echo $urlClose; ?>" class="small-button">Close</a>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan', array('class'=>'small-button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->