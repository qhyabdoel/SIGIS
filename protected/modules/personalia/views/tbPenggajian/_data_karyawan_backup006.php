<table>
	<tr>
		<td width="300px">Nama</td>
		<td><input name="nama" value="<?php echo $nama; ?>" disabled></td>
	</tr>		
</table>

<table>
	<tr>
		<td width="300px">Departemen</td>
		<td><input name="departemen" value="<?php echo $departemen; ?>" disabled></td>
	</tr>
	<tr>
		<td>Jabatan</td>
		<td><input name="jabatan" value="<?php echo $jabatan; ?>" disabled></td>
	</tr>
	<tr>
		<td>Masa Kerja</td>
		<td><input name="masa_kerja" value="<?php echo $masa_kerja; ?>" disabled></td>
	</tr>
	<tr>
		<td>Plafond Kasbon</td>
		<td><input name="plafond_kasbon" value="<?php echo $plafond_kasbon; ?>" id="plafond_kasbonField" disabled></td>
	</tr>
</table>

<table>
	<tr>
		<td width="300px">Pengajuan Kasbon</td>
		<td>
			<!-- <input name="pengajuan_kasbon" value="<?php $pengajuan_kasbon; ?>" id="pengajuan_kasbonField"> -->
			<?php 
			echo $form->textField($kasbon,'pengajuan_kasbon',array('id'=>'pengajuan_kasbonField')); 
			echo $form->error($kasbon,'pengajuan_kasbon',array('style'=>'color:#C00000;')); 
			?>
		</td>
	</tr>
	<tr>
		<td>Besar Potongan</td>
		<td>
			<!-- <input name="besar_potongan" value="<?php $besar_potongan; ?>" id="besar_potonganField" disabled> -->
			<?php 
			echo $form->textField($kasbon,'besar_potongan',array('disabled'=>'true','id'=>'besar_potonganField')); 
			echo $form->textField($kasbon,'besar_potongan',array('hidden'=>'true','id'=>'besar_potonganField2'));
			echo $form->error($kasbon,'besar_potongan',array('style'=>'color:#C00000;')); 
			?>
		</td>
	</tr>
	<tr>
		<td>Keterangan</td>
		<td>
			<!-- <textarea name="keterangan"><?php $keterangan; ?></textarea> -->
			<?php 
			echo $form->textArea($kasbon,'keterangan'); 
			echo $form->error($kasbon,'keterangan',array('style'=>'color:#C00000;')); 
			?>
		</td>
	</tr>
</table>

<script>

$('#pengajuan_kasbonField').change(function(){
	var_plafond_kasbonField = $('#plafond_kasbonField').val();
	var_pengajuan_kasbon 	= $('#pengajuan_kasbonField').val();

	$('#besar_potonganField').val(var_plafond_kasbonField-var_pengajuan_kasbon);
	$('#besar_potonganField2').val(var_plafond_kasbonField-var_pengajuan_kasbon);
});

</script>
