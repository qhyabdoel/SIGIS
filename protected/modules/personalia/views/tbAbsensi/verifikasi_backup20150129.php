<?php 

$this->breadcrumbs=array(
	
	'Personalia' 	=> array('/site/personalia'),
	'Gaji dan Upah'	=> array('/site/gaji'),
	'Gaji Bulanan' 	=> array('/site/bulanan'),
	'Gaji Bulanan' 	=> array('/site/perhitungan'),
	'Absensi'		=> array('/site/absensi'),

	'Verifikasi Absen'
);

$url = Yii::app()->createUrl('site/absensi');

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}

?>

<?php $form = $this->beginWidget('CActiveForm', array('id'=>'tb-verifikasi_absen-form','enableAjaxValidation'=>false)); ?>

<input name="action" id="actionField" hidden="true" value="search">
<input name="active_tab" id="active_tabField" hidden="true" value="<?php echo $active_tab; ?>">

<?php echo $form->textField($cuti,'Nama',array('value'=>$nama,'hidden'=>'true')); ?>
<?php echo $form->textField($ijin,'Nama',array('value'=>$nama,'hidden'=>'true')); ?>
<?php echo $form->textField($sakit,'Nama',array('value'=>$nama,'hidden'=>'true')); ?>
<?php echo $form->textField($terlambat,'Nama',array('value'=>$nama,'hidden'=>'true')); ?>

<?php echo $form->textField($cuti,'Masa_Kerja',array('value'=>$masa_kerja,'hidden'=>'true')); ?>
<?php echo $form->textField($ijin,'Masa_Kerja',array('value'=>$masa_kerja,'hidden'=>'true')); ?>
<?php echo $form->textField($sakit,'Masa_Kerja',array('value'=>$masa_kerja,'hidden'=>'true')); ?>
<?php echo $form->textField($terlambat,'Masa_Kerja',array('value'=>$masa_kerja,'hidden'=>'true')); ?>

<?php echo $form->textField($cuti,'Jabatan',array('value'=>$karyawan_jabatan,'hidden'=>'true')); ?>
<?php echo $form->textField($ijin,'Jabatan',array('value'=>$karyawan_jabatan,'hidden'=>'true')); ?>
<?php echo $form->textField($sakit,'Jabatan',array('value'=>$karyawan_jabatan,'hidden'=>'true')); ?>
<?php echo $form->textField($terlambat,'Jabatan',array('value'=>$karyawan_jabatan,'hidden'=>'true')); ?>

<?php echo $form->textField($cuti,'Departmen',array('value'=>$karyawan_departemen,'hidden'=>'true')); ?>
<?php echo $form->textField($ijin,'Department',array('value'=>$karyawan_departemen,'hidden'=>'true')); ?>
<?php echo $form->textField($sakit,'Departmen',array('value'=>$karyawan_departemen,'hidden'=>'true')); ?>
<?php echo $form->textField($terlambat,'Departmen',array('value'=>$karyawan_departemen,'hidden'=>'true')); ?>

<table>
	<tr>
		<td>NIK</td>
		<td>
			<input name="nik" value="<?php echo $nik; ?>"> &nbsp;			
			<a href="#" class="small-button" id="buttonLinkSearch">Search</a>
		</td>
	</tr>
	<tr>
		<td>Nama</td>
		<td><input value="<?php echo $nama; ?>" disabled></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>Departemen</td>
		<td><input value="<?php echo $karyawan_departemen; ?>" disabled></td>
	</tr>
	<tr>
		<td>Jabatan</td>
		<td><input value="<?php echo $karyawan_jabatan; ?>" disabled></td>
	</tr>
	<tr>
		<td>Masa Kerja</td>
		<td>
			<input id="masa_kerja_thField" value="<?php echo $masa_kerja_tahun; ?>" style="width:50px;" disabled> <b>th</b> &nbsp;
			<input id="masa_kerja_blField" value="<?php echo $masa_kerja_bulan; ?>" style="width:50px;" disabled> <b>bl</b>
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>	
</table>

<div class="litle-font">

<?php 

$cuti_data 		= array('form'=>$form,'nik'=>$nik,'cuti'=>$cuti,'role'=>$role);
$sakit_data 	= array('form'=>$form,'nik'=>$nik,'sakit'=>$sakit);
$ijin_data 		= array('form'=>$form,'nik'=>$nik,'ijin'=>$ijin,'lama_ijins_sum'=>$lama_ijins_sum,'role'=>$role);
$terlambat_data	= array('form'=>$form,'nik'=>$nik,'terlambat'=>$terlambat,'lama_terlambats_sum'=>$lama_terlambats_sum);

$this->widget(
	'zii.widgets.jui.CJuiTabs',
	array(
	  	'tabs' => array(            
		    'Cuti'			 => array('content'=>$this->renderPartial('_cuti',$cuti_data,TRUE)),
			'Ijin' 			 => array('content'=>$this->renderPartial('_ijin',$ijin_data,TRUE)),
			'Sakit' 		 => array('content'=>$this->renderPartial('_sakit',$sakit_data,TRUE)),      
			'Ijin Terlambat' => array('content'=>$this->renderPartial('_terlambat',$terlambat_data,TRUE)),
	  	),

	    // additional javascript options for the tabs plugin
	    'options' 	=> array('collapsible'=>true,'selected'=>$active_tab),
	    'id' 		=> 'MyTab-Menu'
	)
); 

?>

</div>

<?php echo CHtml::submitButton($cuti->isNewRecord ? 'Create' : 'Save',array('id'=>'buttonSubmit','hidden'=>'true')); ?>

<?php $this->endWidget(); ?>

<br>

<a class="small-button" href="#" id="buttonLinkSubmit">Submit</a>
<a class="small-button" href="<?php echo $url; ?>">Cancel</a>

<script>

$('#buttonLinkSubmit').click(function(){		
	$('#actionField').val('submit');	
	$('#buttonSubmit').click();
});

$('#buttonLinkSearch').click(function(){	
	$('#buttonSubmit').click();
});

$('#MyTab-Menu').click(function(){	
	$('#active_tabField').val($(this).tabs('option','active'));
});

</script>