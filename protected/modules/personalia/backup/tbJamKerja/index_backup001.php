<?php

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(
	'Personalia' 			=> array('/site/personalia'),
	'Gaji dan Upah'			=> array('/site/gaji'),
	'Gaji Bulanan' 			=> array('/site/bulanan'),
	'Gaji Bulanan' 			=> array('/site/perhitungan'),
	'Absensi' 				=> array('/site/absensi'),
	'Report Absensi' 		=> array('/site/report_absensi'),
	'Absensi per Karyawan' 	=> array('/personalia/TbAbsensi/per_karyawan?'.$url),
	'Jam Kerja'
);

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}

$url = Yii::app()->createUrl('personalia/TbAbsensi/per_karyawan?'.$url); 

?>

<div align="center">
	<form method="post" action="update">
		<table class="tg" style="width:300px;">
		  <tr>        
		    <th class="tg-bsv2">Nama Jam Kerja</th>
		    <th class="tg-bsv2">Jam Kerja</th>
		    <th class="tg-bsv2"></th>
		  </tr>  
		  <?php foreach($jam_kerjas as $jam_kerja){ ?>
		  <tr>        
		    <td class="tg-031e"><?php echo $jam_kerja->name; ?></td>
		    <td class="tg-031e"><?php echo $jam_kerja->value; ?></td>
		    <td class="tg-031e"><input name="id" type="radio" value="<?php echo $jam_kerja->id; ?>"></td>
		  </tr>   
		  <?php } ?>  
		</table>

		<input name="nik" value="<?php echo $datas['nik']; ?>" hidden>
		<input name="awal" value="<?php echo $datas['awal']; ?>" hidden>
		<input name="akhir" value="<?php echo $datas['akhir']; ?>" hidden>

		<input name="action" id="fieldAction" hidden>

		<button id="buttonSubmit" hidden></button>
	</form>

	<a class="small-button" href="<?php echo $url; ?>">Close</a>
    <a class="small-button" href="#" id="linkButtonEdit">Edit</a>
    <a class="small-button" href="#" id="linkButtonDelete">Delete</a>
</div>

<script>

$('#linkButtonEdit').click(function(){
    $('#buttonSubmit').click();
});

$('#linkButtonDelete').click(function(){
    $('#fieldAction').val('delete');
    $('#buttonSubmit').click();
});

</script>