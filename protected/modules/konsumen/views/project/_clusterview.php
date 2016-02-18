<?php
/* @var $this ClusterController */
/* @var $data Cluster */
?>

<div class="view">



		<?php echo CHtml::link(CHtml::encode($data->cluster_name), array('cluster/view', 'id'=>$data->id)); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('cluster_image')); ?>:</b>
	<?php echo CHtml::encode($data->cluster_image); ?>
	<br />


</div>