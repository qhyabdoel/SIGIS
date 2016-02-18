<div class="overlay" style="display: none;">		
	<div class="login-wrapper">		
		<div class="login-content">		
			<a class="close" id="close">x</a>		
			<br><br>
			<table>
				<tr>
					<th>Masa Kerja</th>
					<td><input id="input"></td>					
					<td><a href="#" class="small-button" id="buttonTambah">Tambah</a></td>
				</tr>
			</table>						
		</div>		
	</div>
</div>

<script>

$("#close").click(function(){
	$(".overlay").fadeToggle("fast");
});

$('#buttonTambah').click(function(){
	input = $('#input').val();

	$('#close').click();	
	
	$.post('post',{data:input},function(result){
		$('#label').text(result);
	});
});

</script>