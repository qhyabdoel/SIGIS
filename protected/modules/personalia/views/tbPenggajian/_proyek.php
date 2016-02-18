<?php $url = Yii::app()->createUrl('/personalia/tbPenggajian/add_proyek'); ?>

<div class="overlay" id="proyekDiv" style="display: none;">		
	<div class="wrapper">		
		<div class="content">		
			<a class="close" id="closeProyek">x</a>		
			<br><br>
			<table>
				<tr>
					<th>Nama Proyek</th>
					<td><input id="nameInput"></td>									
				</tr>
				<!-- <tr>
					<th>Gaji Proyek</th>
					<td><input id="wageInput"></td>
				</tr> -->
				<tr><td colspan="2" style="color:#C00000;" id="errorCell"></td></tr>							
			</table>
								
			<table>
				<tr>
					<td width="160px"></td>
					<td><a href="#" class="small-button" id="buttonProyek">Tambah</a></td>
				</tr>
			</table>
			<input value="<?php echo $url; ?>" id="urlTambah" hidden>
		</div>		
	</div>
</div>

<script>

</script>