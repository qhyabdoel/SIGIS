<?php echo $form->textField($terlambat,'NIK',array('value'=>$nik,'hidden'=>'true')); ?>

<table>
	<tr>
		<td rowspan="2">Tanggal</td>
		<td>
			<?php echo $form->dateField($terlambat,'Tanggal_Awal',array('id'=>'tanggal_awalField3')); ?>
			<?php echo $form->error($terlambat,'Tanggal_Awal',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $form->dateField($terlambat,'Tanggal_Akhir',array('id'=>'tanggal_akhirField3')); ?>
			<?php echo $form->error($terlambat,'Tanggal_Akhir',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>Ijin di Bulan Yang Sama</td>		
		<td>
			<?php echo $form->textField($terlambat,'Terlambat_Bulanan',array('value'=>$lama_terlambats_sum,'disabled'=>'true')); ?>
			<?php echo $form->textField($terlambat,'Terlambat_Bulanan',array('value'=>$lama_terlambats_sum,'hidden'=>'true')); ?>
			<?php echo $form->error($terlambat,'Terlambat_Bulanan',array('style'=>'color:#C00000;')); ?>			
		</td>
	</tr>
	<tr>
		<td>Lama Ijin</td>
		<td>
			<?php echo $form->textField($terlambat,'Lama_Terlambat',array('id'=>'lama_terlambatField2','disabled'=>'true')); ?>
			<?php echo $form->textField($terlambat,'Lama_Terlambat',array('id'=>'lama_terlambatField','hidden'=>'true')); ?>
			<?php echo $form->error($terlambat,'Lama_Terlambat',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>Total Ijin di Bulan Yang Sama</td>
		<td>			
			<?php echo $form->textField($terlambat,'Total_Terlambat_Bulanan',array('disabled'=>'true','id'=>'total_terlambat_bulananField2','value'=>12)); ?>
			<?php echo $form->textField($terlambat,'Total_Terlambat_Bulanan',array('hidden'=>'true','id'=>'total_terlambat_bulananField','value'=>12)); ?>
			<?php echo $form->error($terlambat,'Total_Terlambat_Bulanan',array('style'=>'color:#C00000;')); ?>			
		</td>
	</tr>	
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>Alasan terlambat</td>		
		<td>
			<?php echo $form->textArea($terlambat,'Alasan'); ?>
			<?php echo $form->error($terlambat,'Alasan',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>	
</table>

<script>

// $('#tanggal_akhirField3').change(function(){			
// 	date 				= new Date($(this).val());
// 	date2 				= new Date($('#tanggal_awalField3').val());
// 	lama_terlambat 		= (date-date2)/86400000+1;
// 	terlambat_bulanan	= $('#terlambat_bulananField').val();

// 	$('#lama_terlambatField').val(lama_terlambat);
// 	$('#lama_terlambatField2').val(lama_terlambat);
// 	$('#total_terlambat_bulananField').val(terlambat_bulanan*1+lama_terlambat*1);
// 	$('#total_terlambat_bulananField2').val(terlambat_bulanan*1+lama_terlambat*1);
// });

// $('#tanggal_awalField3').change(function(){			
// 	date 				= new Date($('#tanggal_akhirField3').val());
// 	date2 				= new Date($(this).val());
// 	lama_terlambat 		= (date-date2)/86400000+1;
// 	terlambat_bulanan	= $('#terlambat_bulananField').val();

// 	$('#lama_terlambatField').val(lama_terlambat);
// 	$('#lama_terlambatField2').val(lama_terlambat);
// 	$('#total_terlambat_bulananField').val(terlambat_bulanan*1+lama_terlambat*1);
// 	$('#total_terlambat_bulananField2').val(terlambat_bulanan*1+lama_terlambat*1);
// });

</script>