<?php
	$action =  Yii::app()->createUrl('personalia/TbKetentuan/create');
?>

<div class="form">

	<div class="row">
		<form action="<?php echo $action; ?>" method="post">
			<label>Id Ketentuan</label>		
			<input name="id">		
			<input name="action" id="actionField" hidden="true">

			<button id="buttonSearch" hidden="true"></button>
			<button id="buttonCreate" hidden="true"></button>			

			&nbsp;
		
			<a class="small-button" id="buttonLinkSearch" href="#">Search</a>
			<a class="small-button" id="buttonLinkCreate" href="#">Create</a>		
		</form>
	</div>

</div><!-- form -->

<script>
	$('#buttonLinkSearch').click(function(){
		$('#buttonSearch').click();
	});

	$('#buttonLinkCreate').click(function(){
		$('#buttonCreate').click();
	});	

	$('#buttonSearch').click(function(){
		$('#actionField').val('search');		
	});

	$('#buttonCreate').click(function(){
		$('#actionField').val('create');		
	});	
</script>