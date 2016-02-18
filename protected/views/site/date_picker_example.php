<button id="tes_buton">tes</button>

<?php 

$this->widget(
    'zii.widgets.jui.CJuiDatePicker',
    array(
        'name'=>'publishDate',    
        'options'=>array(
            'showAnim'=>'fold',
        ),
        'htmlOptions'=>array(
            'style'=>'height:10px;',
            'id'=>'date_picker'
        ),
));

?>

<script>

$('#tes_buton').click(function()
{
	alert($('#date_picker').val());
});

$('#date_picker').change(function() 
{
	alert('ok');
});

</script>