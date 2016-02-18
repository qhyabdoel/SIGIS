<?php
/* @var $this UnitController */
/* @var $data Unit */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode')); ?>:</b>
	<?php echo CHtml::encode($data->kode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_id')); ?>:</b>
	<?php echo CHtml::encode($data->project_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cluster_id')); ?>:</b>
	<?php echo CHtml::encode($data->cluster_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type_id')); ?>:</b>
	<?php echo CHtml::encode($data->type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jalan')); ?>:</b>
	<?php echo CHtml::encode($data->jalan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nomor')); ?>:</b>
	<?php echo CHtml::encode($data->nomor); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('lb')); ?>:</b>
	<?php echo CHtml::encode($data->lb); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lt')); ?>:</b>
	<?php echo CHtml::encode($data->lt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lb2')); ?>:</b>
	<?php echo CHtml::encode($data->lb2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lt2')); ?>:</b>
	<?php echo CHtml::encode($data->lt2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lt_bpn')); ?>:</b>
	<?php echo CHtml::encode($data->lt_bpn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kavling_area')); ?>:</b>
	<?php echo CHtml::encode($data->kavling_area); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kavling_image')); ?>:</b>
	<?php echo CHtml::encode($data->kavling_image); ?>
	<br />

	*/ ?>

</div>