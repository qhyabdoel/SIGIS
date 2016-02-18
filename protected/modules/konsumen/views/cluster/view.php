<?php
/* @var $this ClusterController */
/* @var $model Cluster */


Yii::app()->clientScript->coreScriptPosition = CClientScript::POS_END;
Yii::app()->clientScript->registerCoreScript("jquery");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.imagemapster.js',CClientScript::POS_END);

/*
$this->breadcrumbs=array(
	'Clusters'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Cluster', 'url'=>array('index')),
	array('label'=>'Create Cluster', 'url'=>array('create')),
	array('label'=>'Update Cluster', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Cluster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Cluster', 'url'=>array('admin')),
);

*/
?>

<h1><?php echo $model->cluster_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		//'project_id',
		//'cluster_name',
		//'cluster_area',
		//'cluster_image',
	),
)); ?>

<br/><br/>

<img width="900" style="margin-left:-00px;" src="<?php $image_path = YiiBase::getPathOfAlias("webroot").$model->cluster_image; 
	$image_url = Yii::app()->assetManager->publish($image_path);
	echo $image_url; ?>" usemap="#<?php echo $model->id;?>">

<map name="<?php echo $model->id; ?>">

<?php
 
$tooltip_string = '';
  
  
$units=Unit::model()->findAllByAttributes(array('cluster_id'=>$model->id,));
 
foreach ($units as $unit)
{
	if ($unit->status == 'hold') {
		$color = $unit->status_color->ref_value;
		$text_color = 'FFFFFF';				
	}
	elseif ($unit->status == 'released') {
		$text_color = 'FFFFFF';
	}
	elseif ($unit->status == 'published') {
		$text_color = 'FFFFFF';
	}
	elseif ($unit->status == 'new'){
		$text_color = '000000';
	}
	else {
		$text_color = 'FFFFFF';
	}
						
 $ext_statuses=UnitExt::model()->findAllByAttributes( array(	

'unit_id'=>$unit->id,
'true'=>true,
				));
					$combined = 0;
					$combined2 = '';
				 foreach($ext_statuses as $ext_status){

					 
					 $combined = dechex(hexdec($combined) + hexdec($ext_status->ref->ref_value));
					 $combined2 = $combined2 . ',' . $ext_status->ref->ref_key;
				 }
				
				$combined = str_pad($combined,6,"0", STR_PAD_LEFT);
					$tooltip_string = $tooltip_string . '
								{
               key: "'.$unit->id.'", 
               toolTip: "'.$unit->kode.'<br/><div style=\'background-color:#'.$unit->status_color->ref_value.';color:#'.$text_color.'\'>'.$unit->status.'</div><div style=\'background-color:#'.$combined.';\'>'.$combined2.'</div>",
			   fillColor: "'.$unit->status_color->ref_value.'",

            },';
			
				?>

					
					
					<area data-key="<?php echo $unit->id;?>" href="../../../unit/update/id/<?php echo $unit->id;?>"  shape="<?php echo $unit->map->shape;?>" coords="<?php echo $unit->map->coordinates;?>" <?php echo $unit->kavling_area;?> alt="">
					
					<?php
					
					
				}
 
 
 
 
 ?>
 </map>
<br/><br/>
<?php 

$unitDataProvider=new CActiveDataProvider('Unit',array(
'criteria'=>array(
  'condition'=>'cluster_id =:cluster_id',
  'params'=>array(':cluster_id'=>$model->id),
),
));
		
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$unitDataProvider,
	'itemView'=>'_unitview',
)); ?>


<?php
Yii::app()->clientScript->registerScript('uniqueid', 
'
$(document).ready(function()
{

	$("img").mapster({
	singleSelect : true,
	showToolTip: true,
	staticState: true,
	scaleMap : true,
	render_highlight : { stroke: true, strokeColor: "0000FF", fillColorMask: "555555",},
     mapKey: "color",
	 clickNavigate:true,

	fillOpacity : 0.5,
	    mapKey: "data-key",
	        areas:  [
' . $tooltip_string . '
			
			],
	
});



});'


);

?>