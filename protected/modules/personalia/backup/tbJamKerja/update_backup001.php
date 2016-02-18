<?php 

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs = array(
    'Personalia' 			=> array('/site/personalia'),
	'Gaji dan Upah'			=> array('/site/gaji'),
	'Gaji Bulanan' 			=> array('/site/bulanan'),
	'Gaji Bulanan' 			=> array('/site/perhitungan'),
	'Absensi' 				=> array('/site/absensi'),
	'Report Absensi' 		=> array('/site/report_absensi'),
	'Absensi per Karyawan' 	=> array('/personalia/TbAbsensi/per_karyawan?'.$url),
	'Jam Kerja' 			=> array('index?'.$url),
	'Edit Jam Kerja'
);

$url 	= Yii::app()->createUrl('personalia/TbJamKerja/index?'.$url);

?>

<div align="center" class="form">

<?php $form = $this->beginWidget('CActiveForm', array('id'=>'tb-jam_kerja-form','enableAjaxValidation'=>false));  ?>

<table style="width:400px;">
	<tr>
		<td width="100px">Nama</td>
		<td>
			<?php echo $form->textField($jam_kerja,'name'); ?>
			<?php echo $form->error($jam_kerja,'name'); ?>
		</td>
	</tr>
	<tr>
		<td width="100px">Jam Kerja</td>
		<td>
			<?php echo $form->timeField($jam_kerja,'awal'); ?> - <?php echo $form->timeField($jam_kerja,'akhir'); ?>
			<?php echo $form->error($jam_kerja,'awal'); ?>
			<?php echo $form->error($jam_kerja,'akhir'); ?>
		</td>
	</tr>
	<tr><td></td></tr>
	<tr>
		<td></td>		
		<td>
			<a class="small-button" href="#" id="linkButtonUpdate">Update</a>
			<a class="small-button" href="<?php echo $url; ?>">Close</a>
		</td>
	</tr>
</table>


<input name="id" value="<?php echo $jam_kerja->id; ?>" hidden>
<input name="nik" value="<?php echo $datas['nik']; ?>" hidden>
<input name="awal" value="<?php echo $datas['awal']; ?>" hidden>
<input name="akhir" value="<?php echo $datas['akhir']; ?>" hidden>

<input name="action" id="fieldAction" hidden>

<button id="buttonSubmit" hidden></button>

<?php $this->endWidget(); ?>

</div>

<script>

$('#linkButtonUpdate').click(function(){
	$('#fieldAction').val('update');
	$('#buttonSubmit').click();
});

</script>