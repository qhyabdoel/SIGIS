<?php echo $form->textField($cuti,'NIK',array('value'=>$nik,'hidden'=>'true')); ?>

<table>
	<tr>
		<td rowspan="2">Tanggal</td>
		<td>
			<?php echo $form->dateField($cuti,'Tanggal_Awal',array('id'=>'tanggal_awalField')); ?>
			<?php echo $form->error($cuti,'Tanggal_Awal',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $form->dateField($cuti,'Tanggal_Akhir',array('id'=>'tanggal_akhirField')); ?>
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
			<?php echo $form->textArea($cuti,'Alasan_Cuti'); ?>
			<?php echo $form->error($cuti,'Alasan_Cuti',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>Alamat Selama Cuti</td>
		<td>
			<?php echo $form->textArea($cuti,'Alamat_Cuti'); ?>
			<?php echo $form->error($cuti,'Alamat_Cuti',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>Persetujuan Cuti</td>
		<td>
			<?php 
			$data 	= array('diproses'=>'diproses','disetujui'=>'disetujui','ditolak'=>'ditolak'); 
			$enable	= array();
			if($role=='admin') $enable = array('disabled'=>'true');			
			?>
			<?php echo $form->dropDownList($cuti,'Status',$data,$enable); ?>
			<?php echo $form->error($cuti,'Status',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
</table>

<script>	

$('#tanggal_akhirField').change(function(){
	date 			= new Date($(this).val());
	date2 			= new Date($('#tanggal_awalField').val());
	total_cuti 		= $('#total_cutiField').val();
	cuti_terpakai 	= (date-date2)/86400000+1;

	$('#cuti_terpakaiField').val(cuti_terpakai);
	$('#cuti_terpakaiField2').val(cuti_terpakai);
	$('#sisa_cutiField').val(total_cuti-cuti_terpakai);
	$('#sisa_cutiField2').val(total_cuti-cuti_terpakai);
});

$('#tanggal_awalField').change(function(){			
	date 			= new Date($('#tanggal_akhirField3').val());
	date2 			= new Date($(this).val());
	total_cuti 		= $('#total_cutiField').val();
	cuti_terpakai 	= (date-date2)/86400000+1;

	$('#cuti_terpakaiField').val(cuti_terpakai);
	$('#cuti_terpakaiField2').val(cuti_terpakai);
	$('#sisa_cutiField').val(total_cuti-cuti_terpakai);
	$('#sisa_cutiField2').val(total_cuti-cuti_terpakai);
});

</script>