<?php
    echo CHtml::link('Tambahkan Gambar', array('image/create'));
    foreach ($data as $model){
?>
<p><?php
        echo "<h2>
".$model->name."</h2>
";
        echo "
";
        echo CHtml::image(Yii::app()->request->baseUrl.'/images/'.$model->image.'','',array('width'=>300));
    ?>
</p>
<hr>
<?php
    }
?>