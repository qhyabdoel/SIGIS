<?php
/* @var $this TbKaryawanController */
/* @var $model TbKaryawan */
/* @var $form CActiveForm */
?>

<div class="form" id="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tb-karyawan-form',

	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	
	'enableAjaxValidation'=>true,
)); ?>	

<?php if($confirm==1){ 
	if(isset($button)&&$button=='update'){
		?><label>Masukan password superadmin untuk menyimpan data!</label><?php
	}
	elseif(isset($button)&&$button!='update'){
		?><label>Masukan password superadmin untuk menghapus data!</label><?php
	}
	else{
		?><label>Masukan password superadmin untuk menyimpan data!</label><?php
	} ?>

	<!-- <label>Masukan password superadmin untuk menyimpan data!</label> -->
	
	<input name="password" type="password">	

<div hidden="true">

<?php }else{ ?>
<div>		
<?php } ?>

	<p class="note">Fields with <span class="required">*</span> are req.</p>

	<?php echo $form->errorSummary($model); ?>

	<table>
	<tr>
		<td><?php echo $form->labelEx($model,'NIK'); ?></td>
		<td>
			<?php 
				if(isset($nik)){					
					echo $form->textField($model,'NIK_Absen',array('id'=>'nikField','value'=>$nik)); 
					echo $form->textField($model,'NIK',array('hidden'=>'true','value'=>$nik));
				}
				else{
					echo $form->textField($model,'NIK_Absen',array('id'=>'nikField'));
				}			
			?>			
			<?php echo $form->error($model,'NIK_Absen'); ?>
		</td>		
		<td><?php echo $form->labelEx($model,'Jenis_ID'); ?></td>
		<td>
			<?php echo $form->dropDownList($model,'Jenis_ID',array('KTP'=>'KTP','SIM'=>'SIM','PASPOR'=>'PASPOR'),
															 array('style'=>'width:174px;')
			);

			?>
			<?php echo $form->error($model,'Jenis_ID'); ?>
		</td>
	</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'Nama'); ?></td>
		<td>
			<?php echo $form->textField($model,'Nama',array('maxlength'=>50)); ?>
			<?php echo $form->error($model,'Nama'); ?>
		</td>
		<td><?php echo $form->labelEx($model,'No_ID'); ?></td>
		<td>
			<?php echo $form->textField($model,'No_ID'); 
			
			?>
			<?php echo $form->error($model,'No_ID'); ?>
		</td>
	</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'Kode_Departement'); ?></td>
		<td>
			<?php echo $form->dropDownList($model,'Kode_Departement',$departmens,array('style'=>'width:174px;')); ?>
			<?php echo $form->error($model,'Kode_Departement'); ?>
		</td>
		<td><?php echo $form->labelEx($model,'Status'); ?></td>

		<td>
			<?php 
				echo $form->dropDownList($model,'Status',array('TK'=>'TK','K0'=>'K0','K1'=>'K1','K2'=>'K2','K3'=>'K3','K4'=>'K4','K5'=>'K5'),
														 array('style'=>'width:174px;')
				); 
			?>
			
			<?php echo $form->error($model,'Status'); ?>
		</td>	
	</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'Kode_Jabatan'); ?></td>
		<td>
			<?php echo $form->dropDownList($model,'Kode_Jabatan',$jabatans,array('style'=>'width:174px;')); ?>
			<?php echo $form->error($model,'Kode_Jabatan'); ?>
		</td>
		<td><?php echo $form->labelEx($model,'Tempat_Lahir'); ?></td>
		<td>
			<?php echo $form->textField($model,'Tempat_Lahir',array('maxlength'=>50),
															 array('style'=>'width:174px;')
			);
			?>
			<?php echo $form->error($model,'Tempat_Lahir'); ?>
		</td>
	</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'Tanggal_Masuk'); ?></td>
		<td>
			<?php echo $form->dateField($model,'Tanggal_Masuk',array('style'=>'width:169px;')); ?>
			<?php echo $form->error($model,'Tanggal_Masuk'); ?>
		</td>
		<td><?php echo $form->labelEx($model,'Tanggal_Lahir'); ?></td>
		<td>
			<?php echo $form->dateField($model,'Tanggal_Lahir',array('style'=>'width:170px;')); ?>
			<?php echo $form->error($model,'Tanggal_Lahir'); ?>
		</td>
	</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'Masa_Kerja'); ?></td>
		<td>
			<?php echo $form->textField($model,'Masa_Kerja',array('id'=>'masa_kerjaField','hidden'=>'true')); ?>
			<input id="masa_kerja_thField" value="<?php echo $masa_kerja_tahun; ?>" style="width:50px;"> <b>Tahun</b> &nbsp;
			<input id="masa_kerja_blField" value="<?php echo $masa_kerja_bulan; ?>" style="width:50px;"> <b>Bln</b>
			<?php echo $form->error($model,'Tanggal_Masuk'); ?>
		</td>
		<td><?php echo $form->labelEx($model,'Alamat_Rumah'); ?></td>
		<td>
			<?php echo $form->textArea($model,'Alamat_Rumah',array('style'=>'width:168px;')); ?>
			<?php echo $form->error($model,'Alamat_Rumah'); ?>
		</td>
	</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'Status_Kerja'); ?></td>
		<td>			
			<?php 
				echo $form->dropDownList($model,'Status_Kerja',
					array('TETAP'=>'TETAP','KONTRAK'=>'KONTRAK','PERCOBAAN'=>'PERCOBAAN'),
					array('id'=>'status_kerjaField','style'=>'width:174px;')
				); 
			?>
			<?php echo $form->error($model,'Status_Kerja'); ?>
		</td>
		<td><?php echo $form->labelEx($model,'No_Telp_Rumah'); ?></td>
		<td>
			<?php echo $form->textField($model,'No_Telp_Rumah'); ?>
			<?php echo $form->error($model,'No_Telp_Rumah'); ?>
		</td>
	</tr>
	<tr>
		<td><?php echo $form->labelEx($model,'Kontrak_Awal'); ?></td>
		<td>
			<?php echo $form->dateField($model,'Kontrak_Awal',array('id'=>'kontrak_awalField','disabled'=>'true','style'=>'width:172px;')); ?>
			<?php echo $form->error($model,'Kontrak_Awal'); ?>
		</td>
		<td><?php echo $form->labelEx($model,'No_HP'); ?></td>
		<td>
			<?php echo $form->textField($model,'No_HP'); ?>
			<?php echo $form->error($model,'No_HP'); ?>
		</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<?php echo $form->dateField($model,'Kontrak_Akhir',array('id'=>'kontrak_akhirField','disabled'=>'true','style'=>'width:172px;')); ?>
			<?php echo $form->error($model,'Kontrak_Akhir'); ?>
		</td>
		<td><?php echo $form->labelEx($model,'No_HP2'); ?></td>
		<td>
			<?php echo $form->textField($model,'No_HP2'); ?>
			<?php echo $form->error($model,'No_HP2'); ?>
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><?php echo $form->labelEx($model,'Alamat_Email'); ?></td>
		<td>
			<?php echo $form->textField($model,'Alamat_Email'); ?>
			<?php echo $form->error($model,'Alamat_Email'); ?>
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><?php echo $form->labelEx($model,'No_NPWP'); ?></td>
		<td>
			<?php echo $form->textField($model,'No_NPWP'); ?>
			<?php echo $form->error($model,'No_NPWP'); ?>
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><?php echo $form->labelEx($model,'No_KPJ'); ?></td>
		<td>
			<?php echo $form->textField($model,'No_KPJ'); ?>
			<?php echo $form->error($model,'No_KPJ'); ?>
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>
			<br><br><br><br>
			<label><h4>Rekening</h4></label>
		</td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><?php echo $form->labelEx($model,'Nama_Rek'); ?></td>
		<td>
			<?php echo $form->textField($model,'Nama_Rek'); ?>
			<?php echo $form->error($model,'Nama_Rek'); ?>
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><?php echo $form->labelEx($model,'Bank_Rek'); ?></td>
		<td>
			<?php echo $form->dropDownList($model,'Bank_Rek',array('BCA'=>'BCA','BTN'=>'BTN'),
															 array('style'=>'width:174px;')
			  ); 
			?>
			<?php echo $form->error($model,'Bank_Rek'); ?>
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><?php echo $form->labelEx($model,'No_Rek'); ?></td>
		<td>
			<?php echo $form->textField($model,'No_Rek',array('style'=>'width:170px;')); ?>
			<?php echo $form->error($model,'No_Rek'); ?>
		</td>
	</tr>
	</table>

</div>		

	<br><br><br>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('id'=>'submit','hidden'=>'true')); ?>
	</div>			

<?php $this->endWidget(); ?>

<?php if(isset($button))
{
	if($confirm==0){
		?><a class="small-button" id="createButton">Update</a>&nbsp;<?php
 		
		$href = Yii::app()->createUrl('personalia/TbKaryawan/disable/id/'.$nik);

		?><a class="small-button" href="<?php echo $href; ?>">Delete</a><?php		
	}
	else{
		if($button=='update'){
			?><a class="small-button" id="createButton">Update</a><?php	
		}
		else{
			?><a class="small-button" id="createButton">Delete</a><?php	
		}
	}
}
else{ ?>
	<a class="small-button" id="createButton">Create</a>
<?php } 

$href = Yii::app()->createUrl('personalia/TbKaryawan/create');

?>			

<a class="small-button" href="<?php echo $href; ?>">Cancel</a>

</div><!-- form -->

<script>

$('#createButton').click(function(){
	masa_kerja_tahun 	= $('#masa_kerja_thField').val();
	masa_kerja_bulan 	= $('#masa_kerja_blField').val();
	masa_kerja 			= masa_kerja_tahun*12 + masa_kerja_bulan*1;

	$('#masa_kerjaField').val(masa_kerja);	
	$('#submit').click();
});

$('#status_kerjaField').change(function(){
	var_status_kerja = $('#status_kerjaField').val();

	if(var_status_kerja=='TETAP'){
		$('#kontrak_awalField').attr('disabled','true');
		$('#kontrak_akhirField').attr('disabled','true');
		$('#kontrak_awalField').val('');
		$('#kontrak_akhirField').val('');
	}
	else{
		$('#kontrak_awalField').removeAttr('disabled');
		$('#kontrak_akhirField').removeAttr('disabled');	
	}
});

</script>