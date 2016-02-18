<?php 

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs = array(
    'Personalia'    => array('/site/personalia'),
    'Ketentuan'     => array('/site/ketentuan'),
    'Input Data'    => array('/personalia/TbKetentuan/'.$url),
    'Jabatan'		=> array('/personalia/TbJabatan/index?ketentuan='.$ketentuan),
    'Edit Golongan'
);

$url = Yii::app()->createUrl('personalia/TbJabatan/index?ketentuan='.$ketentuan);

?>

<div align="center">

<?php $form = $this->beginWidget('CActiveForm', array('id'=>'tb-jabatan-form','enableAjaxValidation'=>false)); ?>

<table style="width:400px;">
	<tr>
		<td width="70px">Jabatan</td>
		<td><?php echo $form->textField($jabatan,'Nama_Jabatan'); ?></td>		
	</tr>
	<tr><td><br></td></tr>
	<tr>
		<td>
			<a class="small-button" href="#" id="linkButtonUpdate">Update</a>			
		</td>
		<td><a class="small-button" href="<?php echo $url; ?>">Close</a></td>
	</tr>
</table>


<input name="id" value="<?php echo $jabatan->Kode_Jabatan; ?>" hidden>
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