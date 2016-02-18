<?php
/* @var $this ClusterController */
/* @var $data Cluster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_id')); ?>:</b>
	<?php echo CHtml::encode($data->project_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cluster_name')); ?>:</b>
	<?php echo CHtml::encode($data->cluster_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cluster_area')); ?>:</b>
	<?php echo CHtml::encode($data->cluster_area); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cluster_image')); ?>:</b>
	<?php echo CHtml::encode($data->cluster_image); ?>
	<br />


</div>