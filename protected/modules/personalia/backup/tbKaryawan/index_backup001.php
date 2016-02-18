<?php
/* @var $this TbKaryawanController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Personalia'=>array('/site/personalia'),
	'Karyawan'=>array('/site/karyawan'),
	'Report Data Karyawan'
);

$this->menu=array(
	array('label'=>'Create TbKaryawan', 'url'=>array('create')),
	array('label'=>'Manage TbKaryawan', 'url'=>array('admin')),
);

$url = Yii::app()->createUrl('site/karyawan'); ?>

<table class="tg">
  <tr>
    <th class="tg-bsv2">NIK</th>
    <th class="tg-bsv2">Nama</th>
    <th class="tg-bsv2">Departemen</th>
    <th class="tg-bsv2">Jabatan</th>
    <th class="tg-bsv2">Masa Kerja</th>    
    <th class="tg-bsv2">Nomor ID</th>
    <th class="tg-bsv2">Nomor HP</th>
    <th class="tg-bsv2">Alamat Email</th>
    <th class="tg-bsv2">Nomor Rekening</th>
    <th class="tg-bsv2">Bank</th>
  </tr>
  <?php foreach ($lists as $karyawan) { 
  if($karyawan->active!=0){ ?>
  	<tr>
    <td class="tg-031e"><?php echo $karyawan->NIK_Absen; ?></td>
    <td class="tg-031e"><?php echo $karyawan->Nama; ?></td>
    <td class="tg-031e"><?php echo $karyawan->departemen->Nama_Department; ?></td>
    <td class="tg-031e"><?php echo $karyawan->jabatan->Nama_Jabatan; ?></td>
    <td class="tg-031e"><?php echo $karyawan->Masa_Kerja; ?></td>        
    <td class="tg-031e"><?php echo $karyawan->No_ID; ?></td>
    <td class="tg-031e"><?php echo $karyawan->No_HP; ?></td>
    <td class="tg-031e"><?php echo $karyawan->Alamat_Email; ?></td>
    <td class="tg-031e"><?php echo $karyawan->No_Rek; ?></td>
    <td class="tg-031e"><?php echo $karyawan->Bank_Rek; ?></td>
    </tr>	
  <?php }
  } ?>  
 </table>

 <a class="small-button" href="<?php echo $url; ?>">Close</a>