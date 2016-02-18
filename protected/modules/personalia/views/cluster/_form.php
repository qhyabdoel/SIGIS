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

	<table>		
		<tr>
			<td><?php echo $form->labelEx($model,'project_id'); ?></td>
			<td>
				<?php echo $form->dropDownList($model,'project_id',$projects,array('style'=>'width:173px;'));  ?>
				<?php echo $form->error($model,'project_id'); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'cluster_name'); ?></td>
			<td>
				<?php echo $form->textField($model,'cluster_name'); ?>
				<?php echo $form->error($model,'cluster_name'); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'cluster_area'); ?></td>
			<td>
				<?php echo $form->textField($model,'cluster_area'); ?>
				<?php echo $form->error($model,'cluster_area'); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'cluster_image'); ?></td>
			<td>
				<?php echo $form->textField($model,'cluster_image'); ?>
				<?php echo $form->error($model,'cluster_image'); ?>
			</td>
		</tr>
	</table>					

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->