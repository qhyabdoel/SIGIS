<?php
/* @var $this UnitController */
/* @var $model Unit */

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(
	'Personalia' 	=>array('/site/personalia'),
	'User'	 		=>array('/site/user'),
	'Daftar User',
);

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}

$url 	= Yii::app()->createUrl('/site/user');
$url2 	= Yii::app()->createUrl('personalia/user/update');
$url3 	= Yii::app()->createUrl('personalia/user/delete');

?>

<table class="tg">
	<tr>
		<th class="tg-bsv2">ID</th>
		<th class="tg-bsv2">Nama</th>
		<th class="tg-bsv2">Email</th>
		<th class="tg-bsv2">Password</th>
		<th class="tg-bsv2">Roles</th>
		<th class="tg-bsv2"></th>
	</tr>	
	
	<?php if(count($users)==0){

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
	else{

	foreach ($users as $user) {
	
	?>

	<tr>
		<td class="tg-031e"><?php echo $user->id; ?></td>
		<td class="tg-031e"><?php echo $user->name; ?></td>
		<td class="tg-031e"><?php echo $user->email; ?></td>
		<td class="tg-031e"><?php echo $user->password_hash; ?></td>
		<td class="tg-031e"><?php echo $user->roles; ?></td>
		<td class="tg-031e"><input name="id" id="radioId" type="radio" value="<?php echo $user->id; ?>"></td>
	</tr>		

	<?php

	}

	} ?>			
</table>

<input id="fieldId" hidden>
<input id="fieldLinkUpdate" value="<?php echo $url2; ?>" hidden>
<input id="fieldLinkDelete" value="<?php echo $url3; ?>" hidden>

<a href="#" class="small-button" id="buttonUpdate">Update</a>
<a href="#" class="small-button" id="buttonDelete">Delete</a>
<a href="<?php echo $url; ?>" class="small-button">Close</a>

<div class="overlay" id="verifikasiDiv" style="display: none;">   
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
            <a href="#" class="small-button" id="buttonDeleteModal">OK</a>
            <a href="#" class="small-button" id="buttonCloseModal">Cancel</a>
          </td>
        </tr>        
      </table>            
    </div>    
  </div>
</div>

<script>

$('#buttonUpdate').click(function(){
	$('#fieldId').val($('input[name="id"]:checked').val());
	window.location.href = $('#fieldLinkUpdate').val()+'/id/'+$('#fieldId').val();
});

$('#buttonDelete').click(function(){
  event.preventDefault();
  $('#verifikasiDiv').fadeToggle('fast');
});

$('#close').click(function(){
	event.preventDefault();
  	$('#verifikasiDiv').fadeToggle('fast');
});

$('#buttonDeleteModal').click(function(){
	$('#fieldId').val($('input[name="id"]:checked').val());
	window.location.href = $('#fieldLinkDelete').val()+'/id/'+$('#fieldId').val();
});

</script>
