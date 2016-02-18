
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

<input type="date" id="dateField">
<button id="buttonCek" >cek</button>

<script>

$('#buttonCek').click(function(){	
	var_date = $('#dateField').val();

	if(var_date==''){
		alert('fuck');
	}else{
		alert('shit');
	}
});

</script>