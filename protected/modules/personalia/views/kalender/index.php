<?php
/* @var $this KalenderController */
/* @var $dataProvider CActiveDataProvider */

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs = array(
	'Personalia' 			=> array('/site/personalia'),
	'Gaji dan Upah'			=> array('/site/gaji'),
	'Gaji Bulanan' 			=> array('/site/bulanan'),
	'Gaji Bulanan' 			=> array('/site/perhitungan'),
	'Absensi' 				=> array('/site/absensi'),
	'Tanggal Libur' 		=> array('/site/tanggal_libur'),	
	'Daftar Tanggal Libur'
);

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}

$url 	= Yii::app()->createUrl('/site/tanggal_libur');
$no 	= 0;

?>

<?php 

// $this->widget('zii.widgets.CListView', array(
// 	'dataProvider'=>$dataProvider,
// 	'itemView'=>'_view',
// )); 

?>

<div align="center">

<table class="tg"  style="width:600px;">
	<tr>
		<th class="tg-bsv2">No</th>
		<th class="tg-bsv2">Nama Perayaan</th>
		<th class="tg-bsv2">Tanggal</th>
		<th class="tg-bsv2"></th>
	</tr>		
	<?php 
	
	if(count($kalenders)==0){

	?>
	<tr>
		<td class="tg-031e">-</td>
		<td class="tg-031e">-</td>
		<td class="tg-031e">-</td>
		<td class="tg-031e">-</td>
	</tr>
	<?php

	}
	else{
	
	foreach ($kalenders as $kalender) {
	
	$no++;

	?>
	<tr>
		<td class="tg-031e"><?php echo $no; ?></td>
		<td class="tg-031e"><?php echo $kalender->nama_perayaan; ?></td>
		<td class="tg-031e"><?php echo $kalender->tanggal; ?></td>
		<td class="tg-031e"><input name="id" type="radio" value="<?php echo $kalender->id; ?>" id="radioId"></td>
	</tr>
	<?php

	}	

	}
	
	?>	
</table>

<a class="small-button" href="<?php echo $url; ?>">Close</a>
<a class="small-button" href="#" id="linkButtonEdit">Edit</a>
<a class="small-button" href="#" id="linkButtonDelete">Delete</a>

</div>

<div class="overlay" id="alertDiv" style="display: none;">   
  <div class="wrapper">   
    <div class="content">   
      <a class="close" id="closeAlert">x</a>   
      <br><br>
      <table>
        <tr>
          <th>Apakah anda yakin menghapus data ?</th>          
        </tr>
        <tr>
          <td>
            <a href="#" class="small-button" id="buttonAlertDelete">OK</a>
            <a href="#" class="small-button" id="buttonAlertClose">Cancel</a>
          </td>
        </tr>        
      </table>            
    </div>    
  </div>
</div>

<script>

$('#linkButtonEdit').click(function(){
	// alert( $('#radioId:checked').val());	

	id = $('#radioId:checked').val();

	if(id!=undefined){
		window.location.href = 'update/id/'+id+'?index';
	}	
});

$('#linkButtonDelete').click(function(){
	id = $('#radioId:checked').val();

	if(id!=undefined){
		$('#alertDiv').fadeToggle('fast');
	}		
});

$('#closeAlert').click(function(){
	$('#alertDiv').fadeToggle('fast');
});

$('#buttonAlertClose').click(function(){
	$('#alertDiv').fadeToggle('fast');
});

$('#buttonAlertDelete').click(function(){
	window.location.href = 'delete/id/'+id;
});

</script>