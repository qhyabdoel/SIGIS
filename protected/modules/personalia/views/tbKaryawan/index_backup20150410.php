<?php
/* @var $this TbKaryawanController */
/* @var $dataProvider CActiveDataProvider */

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs = array(
	'Personalia'   => array('/site/personalia'),
	'Karyawan'     => array('/site/karyawan'),
	'Report Data Karyawan'
);

$url = Yii::app()->createUrl('site/karyawan'); 

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}

$href2  = Yii::app()->createUrl('personalia/TbKaryawan/request_verifikasi');
$href3  = Yii::app()->createUrl('personalia/TbKaryawan/verify');

?>

<input id="requestUrl" value=<?php echo $href2; ?> hidden>
<input id="requestUrl2" value=<?php echo $href3; ?> hidden>
<input id="counterMessage" hidden>

<form method='post' action="action">

<div class="overflow-scroll-x">

<table class="tg">
  <tr>
    <th class="tg-bsv2" rowspan="2">NIK</th>
    <th class="tg-bsv2" rowspan="2">Nama</th>
    <th class="tg-bsv2" rowspan="2">Departemen</th>
    <th class="tg-bsv2" rowspan="2">Jabatan</th>
    <th class="tg-bsv2" rowspan="2">Tanggal Masuk</th>
    <th class="tg-bsv2" colspan="2">Masa Kerja</th>    
    <th class="tg-bsv2" rowspan="2">Jam Kerja</th>    
    <th class="tg-bsv2" rowspan="2">Jenis ID</th>    
    <th class="tg-bsv2" rowspan="2">Nomor ID</th>
    <th class="tg-bsv2" rowspan="2">Status</th>
    <th class="tg-bsv2" rowspan="2">Tempat Lahir</th>
    <th class="tg-bsv2" rowspan="2">Tanggal Lahir</th>
    <th class="tg-bsv2" rowspan="2">Alamat</th>
    <th class="tg-bsv2" rowspan="2">Nomor Telepon</th>
    <th class="tg-bsv2" rowspan="2">Nomor HP</th>
    <th class="tg-bsv2" rowspan="2">Nomor HP</th>
    <th class="tg-bsv2" rowspan="2">Alamat Email</th>
    <th class="tg-bsv2" rowspan="2">Nomor NPWP</th>
    <th class="tg-bsv2" rowspan="2">Nomor KPJ</th>
    <th class="tg-bsv2" rowspan="2">Nomor Rekening BCA</th>
    <th class="tg-bsv2" rowspan="2">Nomor Rekening BTN</th>    
    <th class="tg-bsv2" rowspan="2"></th>    
  </tr>
  <tr>
    <th class="tg-bsv2">Tahun</th>
    <th class="tg-bsv2">Bulan</th>
  </tr>
  <?php foreach ($lists as $karyawan) { 
  if($karyawan->active!=0){ ?>
  	<tr>
    <td class="tg-031e"><?php echo $karyawan->NIK_Absen; ?></td>
    <td class="tg-031e"><?php echo $karyawan->Nama; ?></td>
    <td class="tg-031e"><?php echo $karyawan->departemen->Nama_Department; ?></td>
    <td class="tg-031e"><?php echo $karyawan->jabatan->Nama_Jabatan; ?></td>
    <td class="tg-031e"><?php echo $karyawan->Tanggal_Masuk; ?></td>
    <td class="tg-031e"><?php echo $karyawan->masa_kerja_tahun; ?></td>
    <td class="tg-031e"><?php echo $karyawan->masa_kerja_bulan; ?></td>        
    <td class="tg-031e"><?php echo $karyawan->jam_kerja->dropdown_list_data; ?></td>        
    <td class="tg-031e"><?php echo $karyawan->Jenis_ID; ?></td>
    <td class="tg-031e"><?php echo $karyawan->No_ID; ?></td>
    <td class="tg-031e"><?php echo $karyawan->Status; ?></td>
    <td class="tg-031e"><?php echo $karyawan->Tempat_Lahir; ?></td>
    <td class="tg-031e"><?php echo $karyawan->Tanggal_Lahir; ?></td>
    <td class="tg-031e"><?php echo $karyawan->Alamat_Rumah; ?></td>
    <td class="tg-031e"><?php echo $karyawan->No_Telp_Rumah; ?></td>
    <td class="tg-031e"><?php echo $karyawan->No_HP; ?></td>
    <td class="tg-031e"><?php echo $karyawan->No_HP2; ?></td>
    <td class="tg-031e"><?php echo $karyawan->Alamat_Email; ?></td>
    <td class="tg-031e"><?php echo $karyawan->No_NPWP; ?></td>
    <td class="tg-031e"><?php echo $karyawan->No_KPJ; ?></td>
    <td class="tg-031e"><?php echo $karyawan->No_Rek_BCA; ?></td>
    <td class="tg-031e"><?php echo $karyawan->No_Rek_BTN; ?></td>
    <td class="tg-031e"><input name="nik" type="radio" value="<?php echo $karyawan->NIK_Absen; ?>"></td>
    </tr>	
  <?php }
  } ?>  
 </table>

</div>

<input name="action" id="actionField" hidden>
<button id="buttonEdit" hidden></button>

</form>

<br>

<a class="small-button" href="<?php echo $url; ?>">Close</a>
<a class="small-button" href="#" id="linkButtonEdit">Edit</a>
<a class="small-button" href="#" id="linkButtonDelete">Delete</a>

<?php $this->renderPartial('_verifikasi'); ?>

<div class="overlay" id="successDiv" style="display: none;">    
  <div class="wrapper">   
    <div class="content">   
      <a class="close" id="closeSuccess">x</a>    
      <br><br>
      <table><tr><td><h2 align="center">Verifikasi berhasil!</h2></td></tr></table>           
    </div>    
  </div>
</div>

<div class="overlay" id="failDiv" style="display: none;">   
  <div class="wrapper">   
    <div class="content">   
      <a class="close" id="closeFail">x</a>   
      <br><br>
      <table><tr><td><h2 align="center">Verifikasi tidak berhasil!</h2></td></tr></table>           
    </div>    
  </div>
</div>

<div class="overlay" id="infoDiv" style="display: none;">   
  <div class="wrapper">   
    <div class="content">   
      <a class="close" id="closeInfo">x</a>   
      <br><br>
      <table><tr><td><h2 align="center">Silakan menekan tombol verified!</h2></td></tr></table>           
    </div>    
  </div>
</div>

<div class="overlay" id="karyawanDiv" style="display: none;">   
  <div class="wrapper">   
    <div class="content">   
      <a class="close" id="close">x</a>   
      <br><br>
      <table>
        <tr>
          <th>Apakah anda yakin menghapus data ?</th>          
        </tr>
        <tr>
          <td>
            <a href="#" class="small-button" id="buttonEditModal">OK</a>
            <a href="#" class="small-button" id="buttonCloseModal">Cancel</a>
          </td>
        </tr>
        <tr><td colspan="3" style="color:#C00000;" id="errorCell"></td></tr>        
      </table>            
    </div>    
  </div>
</div>

<script>

$('#closeSuccess').click(function(){
  $('#successDiv').fadeToggle('fast');
  $('#actionField').val('delete');
  $('#buttonEdit').click();   
});

$('#closeFail').click(function(){
  $('#failDiv').fadeToggle('fast');
  $('#counterMessage').val('');
});

$('#closeVerifikasi').click(function(){
  $("#verifikasiDiv").fadeToggle("fast");       

  if($('#counterMessage').val()=='0'){
    $('#failDiv').fadeToggle("fast");
  }
  else if($('#counterMessage').val()=='1'){
    $('#successDiv').fadeToggle("fast");
  }
}); 

$('#closeInfo').click(function(){
  $('#infoDiv').fadeToggle('fast');
});

$('#linkButtonEdit').click(function(){
  $('#actionField').val('edit')
  $('#buttonEdit').click();
});

$('#linkButtonDelete').click(function(){
    event.preventDefault();
    $("#verifikasiDiv").fadeToggle("fast");   
});

$('#close').click(function(){
   event.preventDefault();
    $("#karyawanDiv").fadeToggle("fast");    
});

$('#buttonCloseModal').click(function(){
   event.preventDefault();
    $("#karyawanDiv").fadeToggle("fast");    
});

$('#buttonEditModal').click(function(){
    $('#actionField').val('delete');
    $('#buttonEdit').click();   
});

//   retVal = confirm("Apakah anda yakin menghapus data ?");
//   if(retVal==true){
//     $('#actionField').val('delete');
//     $('#buttonEdit').click();
//     return true;
//   }
//   else{
//     return false;
//   }

</script>