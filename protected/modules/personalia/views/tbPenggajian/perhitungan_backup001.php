<?php $this->breadcrumbs=array(
  
  'Personalia'    => array('/site/personalia'),
  'Gaji dan Upah' => array('/site/gaji'),
  'Gaji Bulanan'  => array('/site/bulanan'),
  'Pilih Proyek'  => array('/site/potongan'),
  'Potongan'      => array('/personalia/TbPenggajian/potongan'),
  'Pph'           => array('/personalia/TbPenggajian/pph'),

  'Perhitungan Pph'

); ?>

<table>  
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
</table>

<br>

<a class="small-button" href="#">Print</a>
<a class="small-button" href="#">Cancel</a>