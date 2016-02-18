<?php $this->breadcrumbs=array(

	'Personalia'	=> array('/site/personalia'),
	'Ketentuan' 	=> array('/site/ketentuan'),
	
	'Ketentuan Personalia'
); 

$url = Yii::app()->createUrl('site/ketentuan'); ?>

<div class="overflow-scroll-x">

<table class="tg">
  <tr>
    <th class="tg-bsv2">ID</th>
    <th class="tg-bsv2" width="10px">Gol</th>
    <th class="tg-bsv2">Departemen</th>
    <th class="tg-bsv2">Jabatan</th>
    <th class="tg-bsv2" width="70px">Masa Kerja</th>
    <th class="tg-bsv2" width="80px">Premi dan Bonus Hadir</th>
    <th class="tg-bsv2" width="80px">Makan dan Transport</th>
    <th class="tg-bsv2" width="80px">Lembur</th>
    <th class="tg-bsv2" width="80px">Uang Luar Kota</th>
    <th class="tg-bsv2" width="100px">Plafond KB</th>
    <th class="tg-bsv2" width="100px">Kesehatan</th>
  </tr>
  <?php foreach ($model as $ketentuan) { 
    if($ketentuan->active!=0){ ?>
    <tr>
      <td class="tg-031e"><?php echo $ketentuan->id; ?></td>
    <td class="tg-031e"><?php echo $ketentuan->golongan->Nama_golongan; ?></td>
    <td class="tg-031e"><?php echo $ketentuan->departemen->Nama_Department; ?></td>
    <td class="tg-031e"><?php echo $ketentuan->jabatan->Nama_Jabatan; ?></td>
    <td class="tg-031e"><?php echo $ketentuan->Masa_Kerja.' bulan'; ?></td>
    <td class="tg-031e"><?php echo 'Rp '.number_format($ketentuan->premi_hadir+$ketentuan->bonus_hadir,2,",","."); ?></td>
    <td class="tg-031e"><?php echo 'Rp '.number_format($ketentuan->makan_transport,2,',','.'); ?></td>
    <td class="tg-031e"><?php echo 'Rp '.number_format($ketentuan->lembur,2,',','.'); ?></td>
    <td class="tg-031e"><?php echo 'Rp '.number_format($ketentuan->lembur_luarkota,2,',','.'); ?></td>
    <td class="tg-031e"><?php echo 'Rp '.number_format($ketentuan->kasbon,2,',','.'); ?></td>
    <td class="tg-031e"><?php echo 'Rp '.number_format($ketentuan->kesehatan,2,',','.'); ?></td>
  </tr> 
  <?php } ?>
  <?php } ?>  
 </table>

</div>

<br>

 <a class="small-button" href="<?php echo $url; ?>">Close</a>