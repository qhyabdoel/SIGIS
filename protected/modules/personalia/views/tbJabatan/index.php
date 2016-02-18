<?php

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs = array(
    'Personalia'    => array('/site/personalia'),
    'Ketentuan'     => array('/site/ketentuan'),
    'Input Data'    => array('/personalia/TbKetentuan/'.$url),
    'Jabatan'
);

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}

$url = Yii::app()->createUrl('personalia/TbKetentuan/'.$url); 

?>

<div align="center">
    <form method="post" action="update">

    <table class="tg" style="width:300px;">
      <tr>        
        <th class="tg-bsv2">Nama Jabatan</th>    
        <th class="tg-bsv2"></th>
      </tr>  
      <?php foreach ($jabatans as $jabatan){ ?>    
      <tr>        
        <td class="tg-031e"><?php echo $jabatan->Nama_Jabatan; ?></td>
        <td class="tg-031e"><input name="id" type="radio" value="<?php echo $jabatan->Kode_Jabatan; ?>"></td>
      </tr>   
      <?php } ?>  
    </table>

    <input name="ketentuan" value="<?php echo $ketentuan; ?>" hidden>    

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