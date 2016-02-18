<?php $this->breadcrumbs=array(
	'Personalia'	=> array('/site/personalia'),
	'Ketentuan' 	=> array('/site/ketentuan'),	
	'Ketentuan Personalia'
); 

Yii::app()->clientScript->registerCoreScript('jquery');

$url = Yii::app()->createUrl('site/ketentuan'); 

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}

?>

<form method="post" action="action">

<div class="overflow-scroll-x">

<table class="tg">
  <tr>
   
    <th class="tg-bsv2">Golongan</th>
    <th class="tg-bsv2">Departemen</th>
    <th class="tg-bsv2">Jabatan</th>
    <th class="tg-bsv2">Masa Kerja</th>
    <th class="tg-bsv2">Premi dan Bonus Hadir</th>
    <th class="tg-bsv2">Makan dan Transport</th>
    <th class="tg-bsv2">Lembur</th>
    <th class="tg-bsv2">Uang Luar Kota</th>
    <th class="tg-bsv2">Plafond KB</th>
    <th class="tg-bsv2">Kesehatan</th>
    <th class="tg-bsv2"></th>
  </tr>  
  <?php foreach ($model as $ketentuan) { 
    if($ketentuan->active!=0){ ?>
  <tr>
    
    <td class="tg-031e"><?php echo $ketentuan->golongan->Nama_golongan; ?></td>
    <td class="tg-031e"><?php echo $ketentuan->departemen->Nama_Department; ?></td>
    <td class="tg-031e"><?php echo $ketentuan->jabatan->Nama_Jabatan; ?></td>    
    <td class="tg-031e"><?php echo $ketentuan->Masa_Kerja; ?></td>
    <td class="tg-031e"><?php echo 'Rp '.number_format($ketentuan->premi_hadir+$ketentuan->bonus_hadir,2,",","."); ?></td>
    <td class="tg-031e"><?php echo 'Rp '.number_format($ketentuan->makan_transport,2,',','.'); ?></td>
    <td class="tg-031e"><?php echo 'Rp '.number_format($ketentuan->lembur,2,',','.'); ?></td>
    <td class="tg-031e"><?php echo 'Rp '.number_format($ketentuan->lembur_luarkota,2,',','.'); ?></td>
    <td class="tg-031e"><?php echo 'Rp '.number_format($ketentuan->kasbon,2,',','.'); ?></td>
    <td class="tg-031e"><?php echo 'Rp '.number_format($ketentuan->kesehatan,2,',','.'); ?></td>
    <td class="tg-031e"><input name="id" type="radio" value="<?php echo $ketentuan->id; ?>"></td>
  </tr> 
  <?php } ?>
  <?php } ?>  
 </table>

</div>

<input name="action" id="actionField" hidden>
<button id="buttonEdit" hidden></button>

</form>

<br>

<a class="small-button" href="<?php echo $url; ?>">Close</a>
<a class="small-button" href="#" id="linkButtonEdit">Edit</a>
<a class="small-button" href="#" id="linkButtonDelete">Delete</a>

<div class="overlay" id="ketentuanDiv" style="display: none;">   
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
      </table>            
    </div>    
  </div>
</div>

<script>

$('#linkButtonEdit').click(function(){
  $('#actionField').val('edit');  
  $('#buttonEdit').click();
});

$('#linkButtonDelete').click(function(){
  event.preventDefault();
  $("#ketentuanDiv").fadeToggle("fast");   
});

$('#buttonEditModal').click(function(){
    $('#actionField').val('delete');
    $('#buttonEdit').click();   
});

$('#close').click(function(){
   event.preventDefault();
    $("#ketentuanDiv").fadeToggle("fast");    
});

$('#buttonCloseModal').click(function(){
   event.preventDefault();
    $("#ketentuanDiv").fadeToggle("fast");    
});

</script>