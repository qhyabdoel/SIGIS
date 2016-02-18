<?php echo $form->textField($lembur,'NIK',array('value'=>$nik,'hidden'=>'true')); ?>

<table>
	<tr>
		<td rowspan="2">Tanggal</td>
		<td>
			<?php 
			$option	= array('id'=>'tanggal_awalField');
			if($lembur->final==1) $option = array('id'=>'tanggal_awalField','disabled'=>'true');			
			?>
			<?php echo $form->dateField($lembur,'Tanggal_Awal',$option); ?>
			<?php echo $form->error($lembur,'Tanggal_Awal',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php 
			$option	= array('id'=>'tanggal_akhirField');
			if($lembur->final==1) $option = array('id'=>'tanggal_akhirField','disabled'=>'true');			
			?>
			<?php echo $form->dateField($lembur,'Tanggal_Akhir',$option); ?>
			<?php echo $form->error($lembur,'Tanggal_Akhir',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>

	<tr>
		<td>Jumlah Jam</td>
		<td>
			<?php 
				$enable = array('style'=>'width:50px;'); 
				if($role=='admin' or $lembur->final==1) $enable = array('style'=>'width:50px;','disabled'=>'true'); 
			?>
			<?php echo $form->textField($lembur,'Jumlah_Jam',$enable); ?>
			<?php echo $form->error($lembur,'Jumlah_Jam',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	
	<tr>
		<td>Persetujuan lembur</td>
		<td>
			<?php 
			$data 	= array('diproses'=>'diproses','disetujui'=>'disetujui','ditolak'=>'ditolak'); 
			$enable	= array();
			if($role=='admin' or $lembur->final==1) $enable = array('disabled'=>'true');			
			?>
			<?php echo $form->dropDownList($lembur,'Status',$data,$enable); ?>
			<?php echo $form->error($lembur,'Status',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
</table>