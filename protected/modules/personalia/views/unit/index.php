<?php
/* @var $this UnitController */
/* @var $dataProvider CActiveDataProvider */

$urlCreate = Yii::app()->createUrl('personalia/unit/create');
$urlManage = Yii::app()->createUrl('personalia/unit/admin');

$this->breadcrumbs=array(
	'Units',
);

$this->menu=array(
	array('label'=>'Create Unit', 'url'=>array('create')),
	array('label'=>'Manage Unit', 'url'=>array('admin')),
);
?>

<h1>Units</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<br><br>

<a class="small-button" href="#">Close</a>
<?php if($role=='perencanaan'){
	?><a class="small-button" href="<?php echo $urlCreate; ?>">Create</a> <?php
} ?>
<a class="small-button" href="<?php echo $urlManage; ?>">Manage</a>