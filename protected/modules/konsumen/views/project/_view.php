<?php
/* @var $this ProjectController */
/* @var $data Project */
?>

<div class="view">



		<?php echo CHtml::link(CHtml::encode($data->project_name), array('view', 'id'=>$data->id)); ?>
	<br /><br/>
<img src="
	<?php echo CHtml::encode($data->project_image); ?>">
	<br />


</div>