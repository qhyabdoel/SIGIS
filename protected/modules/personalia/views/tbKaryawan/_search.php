<?php
/* @var $this TbKaryawanController */
/* @var $model TbKaryawan */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'NIK'); ?>
		<?php echo $form->textField($model,'NIK'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Nama'); ?>
		<?php echo $form->textField($model,'Nama',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Kode_Departement'); ?>
		<?php echo $form->textField($model,'Kode_Departement'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Kode_Jabatan'); ?>
		<?php echo $form->textField($model,'Kode_Jabatan'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Tanggal_Masuk'); ?>
		<?php echo $form->textField($model,'Tanggal_Masuk'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Masa_Kerja'); ?>
		<?php echo $form->textField($model,'Masa_Kerja'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Kontrak_Awal'); ?>
		<?php echo $form->textField($model,'Kontrak_Awal'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Kontrak_Akhir'); ?>
		<?php echo $form->textField($model,'Kontrak_Akhir'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Jenis_ID'); ?>
		<?php echo $form->textField($model,'Jenis_ID',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'No_ID'); ?>
		<?php echo $form->textField($model,'No_ID',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Status'); ?>
		<?php echo $form->textField($model,'Status',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Tempat_Lahir'); ?>
		<?php echo $form->textField($model,'Tempat_Lahir',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Tanggal_Lahir'); ?>
		<?php echo $form->textField($model,'Tanggal_Lahir'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Alamat_Rumah'); ?>
		<?php echo $form->textField($model,'Alamat_Rumah',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'No_Telp_Rumah'); ?>
		<?php echo $form->textField($model,'No_Telp_Rumah'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'No_HP'); ?>
		<?php echo $form->textField($model,'No_HP'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'No_HP2'); ?>
		<?php echo $form->textField($model,'No_HP2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Alamat_Email'); ?>
		<?php echo $form->textField($model,'Alamat_Email',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'No_NPWP'); ?>
		<?php echo $form->textField($model,'No_NPWP',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'No_KPJ'); ?>
		<?php echo $form->textField($model,'No_KPJ',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Bank_Rek'); ?>
		<?php echo $form->textField($model,'Bank_Rek',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'No_Rek'); ?>
		<?php echo $form->textField($model,'No_Rek',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Nama_Pemilik_Rek'); ?>
		<?php echo $form->textField($model,'Nama_Pemilik_Rek',array('size'=>50,'maxlength'=>50)); ?>
	</div>	

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->