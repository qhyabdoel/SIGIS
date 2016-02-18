<div class="overlay" id="golonganDiv" style="display: none;">		
	<div class="wrapper">		
		<div class="content">		
			<a class="close" id="closeGolongan">x</a>		
			<br><br>
			<table>
				<tr>
					<th>Golongan</th>
					<td><input id="golonganInput"></td>					
					<td><a href="#" class="small-button" id="buttonTambahGolongan">Tambah</a></td>
				</tr>
				<tr><td colspan="3" style="color:#C00000;" id="errorCell"></td></tr>				
			</table>						
		</div>		
	</div>
</div>

<script>

$('#buttonTambahGolongan').click(function(){
	text = $('#golonganInput').val();	
	url  = $('#golonganUrlAjaxField').val();

	$.post(url,{text:text},function(json){
		var result = JSON.parse(json);				
		// alert(json);

		$('#errorCell').text(result.error);
		if(result.error==''){			
			$('#golonganField option[value="add value"]').before('<option value="'+result.value+'">'+result.text+'</option>');
			$('#golonganInput').val('');
			$('#closeGolongan').click();		
		}		
	});		
});

</script>