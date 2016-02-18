<?php $this->breadcrumbs=array(
	
	'Personalia' 	=> array('/site/personalia'),
	'Gaji dan Upah'	=> array('/site/gaji'),
	'Gaji Bulanan' 	=> array('/site/bulanan'),
	'Gaji Bulanan'  => array('/site/perhitungan'),
	'Pilih Proyek'	=> array('/site/potongan'),
	'Potongan'
); 

$url 	= Yii::app()->createUrl('personalia/TbPenggajian/kasbon?proyek='.$proyek); 
$url2 	= Yii::app()->createUrl('personalia/TbPenggajian/pph?proyek='.$proyek); 
$url3 	= Yii::app()->createUrl('personalia/TbPenggajian/bpjs?proyek='.$proyek);
$url4 	= Yii::app()->createUrl('personalia/TbPenggajian/rekapitulasi?proyek='.$proyek.'&action2=potongan');

?>

<table>
<tr>
	<td>
		<a href="<?php echo $url; ?>" class="link-button">Kasbon</a>
		&nbsp;
		<a href="<?php echo $url3; ?>" class="link-button">BPJS</a>
	</td>	
</tr>
	<td>
		<a href="<?php echo $url2; ?>" class="link-button">PPh</a>
		&nbsp;
		<a href="<?php echo $url4; ?>" class="link-button">Rekapitulasi</a>
	</td>	
<tr>
</tr>
</table>