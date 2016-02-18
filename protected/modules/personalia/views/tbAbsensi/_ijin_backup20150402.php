<?php echo $form->textField($ijin,'NIK',array('value'=>$nik,'hidden'=>'true')); ?>

<table>
	<tr>
		<td rowspan="2">Tanggal</td>
		<td>
			<?php 
			$option = array('id'=>'tanggal_awalField2');
			if($ijin->final==1){
				$option = array('id'=>'tanggal_awalField2','disabled'=>'true');
				echo $form->dateField($ijin,'Tanggal_Awal',array('hidden'=>'true'));
			}
			?>
			<?php echo $form->dateField($ijin,'Tanggal_Awal',$option); ?>			
			<?php echo $form->error($ijin,'Tanggal_Awal',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php 
			$option = array('id'=>'tanggal_akhirField2');
			if($ijin->final==1) $option = array('id'=>'tanggal_ahirField2','disabled'=>'true');
			?>
			<?php echo $form->dateField($ijin,'Tanggal_Akhir',$option); ?>
			<?php echo $form->error($ijin,'Tanggal_Akhir',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>Ijin di Bulan Yang Sama</td>		
		<td>
			<input id="ijin_bulananField" value="<?php echo $lama_ijins_sum; ?>" disabled>
			<?php echo $form->textField($ijin,'Ijin_Bulanan',array('value'=>$lama_ijins_sum,'hidden'=>'true')); ?>
			<?php echo $form->error($ijin,'Ijin_Bulanan',array('style'=>'color:#C00000;')); ?>			
		</td>
	</tr>
	<tr>
		<td>Lama Ijin</td>
		<td>
			<?php echo $form->textField($ijin,'Lama_Ijin',array('id'=>'lama_ijinField2','disabled'=>'true')); ?>
			<?php echo $form->textField($ijin,'Lama_Ijin',array('id'=>'lama_ijinField','hidden'=>'true')); ?>
			<?php echo $form->error($ijin,'Lama_Ijin',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>Total Ijin di Bulan Yang Sama</td>
		<td>			
			<?php echo $form->textField($ijin,'Total_Ijin_Bulanan',array('disabled'=>'true','id'=>'total_ijin_bulananField2')); ?>
			<?php echo $form->textField($ijin,'Total_Ijin_Bulanan',array('hidden'=>'true','id'=>'total_ijin_bulananField')); ?>
			<?php echo $form->error($ijin,'Total_Ijin_Bulanan',array('style'=>'color:#C00000;')); ?>			
		</td>
	</tr>	
	<tr>
		<td></td>
		<td></td>
	</tr>
	<?php 
		$option = array();
		if($ijin->final==1) $option = array('disabled'=>'true');
	?>
	<tr>
		<td>Alasan Ijin</td>		
		<td>			
			<?php echo $form->textArea($ijin,'Alasan_Ijin',$option); ?>
			<?php echo $form->error($ijin,'Alasan_Ijin',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>Alamat Selama ijin</td>		
		<td>
			<?php echo $form->textArea($ijin,'Alamat_Ijin',$option); ?>
			<?php echo $form->error($ijin,'Alamat_Ijin',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>Persetujuan Cuti</td>
		<td>
			<?php 
			$data 	= array('diproses'=>'diproses','disetujui'=>'disetujui','ditolak'=>'ditolak'); 
			$enable	= array();
			if($role=='admin' or $ijin->final==1) $enable = array('disabled'=>'true');			
			?>
			<?php echo $form->dropDownList($ijin,'Status',$data,$enable); ?>
			<?php echo $form->error($ijin,'Status',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
</table>

<script>

$('#tanggal_akhirField2').change(function(){		
	date 			= new Date($(this).val());
	date2 			= new Date($('#tanggal_awalField2').val());
	lama_ijin 		= (date-date2)/86400000+1;
	ijin_bulanan	= $('#ijin_bulananField').val();

	$('#lama_ijinField').val(lama_ijin);
	$('#lama_ijinField2').val(lama_ijin);
	$('#total_ijin_bulananField').val(ijin_bulanan*1+lama_ijin*1);
	$('#total_ijin_bulananField2').val(ijin_bulanan*1+lama_ijin*1);
});

$('#tanggal_awalField2').change(function(){			
	date 			= new Date($('#tanggal_akhirField2').val());
	date2 			= new Date($(this).val());
	lama_ijin 		= (date-date2)/86400000+1;
	ijin_bulanan	= $('#ijin_bulananField').val();

	$('#lama_ijinField').val(lama_ijin);
	$('#lama_ijinField2').val(lama_ijin);
	$('#total_ijin_bulananField').val(ijin_bulanan*1+lama_ijin*1);
	$('#total_ijin_bulananField2').val(ijin_bulanan*1+lama_ijin*1);
});

</script>