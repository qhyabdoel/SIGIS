
<?php
/* @var $this TbKetentuanController */
/* @var $model TbKetentuan */
/* @var $form CActiveForm */

$baseUrl 	= Yii::app()->baseUrl; 
$cs 		= Yii::app()->getClientScript();

$cs->registerScriptFile($baseUrl.'/js/mask_money.js');

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
			<td><?php echo $form->labelEx($model,'id_golongan'); ?></td>
			<td>
				<?php 
				$golongans['add value'] = '--add value--'; 
				$golongans['edit'] 		= '--edit--'; 
				?>				
				<?php echo $form->dropDownList($model,'id_golongan',$golongans,array('id'=>'golonganField','style'=>'width:173px;')); ?>
				<?php echo $form->error($model,'id_golongan'); ?>
			</td>
			<td><label><h4>Tunjangan</h4></label></td>
			<td></td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'kode_department'); ?></td>
			<td>
				<?php 
				$departmens['add value'] = '--add value--'; 
				$departmens['edit'] 	 = '--edit--'; 
				?>				
				<?php echo $form->dropDownList($model,'kode_department',$departmens,array('style'=>'width:173px;','id'=>'departmenField')); ?>
				<?php echo $form->error($model,'kode_department'); ?>
			</td>
			<td><?php echo $form->labelEx($model,'makan_transport'); ?></td>
			<td>
				<?php $makan_transport = number_format($model['makan_transport'],0,"",".") ?>
				<?php echo 'Rp '.$form->textField($model,'makan_transport',array('id'=>'makan_transport','value'=>$makan_transport)); ?>
				<?php echo $form->error($model,'makan_transport'); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'kode_jabatan'); ?></td>
			<td>
				<?php 
				$jabatans['add value'] 	= '--add value--'; 
				$jabatans['edit'] 	 	= '--edit--'; 
				?>				
				<?php echo $form->dropDownList($model,'kode_jabatan',$jabatans,array('style'=>'width:173px;','id'=>'jabatanField')); ?>
				<?php echo $form->error($model,'kode_jabatan'); ?>
			</td>
			<td><?php echo $form->labelEx($model,'premi_hadir'); ?></td>
			<td>
				<?php $premi_hadir = number_format($model['premi_hadir'],0,"",".") ?>
				<?php echo 'Rp '.$form->textField($model,'premi_hadir',array('id'=>'premi_hadir','value'=>$premi_hadir)); ?>
				<?php echo $form->error($model,'premi_hadir'); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'Masa_Kerja'); ?></td>
			<td>				
				<?php 
				$masa_kerjas['add value'] 	= '--add value--'; 
				$masa_kerjas['edit'] 		= '--edit--'; 
				?>
				<?php echo $form->dropDownList($model,'Masa_Kerja',$masa_kerjas,array('id'=>'masa_kerjaField','style'=>'width:173px;')); ?>
				<?php echo $form->error($model,'Masa_Kerja'); ?>
			</td>
			<td><?php echo $form->labelEx($model,'bonus_hadir'); ?></td>
			<td>
				<?php $bonus_hadir = number_format($model['bonus_hadir'],0,"",".") ?>
				<?php echo 'Rp '.$form->textField($model,'bonus_hadir',array('id'=>'bonus_hadir','value'=>$bonus_hadir)); ?>
				<?php echo $form->error($model,'bonus_hadir'); ?>
			</td>
		</tr>
		<tr>
			<td></td><td></td>
			<td><?php echo $form->labelEx($model,'lembur'); ?></td>
			<td>
				<?php $lembur = number_format($model['lembur'],0,"",".") ?>
				<?php echo 'Rp '.$form->textField($model,'lembur',array('id'=>'lembur','value'=>$lembur)); ?>
				<?php echo $form->error($model,'lembur'); ?>
			</td>
		</tr>
		<tr>
			<td></td><td></td>
			<td><?php echo $form->labelEx($model,'lembur_luarkota'); ?></td>
			<td>
				<?php $lembur_luarkota = number_format($model['lembur_luarkota'],0,"",".") ?>
				<?php echo 'Rp '.$form->textField($model,'lembur_luarkota',array('id'=>'lembur_luarkota','value'=>$lembur_luarkota)); ?>
				<?php echo $form->error($model,'lembur_luarkota'); ?>
			</td>
		</tr>
		<tr><td></td><td></td><td><label><br><h4>Denda</h4></label></td><td></td></tr>
		<tr>
			<td></td><td></td>
			<td><?php echo $form->labelEx($model,'keterlambatan'); ?></td>
			<td>
				<?php $keterlambatan = number_format($model['keterlambatan'],0,"",".") ?>
				<?php echo 'Rp '.$form->textField($model,'keterlambatan',array('id'=>'keterlambatan','value'=>$keterlambatan)); ?>
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
				<?php $kasbon = number_format($model['kasbon'],0,"",".") ?>
				<?php echo 'Rp '.$form->textField($model,'kasbon',array('id'=>'kasbon','value'=>$kasbon)); ?>
				<?php echo $form->error($model,'kasbon'); ?>
			</td>
		</tr>
		<tr>
			<td></td><td></td>
			<td><?php echo $form->labelEx($model,'kesehatan'); ?></td>
			<td>
				<?php $kesehatan = number_format($model['kesehatan'],0,"",".") ?>
				<?php echo 'Rp '.$form->textField($model,'kesehatan',array('id'=>'kesehatan','value'=>$kesehatan)); ?>
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

if(isset($update)){	
	if($confirm==0){
		if($from=='index'){
			?><a class="small-button" id="buttonCreate">Update</a> <?php		
		}
		else{
			?><a class="small-button" id="buttonUpdate">Update</a> <?php 		
			?><a class="small-button" id="buttonDelete">Delete</a> <?php
		}				
	}
	else{		
		if($disable=='false'){
			?><a class="small-button" id="buttonCreate">Update</a> <?php
		}		
		else{
			?><a class="small-button" id="buttonDelete">Delete</a> <?php ;
		}		
	}	
}
else ?><a class="small-button" id="buttonCreate">Create</a> <?php

$href3 	= Yii::app()->createUrl('personalia/TbGolongan/index?ketentuan='.$id);
$href4 	= Yii::app()->createUrl('personalia/TbMasaKerjaKetentuan/index?ketentuan='.$id);
$href 	= Yii::app()->createUrl('personalia/TbKetentuan/create');
$href5  = Yii::app()->createUrl('personalia/TbKetentuan/tambah_golongan');
$href6  = Yii::app()->createUrl('personalia/TbKetentuan/tambah_masa_kerja');
$href10	= Yii::app()->createUrl('personalia/TbKetentuan/tambah_department');
$href12 = Yii::app()->createUrl('personalia/TbKetentuan/tambah_jabatan');
$href13 = Yii::app()->createUrl('personalia/TbJabatan/index?ketentuan='.$id);
$href11 = Yii::app()->createUrl('personalia/TbDepartmen/index?ketentuan='.$id);
$href7 	= Yii::app()->createUrl('personalia/TbKetentuan/verify');
$href8 	= Yii::app()->createUrl('personalia/TbKetentuan/request_verifikasi');
$href9  = Yii::app()->createUrl('personalia/TbKetentuan/disable/id/'.$model->id);
?>

<a class="small-button" href="<?php echo $href; ?>">Cancel</a>

<input value="<?php echo $href3; ?>" id="golonganUrlField" hidden>
<input value="<?php echo $href5; ?>" id="golonganUrlAjaxField" hidden>
<input value="<?php echo $href4; ?>" id="masa_kerjaUrlField" hidden>
<input value="<?php echo $href6; ?>" id="masa_kerjaUrlAjaxField" hidden>
<input value="<?php echo $href11; ?>" id="departmentUrlField" hidden>
<input value="<?php echo $href10; ?>" id="departmentUrlAjaxField" hidden>
<input value="<?php echo $href12; ?>" id="jabatanUrlAjaxField" hidden>
<input value="<?php echo $href13; ?>" id="jabatanUrlField" hidden>

<input id="golonganCounterField" hidden>
<input id="jabatanCounterField" hidden>
<input id="masa_kerjaCounterField" hidden>
<input id="departmentCounterField" hidden>
<input id="counterMessage" hidden>

<?php $this->renderPartial('_golongan'); ?>
<?php $this->renderPartial('_masa_kerja'); ?>
<?php $this->renderPartial('_department'); ?>
<?php $this->renderPartial('_jabatan'); ?>
<?php $this->renderPartial('_verifikasi'); ?>

<input value="<?php echo $href8; ?>" id="requestUrl" hidden>
<input value="<?php echo $href7; ?>" id="requestUrl2" hidden>
<input value="<?php echo $href9; ?>" id="deleteLink" hidden>
<input id="actionField" hidden>

<script>

$('#closeInfo').click(function(){
	$('#infoDiv').fadeToggle('fast');
});

$('#closeSuccess').click(function(){
	$('#successDiv').fadeToggle("fast");

	if($('#actionField').val()=='1'){
		window.location.href = $('#deleteLink').val();
	}
	else if($('#actionField').val()=='2'){
		$('#submit').click();		
	}
	else{
		$('#submit').click();
	}	
});

$('#closeFail').click(function(){
	('#failDiv').fadeToggle('fast');
});

$('#closeVerifikasi').click(function(){
	$("#verifikasiDiv").fadeToggle("fast");				

	if($('#counterMessage').val()=='0'){
		$('#failDiv').fadeToggle("fast");
	}
	else if($('#counterMessage').val()=='1'){
		$('#successDiv').fadeToggle("fast");
	}
});	

$('#buttonUpdate').click(function(){
	$('#actionField').val('');
	$('#verifikasiDiv').fadeToggle('fast');

	// $('#submit').click();
});

$('#buttonCreate').click(function(){	
	$('#actionField').val('2');
	$('#verifikasiDiv').fadeToggle('fast');

	// $('#submit').click();
});

$('#buttonDelete').click(function(){	
	// $('#submit').click();

	$('#actionField').val('1');
	$('#verifikasiDiv').fadeToggle('fast');
});

$('#departmenField').click(function(){
	if($(this).val()=='add value'){
		event.preventDefault();
		$('#departmentDiv').fadeToggle('fast');
		$(this).val($('#departmentCounterField').val());
	}
	else if($(this).val()=='edit'){
		window.location.href = $('#departmentUrlField').val();
	}
	else{
		$('#departmentCounterField').val($(this).val());
	}
});

$('#masa_kerjaField').click(function(){	
	if($(this).val()=='add value'){
		event.preventDefault();
		$("#masa_kerjaDiv").fadeToggle("fast");			
		$(this).val($('#masa_kerjaCounterField').val());
	}
	else if($(this).val()=='edit'){
		window.location.href = $('#masa_kerjaUrlField').val();
	}
	else{
		$('#masa_kerjaCounterField').val($(this).val());
	}
});

$('#golonganField').click(function(){	
	if($(this).val()=='add value'){		
		event.preventDefault();
		$("#golonganDiv").fadeToggle("fast");	
		$(this).val($('#golonganCounterField').val());
	}
	else if($(this).val()=='edit'){
		window.location.href = $('#golonganUrlField').val();
	}
	else{
		$('#golonganCounterField').val($(this).val());
	}
});

$('#jabatanField').click(function(){
	if($(this).val()=='add value'){
		event.preventDefault();
		$('#jabatanDiv').fadeToggle('fast');	
		$(this).val($('#jabatanCounterField').val());
	}
	else if($(this).val()=='edit'){
		window.location.href = $('#jabatanUrlField').val();
	}
	else{
		$('#jabatanCounterField').val($(this).val());
	}
});

$('#closeMasa_kerja').click(function(){
	$("#masa_kerjaDiv").fadeToggle("fast");
	$('#errorCellMasa_kerja').text('');
});

$("#closeGolongan").click(function(){
	$("#golonganDiv").fadeToggle("fast");
});

$('#closeDepartment').click(function(){
	$('#departmentDiv').fadeToggle('fast');
});

$('#closeJabatan').click(function(){
	$('#jabatanDiv').fadeToggle('fast');
});

$('#makan_transport').maskMoney();

$('#premi_hadir').maskMoney();

$('#bonus_hadir').maskMoney();

$('#lembur').maskMoney();

$('#lembur_luarkota').maskMoney();

$('#keterlambatan').maskMoney();

$('#kasbon').maskMoney();

$('#kesehatan').maskMoney();

</Script>