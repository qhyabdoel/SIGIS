<div class="overlay" id="departmentDiv" style="display: none;">		
	<div class="wrapper">		
		<div class="content">		
			<a class="close" id="closeDepartment">x</a>		
			<br><br>
			<table>
				<tr>
					<th>Nama Departemen</th>
					<td>
						<input name="nama" id="namaDepartmentField">
					</td>
					<td><a href="#" class="small-button" id="buttonTambahDepartment">Tambah</a></td>
				</tr>
				<tr><td colspan="3" style="color:#C00000;" id="errorCellDepartment"></td></tr>				
			</table>						
		</div>		
	</div>
</div>

<script>

$('#buttonTambahDepartment').click(function(){	
	nama 	= $('#namaDepartmentField').val();
	url 	= $('#departmentUrlAjaxField').val();		
	// url 	= $('#masa_kerjaUrlAjaxField').val();		

	$.post(url,{nama:nama},function(json){
		var result = JSON.parse(json);						

		$('#errorCellDepartment').text(result.error);

		if(result.error==''){			
			$('#departmenField option[value="add value"]').before('<option value="'+result.value+'">'+result.text+'</option>');			
			$('#namaDepartmentField').val('');			
			$('#closeDepartment').click();					
		}		
	});	
});

</script>