<div class="overlay" id="verifikasiDiv" style="display: none;">		
	<div class="wrapper">		
		<div class="content">		
			<a class="close" id="closeVerifikasi">x</a>		
			<br><br>			
			<table align="center">
				<tr>
					<td colspan="2">
						<h3><small>Silahkan melakukan scan sidikjari dantekan tombol 'Request' lalu 'Verified'!</small></h3>
					</td>
				</tr>
				<tr>		
					<td><a href="#" class="link-button" id="buttonRequest">Request</a></td>					
					<td><a href="#" class="link-button disable" id="buttonVerify">Verified</a></td>
				</tr>						
			</table>						
		</div>		
	</div>
</div>

<div class="overlay" id="permissionDiv" style="display: none;">		
	<div class="wrapper">		
		<div class="content">		
			<a class="close" id="closePermission">x</a>		
			<br><br>			
			<table class="table-center">
				<tr>
					<td>
						<h3 align="center"><small>Silahkan melakukan scan sidikjari!</small></h3>
					</td>
				</tr>
				<tr>		
					<td>
						<a href="#" class="link-button" id="closePermission2">Ok</a>
					</td>										
				</tr>						
			</table>						
		</div>		
	</div>
</div>

<script>
	$('#buttonRequest').click(function(){		
		url = $('#requestUrl').val();
		$.post(url,{input:'tes input'},function(json){});
		$('#permissionDiv').fadeToggle("fast");
	});

	$('#buttonVerify').click(function(){
		url = $('#requestUrl2').val();		
		$.post(url,{input:'tes input'},function(json){
			var result = JSON.parse(json);
			
			if(result.error==0){
				if(result.found==0){
					$('#counterMessage').val('0');
				}
				else{
					$('#counterMessage').val('1');
				}
			}
			else{
				$('#counterMessage').val('0');
			}			

			$('#closeVerifikasi').click();
		});

		// alert(url);
		
		$('#buttonVerify').addClass('disable');
		$('#buttonRequest').removeClass('disable');
	});	

	$('#closePermission').click(function(){
		$('#permissionDiv').fadeToggle('fast');	
	});

	$('#closePermission2').click(function(){
		$('#permissionDiv').fadeToggle('fast');	
		$('#buttonVerify').removeClass('disable');
		$('#buttonRequest').addClass('disable');
	});
</script>