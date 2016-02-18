<?php echo $form->textField($sakit,'NIK',array('value'=>$nik,'hidden'=>'true')); ?>

<table>
	<tr>
		<td rowspan="2">Tanggal</td>
		<td>
			<?php echo $form->dateField($sakit,'Tanggal_Awal'); ?>
			<?php echo $form->error($sakit,'Tanggal_Awal',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $form->dateField($sakit,'Tanggal_Akhir'); ?>
			<?php echo $form->error($sakit,'Tanggal_Akhir',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>Durasi Sakit</td>
		<td><input value="<?php echo $durasi_sakit; ?>" disabled></td>
	</tr>
	<tr>
		<td>Surat Dokter</td>
		<td>
			<?php echo $form->dropDownList($sakit,'Surat_Dokter',array('Ada'=>'Ada','Tidak'=>'Tidak')); ?>
			<?php echo $form->error($sakit,'Surat_Dokter',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
	<tr>
		<td>Alasan</td>
		<td>
			<?php echo $form->textArea($sakit,'Alasan'); ?>
			<?php echo $form->error($sakit,'Alasan',array('style'=>'color:#C00000;')); ?>
		</td>
	</tr>
</table>