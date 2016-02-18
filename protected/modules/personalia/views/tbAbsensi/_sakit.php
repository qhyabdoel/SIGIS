<?php 

echo $form->textField($sakit,'NIK',array('value'=>$nik,'hidden'=>'true')); 

$option = array(); 
if($sakit->final==1) $option = array('disabled'=>'true');

$url = Yii::app()->createUrl('personalia/suratSakit/show/id');

?>

<table>
	<tr>
		<td rowspan="2">Tanggal</td>
		<td>			
			<?php echo $form->dateField($sakit,'Tanggal_Awal',$option); ?>
			<?php echo $form->error($sakit,'Tanggal_Awal',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $form->dateField($sakit,'Tanggal_Akhir',$option); ?>
			<?php echo $form->error($sakit,'Tanggal_Akhir',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>Durasi Sakit</td>
		<td><input value="<?php echo $durasi_sakit; ?>" disabled></td>
	</tr>
	<tr>
		<td rowspan="2">Surat Dokter</td>
		<td><?php echo $form->fileField($surat,'image'); ?></td>
	</tr>
	<tr>
		<td>
			<?php 

			// echo '<a class="small-button" href="'.$url.'" target="_blank">Tampilkan</a>'; 
			echo CHtml::dropDownList('surat',0,$surats,array('id'=>'dropSurat'));

			?>
		</td>
	</tr>
	<tr>
		<td>Alasan</td>
		<td>
			<?php echo $form->textArea($sakit,'Alasan',$option); ?>
			<?php echo $form->error($sakit,'Alasan',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
</table>

<?php

foreach ($surats as $row) {
	?><?php	
}

?>

<input id="linkField" value="<?php echo $url; ?>" hidden>

<script>

$('#dropSurat').change(function(){
	url = $('#linkField').val()+'/'+$('#dropSurat').val();

	window.open(url,'_blank');
});

</script>