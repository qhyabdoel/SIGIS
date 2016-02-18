<?php
Yii::app()->clientScript->registerCoreScript('jquery');
$tahuns = array(1=>1,2=>2);
echo CHtml::dropDownList('','',$tahuns,array('id'=>'fuck'));
?>
<button id="fucked">fuck</button>
<script>
$('#fuck').change(function(){
	alert($(this).val());
});
$('#fucked').click(function(){
	alert($('#fuck').val());
});
</script>