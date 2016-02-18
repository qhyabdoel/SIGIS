<?php 

Yii::app()->clientScript->registerCoreScript('jquery');

$url = Yii::app()->createUrl('personalia/TbKaryawan/surat');

$this->breadcrumbs = array(

	'Personalia' 			=> array('/site/personalia'),
	'Karyawan' 	 			=> array('/site/karyawan'),	
	'Administrasi Karyawan'	=> array('/personalia/TbKaryawan/administrasi'),

	'Cetak Surat Personalia'
); 

?>

<table>
	<tr>
		<th width="250px">NIK</th>
		<td>: <?php echo $nik; ?></td>
	</tr>
	<tr>
		<th>Jenis Surat</th>
		<td>: <?php echo $jenis; ?></td>
	</tr>
	<tr>
		<th>Departemen</th>
		<td>: <?php echo $departemen; ?></td>
	</tr>
	<tr>
		<th>Jabatan</th>
		<td>: <?php echo $jabatan; ?></td>
	</tr>
	<tr>
		<th>Bertanggung Jawab Kepada</th>
		<td>: <?php echo $tanggung_jawab; ?></td>
	</tr>
	<tr>
		<th>Periode</th>
		<td>: <?php echo $awal; ?> s/d <?php echo $akhir; ?></td>
	</tr>
</table>

<br>

<a class="small-button" href="<?php echo $url; ?>">Close</a>