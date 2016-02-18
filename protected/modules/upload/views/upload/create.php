<?php
/* @var $this UploadController */
/* @var $model Upload */

$this->breadcrumbs=array(
	'Uploads'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Upload', 'url'=>array('index')),
	array('label'=>'Manage Upload', 'url'=>array('admin')),
);
?>

<h1>Create Upload</h1>

<?php 
//$this->renderPartial('_form', array('model'=>$model)); 

$upload_path = YiiBase::getPathOfAlias("webroot").'/protected/modules/upload/uploads/absensi/';

	$upload_model = new FileUpload();

	$form = new CForm('application.modules.upload.views.upload.uploadForm', $upload_model);
	
	
	if( $form->validate()) {
						$form->model->image = CUploadedFile::getInstance($form->model, 'image');
						if (isset($form->model->image)) {
							$form->model->image->saveAs($upload_path . $model->id. '.' . $form->model->image->getExtensionName());
						} else {
							echo 'choose image first';
						}
	}
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