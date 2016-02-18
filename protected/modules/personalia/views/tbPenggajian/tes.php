<?php 

$baseUrl 	= Yii::app()->baseUrl; 
$cs 		= Yii::app()->getClientScript();

$cs->registerScriptFile($baseUrl.'/js/mask_money.js');

Yii::app()->clientScript->registerCoreScript('jquery');

?>

<form action="tes" method="post">
	
</form>

  <input id="currency" name="wage">
  <input id="number">
  <button id="submit">Submit</button>

<script>
  $(function() {
    $('#currency').maskMoney();
  });

  $('#submit').click(function(){
    var currency  = $('#currency').val();
    var number    = currency.replace(/\./g,'');
    // $('#number').val(maskValue($('#currency').val()));
    alert(number);
  });
</script>
