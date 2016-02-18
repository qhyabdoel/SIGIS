<?php

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(

    'Personalia'        => array('/site/personalia'),
    'Gaji dan Upah'     => array('/site/gaji'),
    'Gaji Bulanan'      => array('/site/bulanan'),
    'Gaji All PT'       => array('/personalia/TbPenggajian/input'),
    'Proyek'
);

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}

$url = Yii::app()->createUrl('personalia/TbPenggajian/input'); 
if(isset($_COOKIE['from']) and $_COOKIE['from']!='input') $url = Yii::app()->createUrl('site/'.$_COOKIE['from']); 

?>

<div align="center">
    <form method="post" action="edit_proyek">

    <table class="tg" style="width:300px;">
      <tr>        
        <th class="tg-bsv2">Id</th> 
        <th class="tg-bsv2">Nama Proyek</th>            
        <th class="tg-bsv2"></th>
      </tr>  
      <?php foreach ($proyeks as $proyek){ ?>    
      <tr>        
        <td class="tg-031e"><?php echo $proyek->id; ?></td>
        <td class="tg-031e"><?php echo $proyek->name; ?></td>        
        <td class="tg-031e"><input name="id" type="radio" value="<?php echo $proyek->id; ?>"></td>
      </tr>   
      <?php } ?>  
    </table>

    <input name="action" id="fieldAction" hidden>

    <button id="buttonSubmit" hidden></button>

    <a class="small-button" href="<?php echo $url; ?>">Close</a>
    <a class="small-button" href="#" id="linkButtonEdit">Edit</a>
    <a class="small-button" href="#" id="linkButtonDelete">Delete</a>

    </form>
</div>

<script>

$('#linkButtonEdit').click(function(){
    $('#buttonSubmit').click();
});

$('#linkButtonDelete').click(function(){
    $('#fieldAction').val('delete');
    $('#buttonSubmit').click();
});

</script>