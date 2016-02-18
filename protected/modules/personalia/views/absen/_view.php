<?php
/* @var $this AbsenController */
/* @var $data Absen */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('No')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->No), array('view', 'id'=>$data->No)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NIK')); ?>:</b>
	<?php echo CHtml::encode($data->NIK); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Tanggal')); ?>:</b>
	<?php echo CHtml::encode($data->Tanggal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Jam_Masuk')); ?>:</b>
	<?php echo CHtml::encode($data->Jam_Masuk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Jam_Keluar')); ?>:</b>
	<?php echo CHtml::encode($data->Jam_Keluar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Jam_Kerja')); ?>:</b>
	<?php echo CHtml::encode($data->Jam_Kerja); ?>
	<br />


</div>