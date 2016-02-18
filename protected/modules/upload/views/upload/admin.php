<?php
/* @var $this UploadController */
/* @var $model Upload */

$this->breadcrumbs=array(
	'Uploads'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Upload', 'url'=>array('index')),
	array('label'=>'Create Upload', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#upload-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Uploads</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 

$upload_path = YiiBase::getPathOfAlias("webroot");

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'upload-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'user_id',
		
		array(
		'name'=>'user_id',
		'value'=>'$data->user->name',
		),
		
		'user_type',
		'filepath',
		'filename',
		'category',
				'timestamp',
		array(
			'class'=>'CButtonColumn',
			
					'template'=>'{view} {delete}',
			  		  'header'=>Yii::t('strings', 'View'),
      		'htmlOptions' => array('style'=>'max-height:5px; text-align:center; width:5%;'),		
			   'buttons'=>array(

       		 'view'=> array(
			'url'=>'
			
			
			Yii::app()->assetManager->publish(YiiBase::getPathOfAlias("webroot") . $data->filepath . $data->filename)',
            	'label'=>Yii::t('strings', 'view'),
            	//'imageUrl'=>'',
            	'options'=>array( 'class'=>'icon-edit' ),
       		 ),
			 
               'delete'=>array(
                         'url'=>'$this->grid->controller->createUrl("upload/delete", array("id"=>$data->primaryKey))',
				
						// 'imageUrl'=>'',
						 	'label'=>Yii::t('strings', 'delete'),
     		 'options'=>array( 'class'=>'icon-remove' ),							  
                         ),	
						 
						 
						 ),

		)
			 
	),
)); ?>
