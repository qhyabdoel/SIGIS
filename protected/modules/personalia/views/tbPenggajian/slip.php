<?php

// print_r($karyawan);

// echo $awal.' dan '.$akhir;

// if(isset($ketentuan)) echo 'ketentuan ada';
// else echo "ketentuan tidak ada";

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(

	'Personalia'  		 => array('/site/personalia'),
	'Gaji dan Upah'		 => array('/site/gaji'),
	'Gaji Bulanan' 		 => array('/site/bulanan'),
	'Periode Penggajian' => array('slip'),

	'Laporan Gaji Karyawan (Slip Gaji)'
);

$url = Yii::app()->createUrl('personalia/TbPenggajian/slip');

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}

if(isset($ketentuan))
{	
	$tunj_makan_transport 	= $ketentuan->makan_transport;
	$tunj_lembur 			= $ketentuan->lembur;
	$premi_hadir 			= $ketentuan->premi_hadir;
	$bonus_hadir 			= $ketentuan->bonus_hadir;
	$tunj_luar_kota 		= $ketentuan->lembur_luarkota;
	$keterlambatan 			= $ketentuan->keterlambatan;
	$pinjaman 				= $ketentuan->kasbon;
	$bpjs 					= 200000;
	$pph 					= 120000;	
	$ts_gaji_pokok 			= $tunjangan_jabatan+$premi_hadir+$bonus_hadir;	
	$ts_potongan 			= $pinjaman+$keterlambatan+$pph+$bpjs;
}
else
{	
	$total_makan_transport 	= 0;
	$tunj_makan_transport 	= 0;
	$total_penerimaan 		= 0;
	$total_luar_kota 		= 0;	
	$tunj_luar_kota 		= 0;
	$keterlambatan 			= 0;
	$ts_gaji_pokok 			= 0;
	$total_lembur 			= 0;	
	$premi_hadir 			= 0;
	$tunj_lembur 			= 0;
	$bonus_hadir 			= 0;
	$ts_potongan 			= 0;
	$gaji_pokok 			= 0;	
	$pinjaman 				= 0;
	$final 					= 'false';
	$bpjs 					= 0;
	$pph 					= 0;	
}

if(!isset($kali_makan_transport))
{
	$kali_makan_transport 	= '';
	$kali_luar_kota 		= '';
	$kali_lembur 			= '';
}

if(!isset($nik))
{
	$nik 		= '';
	$nama 		= '_';
	$jabatan 	= '_';
}

if(!isset($potongan)) $potongan = 0;

if(!isset($tunjangan_jabatan)) $tunjangan_jabatan = 0;

?>

<form method="post" action="slip">

<input name="tunj_makan_transport" value="<?php echo $tunj_makan_transport; ?>" hidden="true">
<input name="tunj_luar_kota" value="<?php echo $tunj_luar_kota; ?>" hidden="true">
<input name="tunj_lembur" value="<?php echo $tunj_lembur; ?>" hidden="true">
<input name="gaji_pokok" value="<?php echo $ts_gaji_pokok ?>" hidden="true">
<input name="potongan" value="<?php echo $ts_potongan ?>" hidden="true">
<input name="final" value="<?php echo $final; ?>" hidden="true" id="finalField"> 
<input name="akhir" value="<?php echo $akhir ?>" hidden="true">
<input name="awal" value="<?php echo $awal ?>" hidden="true">

<table>
	<tr>
		<th>NIK</th>
		<td>
			: <?php if($final=="true")
			{
				?><input name="nik" id="nikField2" value="<?php echo $nik; ?>" hidden="true"><?php
				echo $nik;
			}
			else
			{
				?>
				<input name="nik" id="nikField2" value="<?php echo $nik; ?>">
				<a class="small-button" href="#" id="buttonNikLink">Search</a>
				<?php
			} ?>			
		</td>
	</tr>
	<tr>
		<th>Nama</th>
		<td>			
			: <?php echo $nama; ?>
		</td>
	</tr>

	<tr>
		<th>Jabatan</th>
		<td>			
			: <?php echo $jabatan; ?>
		</td>
	</tr>
</table>

<div class="block-grey">
	<table>		

		<?php 
		if(!isset($penggajians))
		{ ?>

		<tr>
			<th width="440px" rowspan="3" class="top-align">Gaji Pokok</th>
			<td>PT. Aktif</td>
			<td>_<!-- <input name="pt1"> --></td>
		</tr>

		<!-- 
		<tr>			
			<td>PT. Aktif</td>
			<td><input name="pt2"></td>
		</tr>
		<tr>			
			<td>PT. Aktif</td>
			<td><input name="pt3"></td>
		</tr> 
		-->

		<?php }
		
		else
		{

		$rowspan = count($penggajians);

		$i = 1;

		foreach($penggajians as $penggajian)
		{ 
			if($i==1)
			{
			?>
			
			<tr>
				<th width='250px' rowspan="<?php echo $rowspan; ?>" class="top-align">Gaji Pokok</th>				
				<td width='450px'>PT. <?php echo $penggajian->proyek; ?></td>
				<td><?php echo '= Rp. '.number_format($karyawan->getGajiPokok($penggajian->proyek,$awal,$akhir),2,',','.'); ?></td>				
			</tr>
			
			<?php
			}
			else
			{
			?>
			
			<tr>				
				<td>PT. <?php echo $penggajian->proyek; ?></td>
				<td><?php echo '= Rp. '.number_format($karyawan->getGajiPokok($penggajian->proyek,$awal,$akhir),2,',','.'); ?></td>
			</tr>
			
			<?php
			}

			$i++;		
		}

		}		

		?>

	</table>

	<table>
		<tr>
			<th>Penambahan</th>
		</tr>
		<tr>
			<td width="230px">Tunjangan Jabatan</td>
			<td width="300px"></td>
			<td>= Rp. <?php echo number_format($tunjangan_jabatan,2,",","."); ?></td>
		</tr>
		<tr>
			<td>Tunjangan Makan dan Transport</td>
			<td>
				<?php if($final=="true")
				{
					?>
					<input name="kali_makan_transport" style="width:50px;" value="<?php echo $kali_makan_transport; ?>" hidden="true">
					<?php
					
					echo $kali_makan_transport." x ";
				}
				else
				{
					?><input name="kali_makan_transport" style="width:50px;" value="<?php echo $kali_makan_transport; ?>"> x <?php
				} 
				echo 'Rp. '.number_format($tunj_makan_transport,2,",","."); ?>
			</td>
			<td>= Rp. <?php echo number_format($total_makan_transport,2,",","."); ?></td>
		</tr>
		<tr>
			<td>Tunjangan Lembur</td>
			<td>
				<?php if($final=="true")
				{
					?><input name="kali_lembur" style="width:50px;" value="<?php echo $kali_lembur; ?>" hidden="true"><?php
					echo $kali_lembur." x ";
				}
				else
				{
					?><input name="kali_lembur" style="width:50px;" value="<?php echo $kali_lembur; ?>"> x <?php
				} 
				echo 'Rp. '.number_format($tunj_lembur,2,",","."); ?>
			</td>
			<td>= Rp. <?php echo number_format($total_lembur,2,",","."); ?></td>
		</tr>
		<tr>
			<td>Premi Hadir</td>
			<td></td>
			<td>= Rp. <?php echo number_format($premi_hadir,2,",","."); ?></td>
		</tr>
		<tr>
			<td>Bonus Hadir</td>
			<td></td>
			<td>= Rp. <?php echo number_format($bonus_hadir,2,",","."); ?></td>
		</tr>
		<tr>
			<td>Tunjangan Luar Kota</td>
			<td>
				<?php if($final=="true")
				{
					?><input name="kali_luar_kota" style="width:50px;" value="<?php echo $kali_luar_kota; ?>" hidden="true"><?php
					echo $kali_luar_kota." x ";
				}
				else
				{
					?><input name="kali_luar_kota" style="width:50px;" value="<?php echo $kali_luar_kota; ?>"> x <?php
				} 
				echo 'Rp. '.number_format($tunj_luar_kota,2,",","."); ?>				
			</td>
			<td>= Rp. <?php echo number_format($total_luar_kota,2,",","."); ?></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td width="180px"></td>
			<td>
				<hr>
				<b>Rp. <?php echo number_format($gaji_pokok,2,",","."); ?></b>
			</td>
		</tr>
	</table>
	<table>
		<tr>
			<th>Potongan</th>
		</tr>
		<tr>
			<td width="300px">Pengembalian Pinjaman</td>
			<td width="230px"></td>
			<td>= Rp. <?php echo number_format($pinjaman,2,",","."); ?></td>
		</tr>
		<tr>
			<td>Keterlambatan</td>
			<td></td>
			<td>= Rp. <?php echo number_format($keterlambatan,2,",","."); ?></td>
		</tr>
		<tr>
			<td>Pph 21</td>
			<td></td>
			<td>= Rp. <?php echo number_format($pph,2,",","."); ?></td>
		</tr>
		<tr>
			<td>Bpjs</td>
			<td></td>
			<td>= Rp. <?php echo number_format($bpjs,2,",","."); ?></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td width="180px"></td>
			<td><hr><b>Rp. <?php echo number_format($potongan,2,",",".") ?></b></td>
		</tr>
	</table>
	<table>
		<tr>
			<td width="480px"></td>
			<th width="230px">Total Penerimaan</th>
			<td><hr><b>Rp. <?php echo number_format($total_penerimaan,2,",","."); ?></b></td>
		</tr>
	</table>
</div>

<button hidden="true" id="buttonSubmit"></button>

</form>

<div class="span-11" align="center">
  <pre>
    Bandung, <?php echo Yii::app()->date_ina->now; ?> 


    <?php echo Yii::app()->user->name; ?>
  </pre>
</div>

<div class="span-11" align="center">
<br><br><br><br><br><br><br><br><br>

<?php if($final=='false'){
?>
<a class="small-button" href="#" id="buttonLinkSubmit">Submit</a>
<?php		
}
else{
?>
<a class="small-button" href="#">Print</a>
<a class="small-button" id="buttonLinkEdit" href="#">Edit</a>
<?php		
} ?>

<a class="small-button" href="<?php echo $url; ?>">Cancel</a>
</div>

<script>

$('#buttonNikLink').click(function()
{
	$('#buttonSubmit').click();
});

$('#buttonLinkSubmit').click(function()
{
	$('#finalField').val('true');

	$('#buttonSubmit').click();
});

$('#buttonLinkEdit').click(function()
{
	$('#finalField').val('false');
	
	$('#buttonSubmit').click();
})

</script>