<?php
/* @var $this TbAbsensiController */
/* @var $dataProvider CActiveDataProvider */

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(

	'Personalia' 		  => array('/site/personalia'),
	'Gaji dan Upah'		=> array('/site/gaji'),
	'Gaji Bulanan' 		=> array('/site/bulanan'),
	'Gaji Bulanan' 		=> array('/site/perhitungan'),
	'Absensi' 			  => array('/site/absensi'),
	'Report Absensi' 	=> array('/site/report_absensi'),

	'Rekapitulasi Absensi'
);

$action = Yii::app()->createUrl('personalia/TbAbsensi/index');
$url    = Yii::app()->createUrl('site/report_absensi');
$url2   = Yii::app()->createUrl('/personalia/TbAbsensi/eksport_index?awal='.$awal.'&akhir='.$akhir);

function TanggalIndo($date)
{
  $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", 
    "Agustus", "September", "Oktober", "November", "Desember");

  $tahun = substr($date, 0, 4);
  $bulan = substr($date, 5, 2);
  $tgl   = substr($date, 8, 2);

  $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;   
  return($result);
}

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}
?>

<form action="<?php echo $action; ?>" method="post">

    <label><b>Periode</b></label> &nbsp;
    <?php if($awal!='') {
      echo CHtml::dateField('awal',$awal);
    }else{
      echo CHtml::dateField('awal');
    } ?>
    -
    <?php if($akhir!=''){
      echo CHtml::dateField('akhir',$akhir);
    } else {
      echo CHtml::dateField('akhir'); 
    } ?>

    <button id="buttonSearch" hidden="true"></button>
    <a class="small-button" id="linkButtonSearch">Search</a>

</form>

<br><br>

<table class="tg">
  <tr>
    <th class="tg-bsv2" rowspan="2">NIK</th>
    <th class="tg-bsv2" rowspan="2">Nama</th>
    <th class="tg-bsv2" rowspan="2">Kehadiran</th>
    <th class="tg-bsv2" colspan="4">Kehadiran</th>
  </tr>
  <tr>
    <td class="tg-bsv2">Cuti</td>
    <td class="tg-bsv2">Ijin</td>
    <td class="tg-bsv2">Sakit</td>
    <td class="tg-bsv2">Alpa</td>
  </tr>
  
  <?php foreach ($karyawans as $karyawan) { 
  if($karyawan->active!=0){ ?>    
  <tr>
  	<td class="tg-031e"><?php echo $karyawan->NIK_Absen ?></td>  	
    <td class="tg-031e"><?php echo $karyawan->Nama; ?></td>
    <td class="tg-031e"><?php echo $karyawan->getKehadiran($awal,$akhir); ?></td>
    <td class="tg-031e"><?php echo $karyawan->getKetidakhadiran('cuti',$awal,$akhir); ?></td>
    <td class="tg-031e"><?php echo $karyawan->getKetidakhadiran('ijin',$awal,$akhir); ?></td>
    <td class="tg-031e"><?php echo $karyawan->getKetidakhadiran('sakit',$awal,$akhir); ?></td>
    <td class="tg-031e"><?php echo $karyawan->getKetidakhadiran('alpa',$awal,$akhir); ?></td>
  </tr>  
  <?php }  
  } ?>

  <tr>
    <td class="tg-bsv2"></td>
    <td class="tg-bsv2">Total</td>
    <td class="tg-bsv2"></td>
    <td class="tg-bsv2"></td>
    <td class="tg-bsv2"></td>
    <td class="tg-bsv2"></td>
    <td class="tg-bsv2"></td>
  </tr>
</table>

<a class="small-button" href="<?php echo $url; ?>">Close</a>
<a class="small-button" href="<?php echo $url2; ?>">Export to Excel</a>

<script>

$('#linkButtonSearch').click(function(){
    $('#buttonSearch').click();
});

</script>