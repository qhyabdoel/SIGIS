<?php 

// echo "<pre>";
// print_r($karyawan);
// echo "</pre>";

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(	
	'Personalia'      => array('/site/personalia'),
	'Gaji dan Upah'   => array('/site/gaji'),
	'Gaji Bulanan'    => array('/site/bulanan'),
	'Gaji Bulanan'    => array('/site/perhitungan'),
	'Pilih Proyek'    => array('/site/pendapatan'),
	'Pendapatan'
);

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}

$url = Yii::app()->createUrl('site/pendapatan?manual=');

?>

<?php $form = $this->beginWidget('CActiveForm', array('id'=>'pendapatan_manual-form','enableAjaxValidation'=>false)); ?>

<input name="action" id="actionField" hidden="true" value="search">

<table>
	<?php echo $form->textField($data_absen,'Nik',array('hidden'=>'true','value'=>$karyawan->NIK_Absen)); ?>
	<?php echo $form->textField($data_absen,'Nama',array('hidden'=>'true','value'=>$karyawan->Nama)); ?>
	
	<tr>
		<td>NIK</td>
		<td>
			<input name="nik" value="<?php echo $karyawan->NIK_Absen; ?>"> &nbsp;			
			<a href="#" class="small-button" id="buttonLinkSearch">Search</a>
		</td>
	</tr>
	<tr>
		<td>Periode</label></td>
		
		<td>		
		
		<?php echo $form->dateField($data_absen,'awal',array('id'=>'awalField')); ?> 
		- 
		<?php echo $form->dateField($data_absen,'akhir',array('id'=>'akhirField')); ?>		
		
		</td>
	</tr>
	<tr>
		<td>Nama</td>
		<td><input value="<?php echo $karyawan->Nama; ?>" disabled></td>
	</tr>		
	<tr>
		<td>Jumlah Kehadiran</td>
		<td>			
			<?php echo $form->textField($data_absen,'Kehadiran_Kary',array('style'=>'width:50px')); ?>
			<?php echo $form->error($data_absen,'Kehadiran_Kary',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>Jumlah Lembur</td>
		<td>			
			<?php echo $form->textField($data_absen,'Jumlah_Lembur',array('style'=>'width:50px')); ?>			
			x Rp <?php echo number_format($karyawan->ketentuan->lembur,0,'','.'); ?>
			<?php echo $form->error($data_absen,'Jumlah_Lembur',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>Jumlah Keterlambatan</td>
		<td>			
			<?php echo $form->textField($data_absen,'Jumlah_Keterlambatan',array('style'=>'width:50px')); ?>			
			x Rp <?php echo number_format($karyawan->ketentuan->keterlambatan,0,'','.'); ?>
			<?php echo $form->error($data_absen,'Jumlah_Keterlambatan',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>Jumlah Dinas Luar Kota</td>
		<td>			
			<?php echo $form->textField($data_absen,'Jumlah_DLK',array('style'=>'width:50px')); ?>			
			x Rp <?php echo number_format($karyawan->ketentuan->lembur_luarkota,0,'','.'); ?>
			<?php echo $form->error($data_absen,'Jumlah_DLK',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
</table>

<button id="buttonSubmit" hidden></button>

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

</script>