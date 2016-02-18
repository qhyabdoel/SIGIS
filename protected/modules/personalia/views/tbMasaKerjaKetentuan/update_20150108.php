<?php 

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs = array(
    'Personalia'    => array('/site/personalia'),
    'Ketentuan'     => array('/site/ketentuan'),
    'Input Data'    => array('/personalia/TbKetentuan/'.$url),
    'Masa Kerja'	=> array('/personalia/TbMasaKerjaKetentuan/index?ketentuan='.$ketentuan),
    'Edit Masa Kerja'
);

$url 	= Yii::app()->createUrl('personalia/TbMasaKerjaKetentuan/index?ketentuan='.$ketentuan);

?>

<div align="center">

<?php $form = $this->beginWidget('CActiveForm', array('id'=>'tb-masa_kerja-form','enableAjaxValidation'=>false));  ?>

<table style="width:400px;">
	<tr>
		<td width="100px">Masa Kerja</td>
		<td><?php echo $form->textField($masa_kerja,'masa_kerja',array('style'=>'width:70px;')); ?></td>
		<td>
			<a class="small-button" href="#" id="linkButtonUpdate">Update</a>
			<a class="small-button" href="<?php echo $url; ?>">Close</a>
		</td>		
	</tr>
</table>


<input name="id" value="<?php echo $masa_kerja->Id; ?>" hidden>
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