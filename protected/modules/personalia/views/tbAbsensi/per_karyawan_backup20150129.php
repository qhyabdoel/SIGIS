<?php

/* @var $this TbAbsensiController */
/* @var $dataProvider CActiveDataProvider */

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(
	'Personalia' 		=> array('/site/personalia'),
	'Gaji dan Upah'		=> array('/site/gaji'),
	'Gaji Bulanan' 		=> array('/site/bulanan'),
	'Gaji Bulanan' 		=> array('/site/perhitungan'),
	'Absensi' 			=> array('/site/absensi'),
	'Report Absensi' 	=> array('/site/report_absensi'),
	'Absensi per Karyawan'
);

function TanggalIndo($date){
    $BulanIndo = array(

        "Januari", "Februari", "Maret", "April", "Mei", "Juni", 
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    );

    $tahun  = substr($date, 0, 4);
    $bulan  = substr($date, 5, 2);
    $tgl    = substr($date, 8, 2);
    $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;   

    return($result);
}

$action = Yii::app()->createUrl('personalia/TbAbsensi/per_karyawan');
$url    = Yii::app()->createUrl('site/report_absensi');
$url2   = Yii::app()->createUrl('/personalia/TbAbsensi/eksport_per_karyawan?nik='.$nik.'&awal='.$awal.'&akhir='.$akhir);
$url3 	= Yii::app()->createUrl('personalia/TbJamKerja/ajax_create');
$url4 	= 'personalia/TbJamKerja/index?nik='.$nik.'&awal='.$awal.'&akhir='.$akhir.'&jam_kerja='.$id;
$url4 	= Yii::app()->createUrl($url4);

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}

$actionField = 'search';
?>

<form action="<?php echo $action; ?>" method="post">

<table>
	<tr>
		<td><label><b>Periode</b></label></td>
		<td>		
		<?php echo CHtml::dateField('awal',$awal); ?> - <?php echo CHtml::dateField('akhir',$akhir); ?>
		</td>
	</tr>
	<tr>
		<td><label>NIK</label></td>
		<td><input name="nik" value="<?php echo $nik; ?>"></td>
	</tr>
	<tr>
		<td><label>Nama</label></td>
		<td><input name="nama" disabled="true" value="<?php echo $nama; ?>"></td>
	</tr>
	<tr>
		<td><label>Jam Kerja</label></td>
		<td>
			<input id="hiddenFieldJam_kerja" hidden>
			<?php 
			$jam_kerjas['add'] 	= 'Jam Kerja Baru...';
			$jam_kerjas['edit'] = 'Edit Jam Kerja...';
			echo CHtml::dropdownList('jam_kerja',$id,$jam_kerjas,array('id'=>'fieldJam_kerja')); 
			?>
		</td>
	</tr>
	<tr>
		<td></td><td></td>
	</tr>
	<tr>
		<td></td>
		<td><a class="small-button" id="linkButtonSearch">Search</a></td>
	</tr>
</table>

<input name="action" hidden="true" value="<?php echo $actionField; ?>">

<button id="buttonSearch" hidden="true"></button>

</form>

<br><br>

<table class="tg">
  <tr>
    <th class="tg-bsv2" rowspan="2">Tanggal</th>        
    <th class="tg-bsv2" colspan="5">Kehadiran</th>
    <th class="tg-bsv2" colspan="4">Ketidakhadiran</th>
    <th class="tg-bsv2" rowspan="2">Keterangan</th>
  </tr>
  <tr>
    <td class="tg-bsv2">Jam Datang</td>
    <td class="tg-bsv2">Terlambat</td>
    <td class="tg-bsv2">Jam Pulang</td>    
    <td class="tg-bsv2">Jam Kerja</td>  
    <td class="tg-bsv2">Lembur</td>  
    <td class="tg-bsv2">Cuti</td>
    <td class="tg-bsv2">Ijin</td>
    <td class="tg-bsv2">Sakit</td>
    <td class="tg-bsv2">Alpa</td>
  </tr>
  <?php 
  
	$count = 0;

  	if(count($absensis)==0){
	?>
	<tr>
		<td class="tg-031e">-</td>
		<td class="tg-031e">-</td>
		<td class="tg-031e">-</td>
		<td class="tg-031e">-</td>
		<td class="tg-031e">-</td> 
		<td class="tg-031e">-</td>
		<td class="tg-031e">-</td>
		<td class="tg-031e">-</td>
		<td class="tg-031e">-</td>
		<td class="tg-031e">-</td> 
		<td class="tg-031e">-</td> 
	</tr> 	
	<?php
	}
	
	$total_cuti 		= 0;
	$total_ijin 		= 0;
	$total_sakit 		= 0;
	$total_lembur 		= 0;
	$total_terlambat 	= 0;

	foreach ($absensis as $absen){  		

	$cuti 			= '';
	$ijin 			= '';
	$sakit 			= '';

	if($absen->Ketidakhadiran=='cuti'){
		$cuti = 1;
		$total_cuti++;
	}	
	elseif($absen->Ketidakhadiran=='ijin'){
		$ijin = 1;
		$total_ijin++;	
	} 	
	elseif($absen->Ketidakhadiran=='sakit'){
		$sakit = 1;
		$total_sakit++;	
	}
	elseif($absen->Ketidakhadiran==''){
		$count++; 	
	} 

	?>

	<tr>
		<?php 
		$lembur 			= $absen->getLembur($akhir_jam_kerja);		
		$terlambat 			= $absen->getTerlambat($awal_jam_kerja);
		$total_lembur		= $total_lembur+$absen->getLembur_mentah($akhir_jam_kerja);
		$total_terlambat 	= $total_terlambat+$absen->getTerlambat_mentah($awal_jam_kerja);
		?>
		<td class="tg-031e"><?php echo TanggalIndo($absen->Tanggal); ?></td>
		<td class="tg-031e"><?php echo $absen->Jam_Masuk; ?></td>
		<td class="tg-031e"><?php echo $terlambat; ?></td>
		<td class="tg-031e"><?php echo $absen->Jam_Keluar; ?></td> 
		<td class="tg-031e"><?php echo $absen->Total_Jam_Kerja; ?></td>
		<td class="tg-031e"><?php echo $lembur; ?></td> 
		<td class="tg-031e"><?php echo $cuti; ?></td>
		<td class="tg-031e"><?php echo $ijin; ?></td>
		<td class="tg-031e"><?php echo $sakit; ?></td>
		<td class="tg-031e"></td> 
		<td class="tg-031e"></td> 
	</tr> 
  
	<?php 

	} 

	$total_terlambat_jam 	= floor($total_terlambat/3600);
	$total_terlambat_menit	= floor(($total_terlambat/3600-$total_terlambat_jam)*60);
	$total_terlambat 		= $total_terlambat_jam." jam ".$total_terlambat_menit." menit";

	$total_lembur_jam	= floor($total_lembur/3600);
	$total_lembur_menit = floor(($total_lembur/3600-$total_lembur_jam)*60);
	$total_lembur 		= $total_lembur_jam." jam ".$total_lembur_menit." menit";

	?>
  
  <tr>    
    <td class="tg-bsv2">Total</td>    
    <td class="tg-bsv2"></td>
    <td class="tg-bsv2"></td>
    <td class="tg-bsv2"></td>    
    <td class="tg-bsv2"></td>
    <td class="tg-bsv2"><?php echo $total_lembur; ?></td> 
    <td class="tg-bsv2"><?php echo $total_cuti; ?></td>
    <td class="tg-bsv2"><?php echo $total_ijin; ?></td>
    <td class="tg-bsv2"><?php echo $total_sakit; ?></td>
    <td class="tg-bsv2"></td> 
    <td class="tg-bsv2"></td> 
  </tr>
  <tr>
    <td class="tg-bsv2" colspan="4">Total Kehadiran (hari)</td>
    <td class="tg-bsv2" colspan="2"><?php echo $count; ?></td>
  </tr>
</table>

<a class="small-button" href="<?php echo $url; ?>">Close</a>
<a class="small-button" href="<?php echo $url2; ?>">Export to Excel</a>

<div class="overlay" id="divJam_kerja" style="display: none;">		
	<div class="wrapper">		
		<div class="content">		
			<a class="close" id="closeJam_kerja">x</a>		
			<br><br>
			<table>
				<tr>
					<th>Nama</th>
					<td><input id="inputNama"></td>					
				</tr>
				<tr>
					<th>Jam Kerja</th>
					<td>
						<?php echo CHtml::timeField('waktu_awal','',array('id'=>'inputJam_kerjaAwal')); ?>
						-
						<?php echo CHtml::timeField('waktu_akhir','',array('id'=>'inputJam_kerjaAkhir')); ?>
					</td>					
				</tr>
				<tr></tr>
				<tr><td colspan="2" style="color:#C00000;" id="errorCellJam_kerja"></td></tr>
				<tr><td></td><td><a href="#" class="small-button" id="buttonTambahJam_kerja">Tambah</a></td></tr>
			</table>						
		</div>		
	</div>
</div>

<input id="hiddenFieldUrlAjaxTambahJam_kerja" value="<?php echo $url3; ?>" hidden>
<input id="hiddenFieldUrlIndexJam_kerja" value="<?php echo $url4; ?>" hidden>

<script>

$('#linkButtonSearch').click(function(){
	$('#buttonSearch').click();
});

$('#fieldJam_kerja').click(function(){
	if($(this).val()=='add'){
		$('#divJam_kerja').fadeToggle('fast');
	}
	else if($(this).val()=='edit'){
		window.location.href = $('#hiddenFieldUrlIndexJam_kerja').val();
	}	

	if($(this).val()!='add'){
		$('#hiddenFieldJam_kerja').val($(this).val());
	}
});

$('#closeJam_kerja').click(function(){
	$('#divJam_kerja').fadeToggle('fast');
	$('#fieldJam_kerja').val($('#hiddenFieldJam_kerja').val());
});

$('#buttonTambahJam_kerja').click(function(){	
	url  	= $('#hiddenFieldUrlAjaxTambahJam_kerja').val();
	name 	= $('#inputNama').val();
	awal 	= $('#inputJam_kerjaAwal').val();
	akhir 	= $('#inputJam_kerjaAkhir').val();

	$.post(url,{name:name,awal:awal,akhir:akhir},function(json){
		var result = JSON.parse(json);
		// alert(json);

		$('#errorCellJam_kerja').text(result.error);
		
		if(result.error==''){
			var option = '<option value="'+result.value+'">'+result.text+'</option>';
			$('#fieldJam_kerja option[value="add"]').before(option);
			$('#closeJam_kerja').click();
			$('#inputNama').val('');
			$('#inputJam_kerjaAwal').val('');
			$('#inputJam_kerjaAkhir').val('');		
		}		
	});	
});

</script>