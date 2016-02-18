
<?php
/* @var $this TbKetentuanController */
/* @var $model TbKetentuan */
/* @var $form CActiveForm */
?>

<div class="form">		

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tb-ketentuan-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<?php if($confirm==1){ 
	if(isset($disable)&&$disable=='true'){
		?><label>Masukan password superadmin untuk menghapus data!</label><?php
	}
	else{
		?><label>Masukan password superadmin untuk menyimpan data!</label><?php
	} ?>

	<!-- <label>Masukan password superadmin untuk menyimpan data!</label> -->
	
	<input name="password" type="password">	
	<input name="action" hidden="true">

<div hidden="true">

<?php }else{ ?>
<div>		
<?php } ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<table>
		<tr>
			<td><?php echo $form->labelEx($model,'id'); ?></td>
			<td>
				<input value="<?php echo $id; ?>" disabled="true">
				<?php echo $form->textField($model,'id',array('hidden'=>'true','value'=>$id)); ?>
				<?php echo $form->error($model,'id'); ?>
			</td>
			<td><label><h4>Tunjangan</h4></label></td>
			<td></td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'id_golongan'); ?></td>
			<td>
				<?php echo $form->dropDownList($model,'id_golongan',$golongans); ?>
				<?php echo $form->error($model,'id_golongan'); ?>
			</td>
			<td><?php echo $form->labelEx($model,'makan_transport'); ?></td>
			<td>
				<?php echo $form->textField($model,'makan_transport'); ?>
				<?php echo $form->error($model,'makan_transport'); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'kode_department'); ?></td>
			<td>
				<?php echo $form->dropDownList($model,'kode_department',$departmens); ?>
				<?php echo $form->error($model,'kode_department'); ?>
			</td>
			<td><?php echo $form->labelEx($model,'premi_hadir'); ?></td>
			<td>
				<?php echo $form->textField($model,'premi_hadir'); ?>
				<?php echo $form->error($model,'premi_hadir'); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'kode_jabatan'); ?></td>
			<td>
				<?php echo $form->dropDownList($model,'kode_jabatan',$jabatans); ?>
				<?php echo $form->error($model,'kode_jabatan'); ?>
			</td>
			<td><?php echo $form->labelEx($model,'bonus_hadir'); ?></td>
			<td>
				<?php echo $form->textField($model,'bonus_hadir'); ?>
				<?php echo $form->error($model,'bonus_hadir'); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'Masa_Kerja'); ?></td>
			<td>
				<?php echo $form->textField($model,'Masa_Kerja',array('id'=>'masa_kerjaField','hidden'=>'true')); ?>
				<input id="masa_kerja_thField" value="<?php echo $masa_kerja_tahun; ?>" style="width:50px;"> <b>th</b> &nbsp;
				<input id="masa_kerja_blField" value="<?php echo $masa_kerja_bulan; ?>" style="width:50px;"> <b>bl</b>
				<?php echo $form->error($model,'Masa_Kerja'); ?>
			</td>
			<td><?php echo $form->labelEx($model,'lembur'); ?></td>
			<td>
				<?php echo $form->textField($model,'lembur'); ?>
				<?php echo $form->error($model,'lembur'); ?>
			</td>
		</tr>
		<tr>
			<td></td><td></td>
			<td><?php echo $form->labelEx($model,'lembur_luarkota'); ?></td>
			<td>
				<?php echo $form->textField($model,'lembur_luarkota'); ?>
				<?php echo $form->error($model,'lembur_luarkota'); ?>
			</td>
		</tr>
		<tr><td></td><td></td><td><label><br><h4>Denda</h4></label></td><td></td></tr>
		<tr>
			<td></td><td></td>
			<td><?php echo $form->labelEx($model,'keterlambatan'); ?></td>
			<td>
				<?php echo $form->textField($model,'keterlambatan'); ?>
				<?php echo $form->error($model,'keterlambatan'); ?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><label><br><h4>Plafond Pinjaman dan Kesehatan</h4></label></td>
			<td></td>
		</tr>
		<tr>
			<td></td><td></td>
			<td><?php echo $form->labelEx($model,'kasbon'); ?></td>
			<td>
				<?php echo $form->textField($model,'kasbon'); ?>
				<?php echo $form->error($model,'kasbon'); ?>
			</td>
		</tr>
		<tr>
			<td></td><td></td>
			<td><?php echo $form->labelEx($model,'kesehatan'); ?></td>
			<td>
				<?php echo $form->textField($model,'kesehatan'); ?>
				<?php echo $form->error($model,'kesehatan'); ?>
			</td>
		</tr>		
	</table>

	<input name="from" value="<?php echo $from; ?>" hidden>
	
	<br><br><br><br><br><br>

	<!-- <input name="active" hidden="true" id="activeField"> -->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('hidden'=>'true','id'=>'submit')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>

</div><!-- form -->

<?php 
// $href2 = Yii::app()->createUrl('personalia/TbKetentuan/disable/id/'.$nik); 

if(isset($update)){
	
	$href2 = Yii::app()->createUrl('personalia/TbKetentuan/disable/id/'.$id);
	
	if($confirm==0){
		if($from=='index'){
			?><a class="small-button" id="buttonCreate">Update</a> <?php		
		}
		else{
			?><a class="small-button" id="buttonCreate">Update</a> <?php 		
			?><a class="small-button" id="buttonDelete" href="<?php echo $href2; ?>">Delete</a> <?php
		}		
	}
	else{		
		if($disable=='false'){
			?><a class="small-button" id="buttonCreate">Update</a> <?php
		}		
		else{
			?><a class="small-button" id="buttonDelete" href="<?php echo $href2; ?>">Delete</a> <?php ;
		}
	}
}
else{
	?><a class="small-button" id="buttonCreate">Create</a> <?php 		
}

$href = Yii::app()->createUrl('personalia/TbKetentuan/create'); 
?>

<a class="small-button" href="<?php echo $href; ?>">Cancel</a>

<script>

$('#buttonCreate').click(function(){
	masa_kerja_tahun 	= $('#masa_kerja_thField').val();
	masa_kerja_bulan 	= $('#masa_kerja_blField').val();
	masa_kerja 			= masa_kerja_tahun*12 + masa_kerja_bulan*1;
	
	$('#masa_kerjaField').val(masa_kerja);
	$('#submit').click();
});

$('#buttonDelete').click(function(){	
	$('#submit').click();
});

</Script>