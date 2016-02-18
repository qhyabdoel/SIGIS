<?php Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(
  
  'Personalia'    => array('/site/personalia'),
  'Gaji dan Upah' => array('/site/gaji'),
  'Gaji Bulanan'  => array('/site/bulanan'),
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
    <td><?php echo CHtml::dateField('awal'); ?>-<?php echo CHtml::dateField('akhir'); ?></td>
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

    $pendapatan = $karyawan->getTotalPenggajian($proyek,$awal,$akhir);

    if($pendapatan!=0){
    ?>
    <tr>    
        <td class="tg-031e"><?php echo $karyawan->NIK_Absen; ?></td>
        <td class="tg-031e"><?php echo $pendapatan; ?></td>
        <td class="tg-031e"><?php echo $pendapatan*(5/100); ?></td>
        <td class="tg-031e"><?php echo $pendapatan-$pendapatan*(5/100)-$karyawan->tarif_ptpkp; ?></td>
        <td class="tg-031e">-</td>
        <td class="tg-031e">-</td>
        <td class="tg-031e">-</td>
        <td class="tg-031e">-</td>
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
<a class="small-button" href="#">Cancel</a>

<script>

$('#linkkSubmitButton').click(function(){
    $('#buttonSubmit').click();
});

</script>