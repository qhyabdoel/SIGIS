<?php
/* @var $this TbAbsensiController */
/* @var $data TbAbsensi */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id_Absen')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id_Absen), array('view', 'id'=>$data->Id_Absen)); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('Total_Jam_Kerja')); ?>:</b>
	<?php echo CHtml::encode($data->Total_Jam_Kerja); ?>
	<br />


</div>