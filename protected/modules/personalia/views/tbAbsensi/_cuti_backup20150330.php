<?php echo $form->textField($cuti,'NIK',array('value'=>$nik,'hidden'=>'true')); ?>

<table>
	<tr>
		<td rowspan="2">Tanggal</td>
		<td>
			<?php 
			$option	= array('id'=>'tanggal_awalField');
			if($cuti->final==1){
				$option = array('id'=>'tanggal_awalField','disabled'=>'true');			
				echo $form->dateField($cuti,'Tanggal_Awal',array('hidden'=>'true'));
			}
			?>
			
			<?php

			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			    'model' 		=> $cuti,
			    'attribute' 	=> 'Tanggal_Awal',
			    'htmlOptions' 	=> $option
			));
			
			?>

			<?php echo $form->error($cuti,'Tanggal_Awal',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php 
			$option	= array('id'=>'tanggal_akhirField');
			if($cuti->final==1) $option = array('id'=>'tanggal_akhirField','disabled'=>'true');			
			?>
			
			<?php

			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			    'model' 		=> $cuti,
			    'attribute' 	=> 'Tanggal_Akhir',
			    'htmlOptions' 	=> $option
			));
			
			?>
			
			<?php echo $form->error($cuti,'Tanggal_Akhir',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>Total Jatah Cuti</td>
		<td>
			<input id="total_cutiField" value="12" disabled>
			<?php echo $form->textField($cuti,'Total_Cuti',array('value'=>'12','hidden'=>'true')); ?>
			<?php echo $form->error($cuti,'Total_Cuti',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>Cuti Terpakai</td>
		<td>
			<?php echo $form->textField($cuti,'Cuti_Terpakai',array('id'=>'cuti_terpakaiField3','disabled'=>'true','hidden'=>'true')); ?>
			<?php echo $form->textField($cuti,'Cuti_Terpakai',array('id'=>'cuti_terpakaiField2','disabled'=>'true')); ?>
			<?php echo $form->textField($cuti,'Cuti_Terpakai',array('id'=>'cuti_terpakaiField','hidden'=>'true')); ?>
			<?php echo $form->error($cuti,'Cuti_Terpakai',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>Sisa Jatah Cuti</td>
		<td>			
			<?php echo $form->textField($cuti,'Sisa_Cuti',array('id'=>'sisa_cutiField2','disabled'=>'true')); ?>
			<?php echo $form->textField($cuti,'Sisa_Cuti',array('id'=>'sisa_cutiField','hidden'=>'true')); ?>
			<?php echo $form->error($cuti,'Sisa_Cuti',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>	
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>Alasan Cuti</td>
		<td>
			<?php 
			$enable	= array();
			if($cuti->final==1) $enable = array('disabled'=>'true');			
			?>
			<?php echo $form->textArea($cuti,'Alasan_Cuti',$enable); ?>
			<?php echo $form->error($cuti,'Alasan_Cuti',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>Alamat Selama Cuti</td>
		<td>
			<?php 
			$enable	= array();
			if($cuti->final==1) $enable = array('disabled'=>'true');			
			?>
			<?php echo $form->textArea($cuti,'Alamat_Cuti',$enable); ?>
			<?php echo $form->error($cuti,'Alamat_Cuti',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>Persetujuan Cuti</td>
		<td>
			<?php 
			$data 	= array('diproses'=>'diproses','disetujui'=>'disetujui','ditolak'=>'ditolak'); 
			$enable	= array();
			if($role=='admin' or $cuti->final==1) $enable = array('disabled'=>'true');			
			?>
			<?php echo $form->dropDownList($cuti,'Status',$data,$enable); ?>
			<?php echo $form->error($cuti,'Status',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
</table>

<script>	

$('#tanggal_akhirField').change(function(){
	awal 			= $('#tanggal_awalField').val();
	date 			= new Date($(this).val());
	date2 			= new Date(awal);
	cuti_terpakai	= (date-date2)/86400000+1;
	total_cuti 		= $('#total_cutiField').val();		

	if(awal!=''){
		// cuti_terpakai 	= parseInt($('#cuti_terpakaiField3').val()) + (date-date2)/86400000+1;

		$('#cuti_terpakaiField').val(cuti_terpakai);
		$('#cuti_terpakaiField2').val(cuti_terpakai);
		$('#sisa_cutiField').val(total_cuti*1-cuti_terpakai*1);
		$('#sisa_cutiField2').val(total_cuti*1-cuti_terpakai*1);	
	}	
});

$('#tanggal_awalField').change(function(){			
	akhir 			= $('#tanggal_akhirField').val();
	date 			= new Date(akhir);
	date2 			= new Date($(this).val());
	cuti_terpakai	= (date-date2)/86400000+1;	
	total_cuti 		= $('#total_cutiField').val();		

	if(akhir!=''){
		// cuti_terpakai 	= parseInt($('#cuti_terpakaiField3').val()) + (date-date2)/86400000+1;
		
		$('#cuti_terpakaiField').val(cuti_terpakai);
		$('#cuti_terpakaiField2').val(cuti_terpakai);
		$('#sisa_cutiField').val(total_cuti*1-cuti_terpakai*1);
		$('#sisa_cutiField2').val(total_cuti*1-cuti_terpakai*1);
	}	
});

// $('#tanggal_akhirField2').change(function(){		
// 	date 			= new Date($(this).val());
// 	date2 			= new Date($('#tanggal_awalField2').val());
// 	lama_ijin 		= (date-date2)/86400000+1;
// 	ijin_bulanan	= $('#ijin_bulananField').val();

// 	$('#lama_ijinField').val(lama_ijin);
// 	$('#lama_ijinField2').val(lama_ijin);
// 	$('#total_ijin_bulananField').val(ijin_bulanan*1+lama_ijin*1);
// 	$('#total_ijin_bulananField2').val(ijin_bulanan*1+lama_ijin*1);
// });

// $('#tanggal_awalField2').change(function(){			
// 	date 			= new Date($('#tanggal_akhirField2').val());
// 	date2 			= new Date($(this).val());
// 	lama_ijin 		= (date-date2)/86400000+1;
// 	ijin_bulanan	= $('#ijin_bulananField').val();

// 	$('#lama_ijinField').val(lama_ijin);
// 	$('#lama_ijinField2').val(lama_ijin);
// 	$('#total_ijin_bulananField').val(ijin_bulanan*1+lama_ijin*1);
// 	$('#total_ijin_bulananField2').val(ijin_bulanan*1+lama_ijin*1);
// });

$(function() {
	$( "#tanggal_akhirField" ).datepicker({
		beforeShowDay: $.datepicker.noWeekends
	});
});

$(function() {
	$( "#tanggal_awalField" ).datepicker({
		beforeShowDay: $.datepicker.noWeekends
	});
});

</script>