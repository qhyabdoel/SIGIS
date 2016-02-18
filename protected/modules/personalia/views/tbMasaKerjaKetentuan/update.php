<?php 

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs = array(
    'Personalia'    => array('/site/personalia'),
    'Ketentuan'     => array('/site/ketentuan'),
    'Input Data'    => array('/personalia/TbKetentuan/'.$url),
    'Masa Kerja'	=> array('/personalia/TbMasaKerjaKetentuan/index?ketentuan='.$ketentuan),
    'Edit Masa Kerja'
);

$url 			= Yii::app()->createUrl('personalia/TbMasaKerjaKetentuan/index?ketentuan='.$ketentuan);
$form 			= $this->beginWidget('CActiveForm', array('id'=>'tb-masa_kerja-form','enableAjaxValidation'=>false)); 
$masa_kerja2 	= explode('-', $masa_kerja->masa_kerja_tampil);
$awal			= $masa_kerja2[0];
$masa_kerja2 	= explode(' ', $masa_kerja2[1]);
$akhir 			= $masa_kerja2[0];
$satuan 		= $masa_kerja2[1];

?>

<table>
	<tr>
		<td width="100px">Masa Kerja</td>
		<td>
			<input name="awal" value="<?php echo $awal; ?>" style="width:70px;"> 
			- 
			<input name="akhir" value="<?php echo $akhir; ?>" style="width:70px;">
			&nbsp;
			<?php echo CHtml::dropDownList('satuan',$satuan,array('bulan'=>'bulan','tahun'=>'tahun')); ?>			
		</td>
	</tr>
	<tr>
		<td></td>
		<td><label style="color:#C00000;"><?php echo $error; ?></label></td>
	</tr>
	<tr>
		<td> </td>
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

<script>

$('#linkButtonUpdate').click(function(){
	$('#fieldAction').val('update');
	$('#buttonSubmit').click();
});

</script>