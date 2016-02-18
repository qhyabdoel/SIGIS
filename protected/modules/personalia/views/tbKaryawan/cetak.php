<?php Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs = array(

	'Personalia' 			=> array('/site/personalia'),
	'Karyawan' 	 			=> array('/site/karyawan'),	
	'Administrasi Karyawan'	=> array('/personalia/TbKaryawan/administrasi'),

	'Cetak Surat Personalia'
); 

$departemen 	= '';
$jabatan 		= '';

if($nik!=0){
	$karyawan 	= TbKaryawan::model()->findByAttributes(array('NIK_Absen'=>$nik));
	$departemen = $karyawan->departemen->Nama_Department;
	$jabatan 	= $karyawan->jabatan->Nama_Jabatan;
}

?>

<form action="surat" method="post">

<table>
	<tr>
		<th>NIK</th>
		<td><?php echo CHtml::dropDownList('nik',$nik,$niks,array('style'=>'width:200px','id'=>'dropDownNIK')); ?></td>
	</tr>
	<tr>
		<th>Jenis Surat</th>
		<td>
			<?php echo CHtml::dropDownList(
				'jenis',
				$jenis,
				array(
					'Surat Tugas Karyawan'=>'Surat Tugas Karyawan',
					'Kontrak Karyawan'=>'Kontrak Karyawan',
					'Pengangakatan Kary. Tetap'=>'Pengangakatan Kary. Tetap',
				),				
				array('style'=>'width:200px')
			); ?>
		</td>
	</tr>
	<tr>
		<th>Departemen</th>
		<td>
			<input style="width:200px;" value="<?php echo $departemen; ?>" disabled>
			<input style="width:200px;" name="departemen" value="<?php echo $departemen; ?>" hidden>
		</td>
	</tr>
	<tr>
		<th>Jabatan</th>
		<td>
			<input style="width:200px;" value="<?php echo $jabatan; ?>" disabled>
			<input style="width:200px;" name="jabatan" value="<?php echo $jabatan; ?>" hidden>
		</td>
	</tr>
	<tr>
		<th>Bertanggung Jawab Kepada</th>
		<td>
			<?php echo CHtml::dropDownList(
				'tanggung_jawab',
				$tanggung_jawab,
				array('None'=>'None','SPV'=>'SPV','MGR'=>'MGR','DIR'=>'DIR'),				
				array('style'=>'width:200px')
			); ?>
		</td>
	</tr>
	<tr>
		<th>Periode</th>
		<td>
			<input name="awal" type="date" value="<?php echo $awal; ?>">
			&nbsp;
			<input name="akhir" type="date" value="<?php echo $akhir; ?>">
		</td>
	</tr>
</table>

<input name="action" id="actionField" hidden>

<button id="submitButton" hidden="true"></button>

</form>

<br>

<a class="small-button" id="submitButtonLink" href="#">Preview</a>

<div class="overlay" id="popDiv" style="display: none;">		
	<div class="wrapper">		
		<div class="content">		
			<a class="close" id="closePop">x</a>		
			<br><br>
			<h5 class="red-text">DRAFT SURAT SUDAH UNTUK KARYAWAN YANG DIMAKSUD</h5>

			<br>

			<a class="small-button" href="#" id="buttonSave">Save</a>
			<a class="small-button" href="#">Print</a>
			<a class="small-button" href="#" id="buttonClosePop">Close</a>
		</div>		
	</div>
</div>

<script>

	$('#submitButtonLink').click(function(){
		$('#popDiv').fadeToggle('fast');
	});

	$('#closePop').click(function(){
		$('#popDiv').fadeToggle('fast');
	});

	$('#dropDownNIK').change(function(){
		$('#submitButton').click();
	});

	$('#buttonClosePop').click(function(){
		$('#popDiv').fadeToggle('fast');
	});

	$('#buttonSave').click(function(){
		$('#actionField').val('save');
		$('#submitButton').click();
	});

</script>