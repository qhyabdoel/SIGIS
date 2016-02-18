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
		<td>
			<input value="<?php echo $masa_kerja_tahun; ?>" style="width:50px;" disabled> th &nbsp;
			<input value="<?php echo $masa_kerja_bulan; ?>" style="width:50px;" disabled> bl
		</td>
	</tr>
	<tr>		
		<input name="plafond_kasbon" value="<?php echo $plafond_kasbon; ?>" id="plafond_kasbonField" hidden>
		<?php if($plafond_kasbon!='') $plafond_kasbon = number_format($plafond_kasbon,0,"","."); ?>
		<td>Plafond Kasbon</td>
		<td>
			Rp <input name="plafond_kasbon" value="<?php echo $plafond_kasbon; ?>" id="plafond_kasbonField2" style="width:140px;" disabled>
		</td>
	</tr>
</table>

<table>
	<tr>
		<td width="300px">Pengajuan Kasbon</td>
		<td>Rp 			
			<?php 

			if($pengajuan_kasbon!='') $pengajuan_kasbon = number_format($pengajuan_kasbon,0,"",".");

			echo $form->textField($kasbon,'pengajuan_kasbon',array('id'=>'pengajuan_kasbonField','value'=>$pengajuan_kasbon,'hidden'=>'true')); 
			?><input value="<?php echo $pengajuan_kasbon; ?>" id="pengajuan_kasbonField2" style="width:140px;"><?php
			
			echo $form->error($kasbon,'pengajuan_kasbon',array('style'=>'color:#C00000;')); 
			
			?>
		</td>
	</tr>
	<tr>
		<td>Besar Potongan</td>
		<td>
			Rp 
			<!-- <input name="besar_potongan" value="<?php $besar_potongan; ?>" id="besar_potonganField" disabled> -->
			<?php 
			echo $form->textField($kasbon,'besar_potongan',array('id'=>'besar_potonganField','value'=>$besar_potongan,'hidden'=>'true')); 
			if($besar_potongan!='') $besar_potongan = number_format($besar_potongan,0,'','.');
			?><input id="besar_potonganField2" value="<?php echo $besar_potongan; ?>" style="width:140px;"><?php
			echo $form->error($kasbon,'besar_potongan',array('style'=>'color:#C00000;')); 
			?>
		</td>
	</tr>
	<tr>
		<td>Keterangan</td>
		<td>			
			<?php 
			echo $form->textArea($kasbon,'keterangan'); 
			echo $form->error($kasbon,'keterangan',array('style'=>'color:#C00000;')); 
			?>
		</td>
	</tr>
</table>

<script>

$('#pengajuan_kasbonField2').maskMoney();

$('#besar_potonganField2').maskMoney();

$('#pengajuan_kasbonField2').change(function(){
	$('#pengajuan_kasbonField').val($(this).val());
});

$('#pengajuan_kasbonField').change(function(){
	var_plafond_kasbonField = $('#plafond_kasbonField').val();
	var_pengajuan_kasbon 	= $('#pengajuan_kasbonField').val();	

	$('#besar_potonganField').val(Math.floor((var_plafond_kasbonField-var_pengajuan_kasbon)/12));	
});

function money(n) {
    return n.replace(/./g, function(c, i, a) {
        return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
    });
}

$('#besar_potonganField').change(function(){
	var besar_potongan 	= $(this).val();
	var format 		 	= money(besar_potongan);
	
	$('#besar_potonganField2').val(format);
});

</script>
