<?php
/* @var $this TbKaryawanController */
/* @var $model TbKaryawan */
/* @var $form CActiveForm */
$action =  Yii::app()->createUrl('personalia/TbKaryawan/create');
?>

<div class="form">

	<div class="row">
		<form action="<?php echo $action; ?>" method="post">
	
		<label>NIK</label>

		<input name="nik">		
		<input name="method" id="methodField" hidden="true">
		
		<button id="buttonSearch" hidden="true"></button>
		<button id="buttonCreate" hidden="true"></button>		

		&nbsp;
		
		<a class="small-button" id="buttonLinkSearch" href="#">Search</a>
		<a class="small-button" id="buttonLinkCreate" href="#">Create</a>		
	
		</form>
	</div>		

	<?php 
	
	?>

</div><!-- form -->

<script>
	$('#buttonLinkSearch').click(function(){
		$('#buttonSearch').click();
	});

	$('#buttonLinkCreate').click(function(){
		$('#buttonCreate').click();
	});	

	$('#buttonSearch').click(function(){
		$('#methodField').val('search');		
	});

	$('#buttonCreate').click(function(){
		$('#methodField').val('create');		
	});	
</script>