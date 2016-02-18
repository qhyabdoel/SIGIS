<?php
/* @var $this SiteController */

$this->pageTitle 	= Yii::app()->name;
$url 				= Yii::app()->createUrl('site/perhitungan');
$url2 				= Yii::app()->createUrl('personalia/TbPenggajian/input');
$url3 				= Yii::app()->createUrl('personalia/TbPenggajian/'.$state);

if($state=='potongan' or $state=='pendapatan'){
	$this->breadcrumbs=array(	
		'Personalia' 	=> array('personalia'),
		'Gaji dan Upah'	=> array('gaji'),
		'Gaji Bulanan' 	=> array('bulanan'),
		'Gaji Bulanan' 	=> array('perhitungan'),
		'Pilih Proyek'
	);
}
else{
	$this->breadcrumbs=array(	
		'Personalia' 	=> array('personalia'),
		'Gaji dan Upah'	=> array('gaji'),
		'Gaji Bulanan' 	=> array('bulanan'),	
		'Pilih Proyek'
	);	
}

if($state=='potongan'){

?>

<br><br>

<a href="<?php echo $url3; ?>?proyek=SIB" class="link-button">SIB</a>
&nbsp;
<a href="#" class="link-button">SIL</a>
&nbsp;
<a href="#" class="link-button">PR</a>

<br><br>

<a href="#" class="link-button">DMR</a>
&nbsp;
<a href="#" class="link-button">D'LAPAN</a>
&nbsp;
<a href="#" class="link-button">SML</a>

<br><br>

<a href="#" class="link-button">Tambah Proyek</a>
&nbsp;
<a href="#" class="link-button">....</a>
&nbsp;
<a href="#" class="link-button">....</a>

<?php

}
else{

?>

<br><br>

<a href="<?php echo $url3; ?>?proyek=SIB" class="link-button">SIB</a>
&nbsp;
<a href="<?php echo $url3; ?>?proyek=SIL" class="link-button">SIL</a>
&nbsp;
<a href="<?php echo $url3; ?>?proyek=PR" class="link-button">PR</a>

<br><br>

<a href="<?php echo $url3; ?>?proyek=DMR" class="link-button">DMR</a>
&nbsp;
<a href="<?php echo $url3; ?>?proyek=D'LAPAN" class="link-button">D'LAPAN</a>
&nbsp;
<a href="<?php echo $url3; ?>?proyek=SML" class="link-button">SML</a>

<br><br>

<a href="#" class="link-button">Tambah Proyek</a>
&nbsp;
<a href="#" class="link-button">....</a>
&nbsp;
<a href="#" class="link-button">....</a>

<?php

}