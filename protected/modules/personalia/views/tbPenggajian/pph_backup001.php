<?php $this->breadcrumbs=array(
	
	'Personalia' 	=> array('/site/personalia'),
	'Gaji dan Upah'	=> array('/site/gaji'),
	'Gaji Bulanan' 	=> array('/site/bulanan'),
	'Pilih Proyek'	=> array('/site/potongan'),
	'Potongan'      => array('/personalia/TbPenggajian/potongan?proyek='.$proyek),

	'Pph'
);

$url 	= Yii::app()->createUrl('personalia/TbKetentuanPph/create?proyek='.$proyek);
$url2 	= Yii::app()->createUrl('personalia/TbPenggajian/perhitungan?proyek='.$proyek); ?>

<table>
<tr>
	<td><a href="<?php echo $url; ?>" class="link-button">Input Ketentuan Pajak</a></td>	
</tr>
<tr>
	<td><a href="<?php echo $url2; ?>" class="link-button">Perhitungan</a></td>
</tr>
</table>