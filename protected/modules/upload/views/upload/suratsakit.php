<?php
/* @var $this UploadController */
/* @var $model Upload */

?>

<h1>Upload surat sakit</h1>

<?php 
//$this->renderPartial('_form', array('model'=>$model)); 
//$user_id = 'reno';

?>

<div class="" id="profile_photo" class="hidden hidden_input">
	<img style="width:auto; margin-left:auto, margin-right:auto, max-width:150px; height:auto; max-height:150px;" src="" class="img-thumbnail">
	<div>
	<?php 
	echo Yii::t('strings', 'Click to change profile photo');
	?>. <br/>Format file jpg,png,bmp</div>
	<div class="errorMessage">		
	</div>
	<div id="upload_control" style="margin-left:10px;">	
	<?php echo $form;?> 
	</div>		
</div><br/>