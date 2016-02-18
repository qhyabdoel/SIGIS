<?php
/* @var $this SiteController */

Yii::app()->clientScript->registerCoreScript('jquery');

$this->pageTitle 	= Yii::app()->name;
$url 				= Yii::app()->createUrl('site/perhitungan');
$url2 				= Yii::app()->createUrl('personalia/TbPenggajian/input');
$url3 				= Yii::app()->createUrl('personalia/TbPenggajian/'.$state);
$url4 				= Yii::app()->createUrl('personalia/TbPenggajian/edit_proyek?from='.$state);

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

$manual2 = 'false';
if(isset($manual)) $manual2 = $manual;

?>



<?php

$count 	= 0;

foreach ($proyeks as $proyek){
	$count++;

	if($proyek=='Tambah Proyek'){		
		?><a href="#" class="link-button" id="linkTambahProyek"><?php echo $proyek; ?></a><?php
	}	
	elseif($proyek=='Edit Proyek'){
		?><a href="<?php echo $url4; ?>" class="link-button" id="linkEditProyek"><?php echo $proyek; ?></a><?php
	}	
	else{
		?><a href="<?php echo $url3.'?proyek='.$proyek.'&manual='.$manual2; ?>" class="link-button"><?php echo $proyek; ?></a><?php
	}
	
	echo "&nbsp;";
	
	$count_mod = $count%3;

	if($count_mod==0) echo "<br><br>";
}

?>

<?php $this->renderPartial('personalia.views.tbPenggajian._proyek'); ?>

<script>

$('#linkTambahProyek').click(function(){
	$('#proyekDiv').fadeToggle('fast');	
});

$('#closeProyek').click(function(){
	$('#proyekDiv').fadeToggle('fast');
});

$('#buttonProyek').click(function(){
    url     = $('#urlTambah').val();
    name    = $('#nameInput').val();
    wage    = $('#wageInput').val();

    $.post(url,{name:name,wage:wage},function(json){
        // alert(json);

        location.reload();
    });

// window.location.href = url;
});

</script>