<?php
/* @var $this ClusterController */
/* @var $dataProvider CActiveDataProvider */

$urlCreate = Yii::app()->createUrl('personalia/cluster/create');
$urlManage = Yii::app()->createUrl('personalia/cluster/admin');

$this->breadcrumbs=array(
	'Clusters',
);

$this->menu=array(
	array('label'=>'Create Cluster', 'url'=>array('create')),
	array('label'=>'Manage Cluster', 'url'=>array('admin')),
);
?>

<h1>Clusters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<br><br>

<a class="small-button" href="#">Close</a>
<a class="small-button" href="<?php echo $urlCreate; ?>">Create</a>
<a class="small-button" href="<?php echo $urlManage; ?>">Manage</a>