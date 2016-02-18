<?php
/* @var $this TbKetentuanController */
/* @var $data TbKetentuan */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_golongan')); ?>:</b>
	<?php echo CHtml::encode($data->id_golongan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_jabatan')); ?>:</b>
	<?php echo CHtml::encode($data->kode_jabatan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_department')); ?>:</b>
	<?php echo CHtml::encode($data->kode_department); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('makan_transport')); ?>:</b>
	<?php echo CHtml::encode($data->makan_transport); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('premi_hadir')); ?>:</b>
	<?php echo CHtml::encode($data->premi_hadir); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bonus_hadir')); ?>:</b>
	<?php echo CHtml::encode($data->bonus_hadir); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('lembur')); ?>:</b>
	<?php echo CHtml::encode($data->lembur); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lembur_luarkota')); ?>:</b>
	<?php echo CHtml::encode($data->lembur_luarkota); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keterlambatan')); ?>:</b>
	<?php echo CHtml::encode($data->keterlambatan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kasbon')); ?>:</b>
	<?php echo CHtml::encode($data->kasbon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kesehatan')); ?>:</b>
	<?php echo CHtml::encode($data->kesehatan); ?>
	<br />

	*/ ?>

</div>