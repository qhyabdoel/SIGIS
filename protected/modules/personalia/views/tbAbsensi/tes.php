<?php Yii::app()->clientScript->registerCoreScript('jquery'); 

$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name' => 'date_from',    
    'htmlOptions' => array(
        'size' => '10',         // textField size
        'maxlength' => '10',    // textField maxlength
        'id'=>'datepicker'
    ),
));

?>

<!-- <input id="datepicker"> -->

<script>

$(function() {
	$( "#datepicker" ).datepicker({
		beforeShowDay: $.datepicker.noWeekends
	});
});

</script>