<?php

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(

	'Personalia'      => array('/site/personalia'),
	'Gaji dan Upah'	  => array('/site/gaji'),
	'Gaji Bulanan' 	  => array('/site/bulanan'),
    'Pilih Proyek'    => array('/site/pendapatan'),

	'Pendapatan'	
);

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}

$url = Yii::app()->createUrl('site/pendapatan');

?>

<form method="post" action="pendapatan">

<input name="proyek" value="<?php echo $proyek; ?>" hidden="true">

<table>  
  <tr>
    <td width="50px"><label>Periode</label></td>    
    <?php if($karyawans!='' and $edit==''){        
        ?>
        <td>
            <?php echo Yii::app()->date_ina->getDate(strtotime($awal)).' s/d '.Yii::app()->date_ina->getDate(strtotime($akhir)); ?>
            <input type="date" name="awal" value="<?php echo $awal; ?>" hidden="true">
            <input type="date" name="akhir" value="<?php echo $akhir; ?>" hidden="true">
        </td>
        <?php
    } 
    elseif($karyawans!='' and $edit=='true'){
        ?>
        <td><input type="date" name="awal" value="<?php echo $awal; ?>">-<input type="date" name="akhir" value="<?php echo $akhir; ?>"></td>
        <?php
    }
    else{
        ?>
        <td><input type="date" name="awal" value="<?php echo $awal; ?>">-<input type="date" name="akhir" value="<?php echo $akhir; ?>"></td>
        <?php
    }?>    
  </tr>
</table>

<input name="edit" id="editField" hidden="true">

<button id="buttonSubmit" hidden="true"></button>

</form>

<table class="tg">
  <tr>    
    <th class="tg-bsv2">NIK</th>
    <th class="tg-bsv2">Nama</th>    
    <th class="tg-bsv2">Gaji Pokok</th>
    <th class="tg-bsv2">Tunjangan Jabatan</th>
    <th class="tg-bsv2" width="120px">Makanan dan Transport</th>
    <th class="tg-bsv2">Lembur</th>
    <th class="tg-bsv2">Total Pendapatan</th>
  </tr>  
  
  <?php 

  if($karyawans!=''){
    $total_tunjangan_jabatan    = 0;
    $total_makan_transport      = 0;
    $total_gaji_pokok           = 0;
    $total_lembur               = 0;
    $total                      = 0;

  foreach($karyawans as $karyawan){    
    $tunjangan_jabatan          = $karyawan->getTunjanganJabatan($proyek,$awal,$akhir);
    $makan_transport            = $karyawan->getKetentuan()->makan_transport;
    $gaji_pokok                 = $karyawan->getGajiPokok($proyek,$awal,$akhir);
    $lembur                     = $karyawan->getKetentuan()->lembur;
    $total_pendapatan           = $gaji_pokok+$tunjangan_jabatan+$makan_transport+$lembur; 
    $total_tunjangan_jabatan    = $total_tunjangan_jabatan+$tunjangan_jabatan;
    $total_makan_transport      = $total_makan_transport+$makan_transport;
    $total_gaji_pokok           = $total_gaji_pokok+$gaji_pokok;
    $total_lembur               = $total_lembur+$lembur;
    $total                      = $total+$total_pendapatan;
  ?>

  <tr>
    <td class="tg-031e"><?php echo $karyawan->NIK_Absen; ?></td>
    <td class="tg-031e"><?php echo $karyawan->Nama; ?></td>
    <td class="tg-031e"><?php echo 'Rp. '.number_format($gaji_pokok,2,",","."); ?></td>
    <td class="tg-031e"><?php echo 'Rp. '.number_format($tunjangan_jabatan,2,",","."); ?></td>
    <td class="tg-031e"><?php echo 'Rp. '.number_format($makan_transport,2,",","."); ?></td>
    <td class="tg-031e"><?php echo 'Rp. '.number_format($lembur,2,",","."); ?></td>
    <td class="tg-031e"><?php echo 'Rp. '.number_format($total_pendapatan,2,",","."); ?></td>
  </tr>    

  <?php
  } 
  ?>

  <tr>    
    <th class="tg-bsv2"></th>
    <th class="tg-bsv2">Total</th>
    <th class="tg-bsv2"><?php echo 'Rp. '.number_format($total_gaji_pokok,2,",","."); ?></th>
    <th class="tg-bsv2"><?php echo 'Rp. '.number_format($total_tunjangan_jabatan,2,",","."); ?></th>
    <th class="tg-bsv2"><?php echo 'Rp. '.number_format($total_makan_transport,2,",","."); ?></th>
    <th class="tg-bsv2"><?php echo 'Rp. '.number_format($total_lembur,2,",","."); ?></th>
    <th class="tg-bsv2"><?php echo 'Rp. '.number_format($total,2,",","."); ?></th>
  </tr>

  <?php
  }
  
  else{ 

  ?>

  <tr>
    <td class="tg-031e">-</td>
    <td class="tg-031e">-</td>
    <td class="tg-031e">-</td>
    <td class="tg-031e">-</td>
    <td class="tg-031e">-</td>
    <td class="tg-031e">-</td>
    <td class="tg-031e">-</td>
  </tr>    

  <tr>    
    <th class="tg-bsv2"></th>
    <th class="tg-bsv2">Total</th>
    <th class="tg-bsv2">-</th>
    <th class="tg-bsv2">-</th>
    <th class="tg-bsv2">-</th>
    <th class="tg-bsv2">-</th>
    <th class="tg-bsv2">-</th>
  </tr>
  
  <?php } ?>

</table>

<br>

<div class="span-11" align="center"></div>
<div class="span-11 float-right" align="center">
  <pre>
    Bandung, 15 Oktober 2014


    Kiki Abdulloh
  </pre>
</div>

<br><br><br><br><br><br><br><br>

<?php 

if($karyawans!='' and $edit==''){
  ?>
  <a class="small-button" href="#">Print</a>
  <a class="small-button" href="#" id="buttonLinkEdit">Edit</a>
  <?php
}
else{
  ?><a class="small-button" href="#" id="buttonLinkSubmit">Submit</a><?php  
}

?>

<a class="small-button" href="<?php echo $url; ?>">Cancel</a>

<script>

$('#buttonLinkSubmit').click(function(){  
  $('#buttonSubmit').click();
});

$('#buttonLinkEdit').click(function(){
    $('#editField').val('true');
    
    $('#buttonSubmit').click(); 
});

</script>