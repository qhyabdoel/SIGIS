<?php Yii::app()->clientScript->registerCoreScript('jquery');

// echo "<pre>";
// print_r($ptkps);
// echo "</pre>";

$baseUrl    = Yii::app()->baseUrl; 
$cs         = Yii::app()->getClientScript();

$cs->registerScriptFile($baseUrl.'/js/mask_money.js');

$ketentuan_pph->batas_take_home_pay_1 = number_format($ketentuan_pph->batas_take_home_pay_1,0,"",".");
$ketentuan_pph->batas_take_home_pay_2 = number_format($ketentuan_pph->batas_take_home_pay_2,0,"",".");

$this->breadcrumbs=array(	
	'Personalia' 	=> array('/site/personalia'),
	'Gaji dan Upah'	=> array('/site/gaji'),
	'Gaji Bulanan' 	=> array('/site/bulanan'),
	'Gaji Bulanan'  => array('/site/perhitungan'),
	'Pilih Proyek'	=> array('/site/potongan'),
	'Potongan'		=> array('/personalia/TbPenggajian/potongan?proyek='.$proyek),
	'Pph'			=> array('/personalia/TbPenggajian/pph?proyek='.$proyek),

	'Ketentuan Pajak'
); 

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}

$form = $this->beginWidget('CActiveForm', array('id'=>'tb-ketentuan_pph-form','enableAjaxValidation'=>false,)); ?>

<h3>TARIF</h3>
<table>
	<tr>
		<td width="120px">Take Home Pay</td>
		<td width="210px">
			<div class="row">
			<input disabled="true" value="<=" style="width:20px;">
			&nbsp; Rp <?php echo $form->textField($ketentuan_pph,'batas_take_home_pay_1',array('id'=>'fieldTake_home_pay_1','style'=>'width:140px')); ?>
			<?php echo $form->error($ketentuan_pph,'batas_take_home_pay_1',array('style'=>'color:#C00000;')); ?>
			</div>
		</td>
		<td>
			:&nbsp;
			<?php echo $form->textField($ketentuan_pph,'persentase_tarif_1',array('style'=>'width:50px')); 
			?><input disabled="true" value="%" style="width:20px;">
			<?php echo $form->error($ketentuan_pph,'persentase_tarif_1',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td width="100px">Take Home Pay</td>
		<td width="210px">
			<input disabled="true" value="<=" style="width:20px;">
			&nbsp; Rp <?php 
			echo $form->textField($ketentuan_pph,'batas_take_home_pay_2',array(
				'id'=>'fieldTake_home_pay_2','style'=>'width:140px;')); 
			?>
			<?php echo $form->error($ketentuan_pph,'batas_take_home_pay_2',array('style'=>'color:#C00000;')); ?>
		</td>
		<td>
			:&nbsp;
			<?php echo $form->textField($ketentuan_pph,'persentase_tarif_2',array('style'=>'width:50px')); 
			?><input disabled="true" value="%" style="width:20px;">
			<?php echo $form->error($ketentuan_pph,'persentase_tarif_2',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td width="100px">Take Home Pay</td>
		<td width="210px">
			<input disabled="true" value=">=" style="width:20px;">
			&nbsp; Rp <input id="fieldTake_home_pay_3" style="width:140px;" value="<?php echo $ketentuan_pph->batas_take_home_pay_2; ?>" disabled>
		</td>
		<td>
			:&nbsp;
			<?php echo $form->textField($ketentuan_pph,'persentase_tarif_3',array('style'=>'width:50px')); 
			?><input disabled="true" value="%" style="width:20px;">
			<?php echo $form->error($ketentuan_pph,'persentase_tarif_3',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td width="100px"></td>
		<td width="210px">
			Tidak punya NPWP
		</td>
		<td>
			:&nbsp;
			<?php echo $form->textField($ketentuan_pph,'persentase_tarif_4',array('style'=>'width:50px')); 
			?><input disabled="true" value="%" style="width:20px;">
			<?php echo $form->error($ketentuan_pph,'persentase_tarif_4',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
</table>

<br>

<h3>PTKP</h3>
<table>
	<?php 

	$index = 0;	

	foreach ($ptkps as $ptkp){		

	$error = $ptkp_tarif_errors[$ptkp->id];

	if($error==''){
		$input_error_style = '';	
	}
	else $input_error_style = 'background:#FEE;border-color:#C00;';
	
	?>

	<tr>
		<td width="20px">
			<?php echo $ptkp->status; 
			$ptkp->tarif = number_format($ptkp->tarif,0,"","."); ?>
		</td>
		<td width="210px">			
			Rp <input name="ptkp2s[<?php echo $index; ?>][tarif]" value="<?php echo $ptkp->tarif; ?>" class="maskPtkp" style="<?php echo $input_error_style; ?>">
			<input name="ptkp2s[<?php echo $index; ?>][id]" value="<?php echo $ptkp->id; ?>" hidden>
			<span colspan="3" style="color:#C00000;" id="errorCell"><?php echo $error; ?></span>
		</td>
	</tr>

	<?php

	$index++;

	}

	?>

</table>

<button id="buttonSubmit" hidden></button>

<?php $this->endWidget(); ?>

<br>

<a class="small-button" href="#" id="linkButtonSubmit">Submit</a>

<script>

$('#fieldTake_home_pay_1').maskMoney();
$('#fieldTake_home_pay_2').maskMoney();

$('.maskPtkp').maskMoney();

// $('#fieldTake_home_pay_2').keypress.maskMoney(function(){
// 	alert('ok');
// 	$('#fieldTake_home_pay_3').val($(this).val());
// });

$('#linkButtonSubmit').click(function(){
	$('#fieldTake_home_pay_3').val($('#fieldTake_home_pay_2').val());
	$('#buttonSubmit').click();
});

</script>