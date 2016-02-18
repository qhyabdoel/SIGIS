<?php 

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs = array(
    'Personalia'        => array('/site/personalia'),
    'Gaji dan Upah'     => array('/site/gaji'),
    'Gaji Bulanan'      => array('/site/bulanan'),
    'Gaji All PT'       => array('/personalia/TbPenggajian/input'),
    'Proyek'			=> array('/personalia/TbPenggajian/edit_proyek'),
    'Edit Proyek'
);

$url = Yii::app()->createUrl('personalia/TbPenggajian/edit_proyek');

?>

<div align="center">

<?php $form = $this->beginWidget('CActiveForm', array('id'=>'tb-proyek-form','enableAjaxValidation'=>false)); ?>

<table style="width:400px;">
	<tr>
		<th width="100px"><label>Nama Proyek</label></th>
		<td>
			<?php echo $form->textField($proyek,'id',array('hidden'=>'true')); ?>
			<?php echo $form->textField($proyek,'name',array('style'=>'width:100px;')); ?>
			<span style="color:#C00000;"><?php echo $form->error($proyek,'name'); ?></span>
		</td>		
	</tr>	
	<tr>
		<td><button id="buttonSubmit" hidden></button><br></td>
	</tr>
	<tr>
		<td>
		</td>
		<td>
			<a class="small-button" href="#" id="linkButtonUpdate">Update</a>
			<a class="small-button" href="<?php echo $url; ?>">Close</a>
		</td>
	</tr>
</table>

<!--  -->

<?php $this->endWidget(); ?>

</div>

<script>

$('#linkButtonUpdate').click(function(){
	$('#fieldAction').val('update');
	$('#buttonSubmit').click();
});

</script>