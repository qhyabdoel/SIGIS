<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>	

<a href="#" class="small-button" id="overlayLink">Tambah</a>
<br><br>
<label><h4 id="label">....</h4></label>

<?php $this->renderPartial('tes3'); ?>

<script>

$("#overlayLink").click(function(event){
	event.preventDefault();
	$(".overlay").fadeToggle("fast");
});

</script>