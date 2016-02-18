<div class="overlay" id="jabatanDiv" style="display: none;">		
	<div class="wrapper">		
		<div class="content">		
			<a class="close" id="closeJabatan">x</a>		
			<br><br>
			<table>
				<tr>
					<th>Nama Jabatan</th>
					<td>
						<input name="nama" id="namaJabatanField">
					</td>
					<td><a href="#" class="small-button" id="buttonTambahJabatan">Tambah</a></td>
				</tr>
				<tr><td colspan="3" style="color:#C00000;" id="errorCellJabatan"></td></tr>				
			</table>						
		</div>		
	</div>
</div>

<script>

$('#buttonTambahJabatan').click(function(){	
	nama 	= $('#namaJabatanField').val();
	url 	= $('#jabatanUrlAjaxField').val();	

	$.post(url,{nama:nama},function(json){
		var result = JSON.parse(json);								

		$('#errorCellJabatan').text(result.error);

		if(result.error==''){			
			$('#jabatanField option[value="add value"]').before('<option value="'+result.value+'">'+result.text+'</option>');			
			$('#namaJabatanField').val('');			
			$('#closeJabatan').click();					
		}		
	});	
});

</script>