<?php 

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs = array(
    'Personalia'    => array('/site/personalia'),
    'Ketentuan'     => array('/site/ketentuan'),
    'Input Data'    => array('/personalia/TbKetentuan/'.$url),
    'Golongan'		=> array('/personalia/TbGolongan/index?ketentuan='.$ketentuan),
    'Edit Golongan'
);

$url = Yii::app()->createUrl('personalia/TbGolongan/index?ketentuan='.$ketentuan);

?>

<div align="center">

<?php $form = $this->beginWidget('CActiveForm', array('id'=>'tb-golongan-form','enableAjaxValidation'=>false)); ?>

<table style="width:400px;">
	<tr>
		<td width="70px">Golongan</td>
		<td><?php echo $form->textField($golongan,'Nama_golongan',array('style'=>'width:50px;')); ?></td>
		<td>
			<a class="small-button" href="#" id="linkButtonUpdate">Update</a>
			<a class="small-button" href="<?php echo $url; ?>">Close</a>
		</td>
	</tr>
</table>


<input name="id" value="<?php echo $golongan->ID; ?>" hidden>
<input name="ketentuan" value="<?php echo $ketentuan; ?>" hidden>
<input name="action" id="fieldAction" hidden>

<button id="buttonSubmit" hidden></button>

<?php $this->endWidget(); ?>

</div>

<script>

$('#linkButtonUpdate').click(function(){
	$('#fieldAction').val('update');
	$('#buttonSubmit').click();
});

</script>