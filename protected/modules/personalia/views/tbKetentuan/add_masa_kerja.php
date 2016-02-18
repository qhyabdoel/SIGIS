<?php

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(
	'Personalia'=>array('/site/personalia'),
	'Ketentuan'=>array('/site/ketentuan'),
	'Input Data'=>array($url),
	'Tambah Nilai Masa Kerja',
);

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}

?>

<div class="form">

	<div class="row">
		<form action="add_masa_kerja" method="post">
			
			<table>				
				<tr>
					<th width="80px">Masa Kerja</th>
					<td width="120px">
						<input name="masa_kerja_awal" style="width:40px;"> - <input name="masa_kerja_akhir" style="width:40px;">
					</td>
					<td>
						<a class="small-button" id="buttonLinkCreate" href="#">Create</a>
						<a class="small-button" href="<?php echo Yii::app()->createUrl('personalia/'.$url); ?>">Close</a>
					</td>
				</tr>
				<tr>
					<td>
						<input name="id" value="<?php echo $id; ?>" hidden>
						<input name="from" value="<?php echo $from; ?>" hidden>
					</td>
					<td>
						<button id="buttonCreate" hidden></button>
					</td>
				</tr>				
			</table>			

		</form>
	</div>

</div><!-- form -->

<script>
	$('#buttonLinkCreate').click(function(){
		$('#buttonCreate').click();
	});
</script>