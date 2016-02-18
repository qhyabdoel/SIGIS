<?php echo $form->textField($keluarkota,'NIK',array('value'=>$nik,'hidden'=>'true')); ?>

<table>
	<tr>
		<td rowspan="2">Tanggal</td>
		<td>
			<?php 
			$option	= array('id'=>'tanggal_awalField');
			//if($keluarkota->final==1) $option = array('id'=>'tanggal_awalField','disabled'=>'true');			
			?>
			<?php echo $form->dateField($keluarkota,'Tanggal_Awal',$option); ?>
			<?php echo $form->error($keluarkota,'Tanggal_Awal',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php 
			$option	= array('id'=>'tanggal_akhirField');
			if($keluarkota->final==1) $option = array('id'=>'tanggal_akhirField','disabled'=>'true');			
			?>
			<?php echo $form->dateField($keluarkota,'Tanggal_Akhir',$option); ?>
			<?php echo $form->error($keluarkota,'Tanggal_Akhir',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>	
	<tr>
		<td>Alasan Keperluan Keluar Kota</td>
		<td>
			<?php 
			$enable	= array();
			if($keluarkota->final==1) $enable = array('disabled'=>'true');			
			?>
			<?php echo $form->textArea($keluarkota,'Alasan_Keperluan_luar_kota',$enable); ?>
			<?php echo $form->error($keluarkota,'Alasan_Keperluan_luar_kota',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>Persetujuan Keluar Kota</td>
		<td>
			<?php 
			$data 	= array('diproses'=>'diproses','disetujui'=>'disetujui','ditolak'=>'ditolak'); 
			$enable	= array();
			if($role=='admin' or $keluarkota->final==1) $enable = array('disabled'=>'true');			
			?>
			<?php echo $form->dropDownList($keluarkota,'Status',$data,$enable); ?>
			<?php echo $form->error($keluarkota,'Status',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
</table>