<div class="overlay" id="masa_kerjaDiv" style="display: none;">		
	<div class="wrapper">		
		<div class="content">		
			<a class="close" id="closeMasa_kerja">x</a>		
			<br><br>
			<table>
				<tr>
					<th>Masa Kerja</th>
					<td>
						<input id="masa_kerjaAwal" style="width:70px;">
						-
						<input id="masa_kerjaAkhir" style="width:70px;">
					</td>
					<td><a href="#" class="small-button" id="buttonTambahMasa_kerja">Tambah</a></td>
				</tr>
				<tr><td colspan="3" style="color:#C00000;" id="errorCell"></td></tr>				
			</table>						
		</div>		
	</div>
</div>

<script>

$('#buttonTambahMasa_kerja').click(function(){
	awal 	= $('#masa_kerjaAwal').val();
	akhir 	= $('#masa_kerjaAkhir').val();

	// alert('ok');

	$.post('tambah_masa_kerja',{awal:awal,akhir:akhir},function(json){
		var result = JSON.parse(json);				
		// alert(json);

		$('#errorCell').text(result.error);
		if(result.error==''){			
			$('#masa_kerjaField option[value="add value"]').before('<option value="'+result.value+'">'+result.text+'</option>');
			$('#masa_kerjaAwal').val('');
			$('#masa_kerjaAkhir').val('');
			$('#closeMasa_kerja').click();		
		}		
	});	
});

</script>