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
			
			<?php echo $form->dateField($cuti,'Tanggal_Awal',$option); ?>

			<?php echo $form->error($cuti,'Tanggal_Awal',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php 
			$option	= array('id'=>'tanggal_akhirField');
			if($cuti->final==1) $option = array('id'=>'tanggal_akhirField','disabled'=>'true');			
			?>
			
			<?php echo $form->dateField($cuti,'Tanggal_Akhir',$option); ?>
			
			<?php echo $form->error($cuti,'Tanggal_Akhir',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>Durasi Cuti</td>
		<td><input value="<?php echo $durasi_cuti; ?>" disabled></td>
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
			<input value="<?php echo $Cuti_Terpakai; ?>" disabled>			
			<?php echo $form->textField($cuti,'Cuti_Terpakai',array('hidden'=>'true')); ?>
			<?php echo $form->error($cuti,'Cuti_Terpakai',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>Sisa Jatah Cuti</td>
		<td>
			<input value="<?php echo $Sisa_Cuti; ?>" disabled>						
			<?php echo $form->textField($cuti,'Sisa_Cuti',array('hidden'=>'true')); ?>
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