<?php
/* @var $this TbAbsensiController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(

	'Personalia' 		=> array('/site/personalia'),
	'Gaji dan Upah'	=> array('/site/gaji'),
	'Gaji Bulanan' 	=> array('/site/bulanan'),
  'Pilih Proyek'  => array('/site/payroll'),

	'Payroll'	
);

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}
?>
<table>
  <tr>
    <td width="50px"><label>Bank</label></td>
    <td><?php echo CHtml::dropDownList('bank','bank',array('BCA','BTN')); ?></td>
  </tr>
  <tr>
    <td><label>Periode</label></td>
    <td><?php echo CHtml::dateField('awal'); ?>-<?php echo CHtml::dateField('akhir'); ?></td>
  </tr>
</table>

<table class="tg">
  <tr>
    <th class="tg-bsv2">No</th>
    <th class="tg-bsv2">NIK</th>
    <th class="tg-bsv2">Nama</th>    
    <th class="tg-bsv2">Nomor Account</th>
    <th class="tg-bsv2">Nama Account</th>
    <th class="tg-bsv2">Jumlah</th>
  </tr>  
  <tr>
  	<td class="tg-031e">-</td>
    <td class="tg-031e">-</td>
  	<td class="tg-031e">-</td>
  	<td class="tg-031e">-</td>
  	<td class="tg-031e">-</td>
  	<td class="tg-031e">-</td>  	
  </tr>    
  <tr>    
    <th class="tg-bsv2" colspan="5">Total</th>
    <th class="tg-bsv2"></th>
  </tr>
</table>

<br>

<div class="span-11" align="center">
  <pre>
    Bandung, 15 Oktober 2014
    PT. Sanggar Indah Group


    Kiki Abdulloh
  </pre>
</div>
<div class="span-11" align="center">
  <pre>
    Penerima
    Bank Bca


    Kiki Abdulloh
  </pre>
</div>

<br><br><br><br><br><br><br>
<br><br><br><br><br><br><br>

<a class="small-button" href="#">Submit</a>
<a class="small-button" href="#">Print</a>
<a class="small-button" href="#">Edit</a>
<a class="small-button" href="#">Cancel</a>