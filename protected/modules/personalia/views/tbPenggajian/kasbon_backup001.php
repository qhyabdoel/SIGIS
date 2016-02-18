
<?php 

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(	
	'Personalia' 	=> array('/site/personalia'),
	'Gaji dan Upah'	=> array('/site/gaji'),
	'Gaji Bulanan' 	=> array('/site/bulanan'),
	'Pilih Proyek'	=> array('/site/potongan'),
	'Potongan'		=> array('/personalia/TbPenggajian/potongan'),
	'Kasbon Karyawan'
); 

$url 		= Yii::app()->createUrl('site/potongan');
$ajaxUrl1	= Yii::app()->createUrl('personalia/TbKaryawan/get');

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}

?>

<?php $form = $this->beginWidget('CActiveForm', array('id'=>'tb-kasbon-form','enableAjaxValidation'=>false)); ?>

<table>
	<tr>
		<th>NIK</th>
		<td>
			<input name="nik" id="nikField" value="<?php echo $nik; ?>">&nbsp;<a class="small-button" href="#" id="buttonLinkSearch">Search</a>
		</td>
	</tr>
</table>

<input name="action" id="actionField" hidden="true">

<?php echo $form->textField($kasbon,'NIK',array('value'=>$nik,'hidden'=>'tr')); ?>

<div class="litle-font">

<?php 
$this->widget(
	'zii.widgets.jui.CJuiTabs',
	array(
  	'tabs' => array(  
		'Data Karyawan'	=> array('content' => $this->renderPartial(
			'_data_karyawan',
			array(
				'nama' 				=> $nama,
				'form' 				=> $form,
				'kasbon'			=> $kasbon,
				'jabatan' 			=> $jabatan,
				'departemen' 		=> $departemen,
				'masa_kerja' 		=> $masa_kerja,				
				'plafond_kasbon' 	=> $plafond_kasbon,				
			),
			TRUE
		)),
		'Pengembalian'	=> array('content' => $this->renderPartial('_pengembalian',array(),TRUE)),      
  	),    
    'options' 	=> array('collapsible'=>true,'selected'=>0),
    'id' 		=> 'MyTab-Menu',    
	)
); 
?>

</div>

<?php echo CHtml::submitButton($kasbon->isNewRecord ? 'Create' : 'Save',array('id'=>'buttonSubmit','hidden'=>'true')); ?>

<?php $this->endWidget(); ?>

<br>

<a class="small-button" href="#" id="buttonLinkSubmit">Submit</a>
<a class="small-button" href="#">Edit</a>
<a class="small-button" href="<?php echo $url; ?>">Cancel</a>

<script>	

$('#buttonLinkSubmit').click(function(){
	$('#actionField').val('submit');
	$('#buttonSubmit').click();
});

$('#buttonLinkSearch').click(function(){
	$('#actionField').val('search');
	$('#buttonSubmit').click();
});

</script>