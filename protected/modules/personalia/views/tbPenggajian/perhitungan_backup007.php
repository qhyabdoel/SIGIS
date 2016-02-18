<?php Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(
  
  'Personalia'    => array('/site/personalia'),
  'Gaji dan Upah' => array('/site/gaji'),
  'Gaji Bulanan'  => array('/site/bulanan'),
  'Gaji Bulanan'  => array('/site/perhitungan'),
  'Pilih Proyek'  => array('/site/potongan'),
  'Potongan'      => array('/personalia/TbPenggajian/potongan?proyek='.$proyek),
  'Pph'           => array('/personalia/TbPenggajian/pph?proyek='.$proyek),

  'Perhitungan Pph'

); ?>

<form action="perhitungan" method="post">

<input name="proyek" value="<?php echo $proyek; ?>" hidden>

<table>  
  <tr>
    <td width="100px">Proyek</td>
    <td><?php echo $proyek; ?></td>
  </tr>
  <tr>
    <td><label>Periode</label></td>
    <td><?php echo CHtml::dateField('awal',$awal); ?>-<?php echo CHtml::dateField('akhir',$akhir); ?></td>
  </tr>
</table>

<table class="tg">
  <tr>    
    <th class="tg-bsv2">NIK</th>
    <th class="tg-bsv2">Take Home Pay / Th</th>    
    <th class="tg-bsv2">BI JAB 5%</th>
    <th class="tg-bsv2">PKP</th>
    <th class="tg-bsv2">Progressive</th>
    <th class="tg-bsv2">Denda NPWP</th>
    <th class="tg-bsv2">Pph per Th</th>
    <th class="tg-bsv2">Pph Bulanan</th>
  </tr>  
  
    <?php 

    $rows_count = 0;

    foreach($karyawans as $karyawan){

    $pendapatan       = $karyawan->getTotalPenggajian($proyek,$awal,$akhir);
    $lembur           = $karyawan->ketentuan->lembur;
    $lembur_luar_kota = $karyawan->ketentuan->lembur_luarkota;
    $take_home_pay    = ($pendapatan-$lembur-$lembur_luar_kota)*12;
    $progressive      = $karyawan->getProgressive($proyek,$awal,$akhir);        
    $denda_npwp       = $karyawan->getDenda_npwp($proyek,$awal,$akhir);
    $pph_per_th       = $progressive+$denda_npwp;

    if($pendapatan!=0){
    ?>
    <tr>    
        <td class="tg-031e"><?php echo $karyawan->NIK_Absen; ?></td>
        <td class="tg-031e"><?php echo 'Rp '.number_format($take_home_pay,2,",","."); ?></td>
        <td class="tg-031e"><?php echo 'Rp '.number_format($take_home_pay*(5/100),2,",","."); ?></td>
        <td class="tg-031e">
          <?php echo 'Rp '.number_format($take_home_pay-$take_home_pay*(5/100)-$karyawan->tarif_ptpkp,2,",","."); ?>
        </td>                
        <td class="tg-031e"><?php echo 'Rp '.number_format($progressive,2,",","."); ?></td>
        <td class="tg-031e"><?php echo 'Rp '.number_format($denda_npwp,2,",","."); ?></td>
        <td class="tg-031e"><?php echo 'Rp '.number_format($progressive+$denda_npwp,2,",","."); ?></td>
        <td class="tg-031e"><?php echo 'Rp '.number_format(($progressive+$denda_npwp)/12,2,",","."); ?></td>
    </tr>      
    <?php
    $rows_count++;
    }

    }

    if($rows_count==0){

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
    </tr>      
    <?php

    }

    ?>  	
</table>

<button id="buttonSubmit" hidden></button>

</form>

<br>

<a class="small-button" href="#" id="linkkSubmitButton">Submit</a>
<a class="small-button" href="#">Print</a>
<a class="small-button" href="pph?proyek=<?php echo $proyek; ?>">Cancel</a>

<script>

$('#linkkSubmitButton').click(function(){
    $('#buttonSubmit').click();
});

</script>