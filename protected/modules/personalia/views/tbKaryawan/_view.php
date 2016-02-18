<?php
/* @var $this TbKaryawanController */
/* @var $data TbKaryawan */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('NIK')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->NIK), array('view', 'id'=>$data->NIK)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Nama')); ?>:</b>
	<?php echo CHtml::encode($data->Nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Kode_Departement')); ?>:</b>
	<?php echo CHtml::encode($data->Kode_Departement); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Kode_Jabatan')); ?>:</b>
	<?php echo CHtml::encode($data->Kode_Jabatan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Tanggal_Masuk')); ?>:</b>
	<?php echo CHtml::encode($data->Tanggal_Masuk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Masa_Kerja')); ?>:</b>
	<?php echo CHtml::encode($data->Masa_Kerja); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Kontrak_Awal')); ?>:</b>
	<?php echo CHtml::encode($data->Kontrak_Awal); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Kontrak_Akhir')); ?>:</b>
	<?php echo CHtml::encode($data->Kontrak_Akhir); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Jenis_ID')); ?>:</b>
	<?php echo CHtml::encode($data->Jenis_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('No_ID')); ?>:</b>
	<?php echo CHtml::encode($data->No_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Status')); ?>:</b>
	<?php echo CHtml::encode($data->Status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Tempat_Lahir')); ?>:</b>
	<?php echo CHtml::encode($data->Tempat_Lahir); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Tanggal_Lahir')); ?>:</b>
	<?php echo CHtml::encode($data->Tanggal_Lahir); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Alamat_Rumah')); ?>:</b>
	<?php echo CHtml::encode($data->Alamat_Rumah); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('No_Telp_Rumah')); ?>:</b>
	<?php echo CHtml::encode($data->No_Telp_Rumah); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('No_HP')); ?>:</b>
	<?php echo CHtml::encode($data->No_HP); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('No_HP2')); ?>:</b>
	<?php echo CHtml::encode($data->No_HP2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Alamat_Email')); ?>:</b>
	<?php echo CHtml::encode($data->Alamat_Email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('No_NPWP')); ?>:</b>
	<?php echo CHtml::encode($data->No_NPWP); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('No_KPJ')); ?>:</b>
	<?php echo CHtml::encode($data->No_KPJ); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Bank_Rek')); ?>:</b>
	<?php echo CHtml::encode($data->Bank_Rek); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('No_Rek')); ?>:</b>
	<?php echo CHtml::encode($data->No_Rek); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Nama_Pemilik_Rek')); ?>:</b>
	<?php echo CHtml::encode($data->Nama_Pemilik_Rek); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Nama_Jabatan')); ?>:</b>
	<?php echo CHtml::encode($data->Nama_Jabatan); ?>
	<br />

	*/ ?>

</div>