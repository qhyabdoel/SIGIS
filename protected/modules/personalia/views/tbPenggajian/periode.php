<?php

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(

	'Personalia' 		  => array('/site/personalia'),
	'Gaji dan Upah'		=> array('/site/gaji'),
	'Gaji Bulanan' 		=> array('/site/bulanan'),

	'Periode Penggajian'
);

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}

$action = Yii::app()->createUrl('personalia/TbPenggajian/slip');

?>

<form action="<?php echo $action; ?>" method="post">
	<?php if($view_slip=='slip_manual'){
		?><input name="manual" value="tes" hidden><?php
	} ?>
	<div class="span-10">
	<table>  
	  <tr>
	    <td width="50px"><label>Periode</label></td>
	    <td>
	    	<?php echo CHtml::dateField('awal'); ?>-<?php echo CHtml::dateField('akhir'); ?>
	    	<input id="actionTextField" hidden="true" name="action">
	    </td>
	  </tr>
	  <tr>
	  	<td></td>
	  	<td>
	  		<div align="right">
	  	
	  		<button id="buttonOk" hidden="true"></button>
			<button id="buttonCancel" hidden="true"></button>

			<a class="small-button" id="buttonLinkOk">OK</a>
			<a class="small-button" id="buttonLinkCancel">Cancel</a>
	  	
	  		</div>
			</td>
	  </tr>
	</table>
	</div>
</form>

<script>
	
	$('#buttonOk').click(function()
	{
		$('#actionTextField').val('ok');
	});
	$('#buttonCancel').click(function()
	{
		$('#actionTextField').val('cancel');
	});

	$('#buttonLinkOk').click(function()
	{
		$('#buttonOk').click();
	});

	$('#buttonLinkCancel').click(function()
	{
		$('#buttonCancel').click();
	});
</script>

<!-- <div class="float_right">	
</div> -->