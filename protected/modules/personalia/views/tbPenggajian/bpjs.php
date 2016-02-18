<?php 

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(  
  'Personalia'    => array('/site/personalia'),
  'Gaji dan Upah' => array('/site/gaji'),
  'Gaji Bulanan'  => array('/site/bulanan'),
  'Gaji Bulanan'  => array('/site/perhitungan'),
  'Pilih Proyek'  => array('/site/potongan'),
  'Potongan'      => array('/personalia/TbPenggajian/potongan?proyek='.$proyek),
  'BPJS'
); 

// $url = Yii::app()->createUrl('pers');

?>

<form action="bpjs" method="post">

<input name="proyek" value="<?php echo $proyek; ?>" hidden>

<table>
  <tr>
    <td><label>PT</label></td>
    <td><?php echo $proyek; ?></td>
  </tr>
  <tr>
    <td><label>KPP</label></td>
    <td>_</td>
  </tr>
  <tr>
    <td><label>Periode</label></td>
    <td><?php echo CHtml::dateField('awal',$awal); ?>-<?php echo CHtml::dateField('akhir',$akhir); ?></td>
  </tr>
</table>

<table class="tg">
  <tr>    
    <th class="tg-bsv2">NIK</th>
    <th class="tg-bsv2">Nama</th>    
    <th class="tg-bsv2">Nomor Kpj</th>
    <th class="tg-bsv2">Tanggal Lahir</th>
    <th class="tg-bsv2">Gaji</th>
    <th class="tg-bsv2">Iuran Bpjs</th>    
  </tr>

  <?php 

    $rows_count = 0;

    foreach($karyawans as $karyawan){

    $pendapatan = $karyawan->getTotalPenggajian($proyek,$awal,$akhir);
    $bpjs       = (0.89/100+0.3/100+5.7/100)*$pendapatan;

    if($pendapatan!=0){
    ?>
    
    <tr>
        <td class="tg-031e"><?php echo $karyawan->NIK_Absen; ?></td>
        <td class="tg-031e"><?php echo $karyawan->Nama; ?></td>
        <td class="tg-031e"><?php echo $karyawan->No_KPJ; ?></td>
        <td class="tg-031e"><?php echo Yii::app()->date_ina->getDate2($karyawan->Tanggal_Lahir); ?></td>
        <td class="tg-031e"><?php echo 'Rp '.number_format($pendapatan,2,",","."); ?></td>
        <td class="tg-031e"><?php echo 'Rp '.number_format($bpjs,2,",","."); ?></td>
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
<a class="small-button" href="potongan?proyek=<?php echo $proyek; ?>">Cancel</a>

<script>

$('#linkkSubmitButton').click(function(){
    $('#buttonSubmit').click();
});

</script>