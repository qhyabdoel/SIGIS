<?php

// echo count(TbKaryawan::model()->findByAttributes(array('NIK_Absen'=>95002))->ketentuan);

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(  

'Personalia'      => array('/site/personalia'),
'Gaji dan Upah'   => array('/site/gaji'),
'Gaji Bulanan'    => array('/site/bulanan'),
'Gaji Bulanan'    => array('/site/perhitungan'),
'Pilih Proyek'    => array('/site/pendapatan'),

'Pendapatan'
);

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}

$url = Yii::app()->createUrl('site/pendapatan');

?>

<form method="post" action="pendapatan">

<?php if($karyawans==''){
  ?><input name="lain[0]" hidden><?php
} ?>

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

<div class="overflow-scroll-x">

<table class="tg">
  <tr>    
    <th class="tg-bsv2">NIK</th>
    <th class="tg-bsv2">Nama</th>    
    <th class="tg-bsv2">Gaji Pokok</th>
    <th class="tg-bsv2">Tunjangan Jabatan</th>
    <th class="tg-bsv2" width="120px">Makanan dan Transport</th>
    <th class="tg-bsv2">Lembur</th>
    <th class="tg-bsv2">Luar Kota</th>
    <th class="tg-bsv2">Premi Hadir</th>
    <th class="tg-bsv2">Bonus Hadir</th>
    <th class="tg-bsv2">Lain-lain</th>
    <th class="tg-bsv2">Total Pendapatan</th>
  </tr>  
  
  <?php 

  // echo $proyek.', '.$awal.', '.$akhir;
  // die();

  if($karyawans!=''){
    $total_tunjangan_jabatan    = 0;
    $total_makan_transport      = 0;
    $total_gaji_pokok           = 0;
    $total_lembur               = 0;
    $total_luar_kota            = 0;
    $total_premi_hadir          = 0;
    $total_bonus_hadir          = 0;
    $total                      = 0;    
    $lain                       = $lain;
    $i                          = 1;    
    $total_lain                 = 0;    
    
    foreach($karyawans as $karyawan){    
      $jumlah_hadir               = $karyawan->getKehadiran($awal,$akhir);
      $tunjangan_jabatan          = $karyawan->getTunjanganJabatan($proyek,$awal,$akhir);
      $makan_transport            = $karyawan->getKetentuan()->makan_transport;
      $makan_transport            = $jumlah_hadir*$makan_transport;
      $gaji_pokok                 = $karyawan->getGajiPokok($proyek,$awal,$akhir);
      $lembur                     = $karyawan->getJam_lembur($awal,$akhir);
      $luar_kota                  = $karyawan->getLuar_kota($awal,$akhir);
      $premi_hadir                = $karyawan->getPremi_hadir($awal,$akhir);
      $bonus_hadir                = $karyawan->getBonus_hadir($awal,$akhir);
      $total_pendapatan           = $gaji_pokok+$tunjangan_jabatan+$makan_transport+$lembur+$luar_kota+$premi_hadir+$bonus_hadir; 
      $total_tunjangan_jabatan    = $total_tunjangan_jabatan+$tunjangan_jabatan;
      $total_makan_transport      = $total_makan_transport+$makan_transport;
      $total_gaji_pokok           = $total_gaji_pokok+$gaji_pokok;
      $total_lembur               = $total_lembur+$lembur;
      $total_bonus_hadir          = $total_bonus_hadir+$bonus_hadir;
      $total_premi_hadir          = $total_premi_hadir+$premi_hadir;
      $total_luar_kota            = $total_luar_kota+$luar_kota;
      $total                      = $total+$total_pendapatan;
      
      if(!isset($lain[$i])) $lain[$i] = 0;

      $jml_lain                   = $lain[$i];
      $total_lain                 += $lain[$i];

  ?>

  <tr>
    <td class="tg-031e"><?php echo $karyawan->NIK_Absen; ?></td>
    <td class="tg-031e"><?php echo $karyawan->Nama; ?></td>
    <td class="tg-031e"><?php echo 'Rp. '.number_format($gaji_pokok,2,",","."); ?></td>
    <td class="tg-031e"><?php echo 'Rp. '.number_format($tunjangan_jabatan,2,",","."); ?></td>
    <td class="tg-031e"><?php echo 'Rp. '.number_format($makan_transport,2,",","."); ?></td>
    <td class="tg-031e"><?php echo 'Rp. '.number_format($lembur,2,",","."); ?></td>
    <td class="tg-031e"><?php echo 'Rp. '.number_format($luar_kota,2,",","."); ?></td>
    <td class="tg-031e"><?php echo 'Rp. '.number_format($premi_hadir,2,",","."); ?></td>
    <td class="tg-031e"><?php echo 'Rp. '.number_format($bonus_hadir,2,",","."); ?></td>
    <?php
    if ($edit=='true') {
    ?>
      <td class="tg-031e"><input type="text" name="lain[]"></td>
    <?php
    } else {
    ?>
      <td class="tg-031e"><?php echo isset($jml_lain) ? 'Rp. '.number_format($jml_lain,2,",",".") : ''; ?></td>
    <?php
    }
    ?>
    <td class="tg-031e"><?php echo 'Rp. '.number_format($total_pendapatan,2,",","."); ?></td>
  </tr>    

  <?php
    $i++;
  } 
  ?>

  <tr>    
    <th class="tg-bsv2"></th>
    <th class="tg-bsv2">Total</th>
    <th class="tg-bsv2"><?php echo 'Rp. '.number_format($total_gaji_pokok,2,",","."); ?></th>
    <th class="tg-bsv2"><?php echo 'Rp. '.number_format($total_tunjangan_jabatan,2,",","."); ?></th>
    <th class="tg-bsv2"><?php echo 'Rp. '.number_format($total_makan_transport,2,",","."); ?></th>
    <th class="tg-bsv2"><?php echo 'Rp. '.number_format($total_lembur,2,",","."); ?></th>
    <th class="tg-bsv2"><?php echo 'Rp. '.number_format($total_luar_kota,2,",","."); ?></th>
    <th class="tg-bsv2"><?php echo 'Rp. '.number_format($total_premi_hadir,2,",","."); ?></th>
    <th class="tg-bsv2"><?php echo 'Rp. '.number_format($total_bonus_hadir,2,",","."); ?></th>
    <th class="tg-bsv2"><?php echo 'Rp. '.number_format($total_lain,2,",","."); ?></th>
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
    <td class="tg-031e"></td>
    <td class="tg-031e"></td>
    <td class="tg-031e"></td>
    <td class="tg-031e"></td>
    <td class="tg-031e">-</td>
  </tr>    

  <tr>    
    <th class="tg-bsv2"></th>
    <th class="tg-bsv2">Total</th>
    <th class="tg-bsv2">-</th>
    <th class="tg-bsv2">-</th>
    <th class="tg-bsv2">-</th>
    <th class="tg-bsv2">-</th>
    <th class="tg-bsv2"></th>
    <th class="tg-bsv2"></th>
    <th class="tg-bsv2"></th>
    <th class="tg-bsv2"></th>
    <th class="tg-bsv2">-</th>
  </tr>
  
  <?php } ?>

</table>

</form>

</div>

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