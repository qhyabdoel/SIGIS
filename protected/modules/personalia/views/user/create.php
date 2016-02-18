<?php
/* @var $this UnitController */
/* @var $model Unit */

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(
	'Personalia' 	=>array('/site/personalia'),
	'User'	 		=>array('/site/user'),
	'Input User',
);

foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}

$url 	= Yii::app()->createUrl('/site/user');
$form 	= $this->beginWidget('CActiveForm', array('id'=>'user-form','enableAjaxValidation'=>false,)); 

?>

<table>
	<tr>
		<td>Name</td>
		<td>
			<?php 

			echo $form->textField($model,'name');
			echo $form->error($model,'name');

			?>
		</td>
	</tr>
	<tr>
		<td>Email</td>
		<td>
			<?php 

			echo $form->textField($model,'email');
			echo $form->error($model,'email');

			?>
		</td>
	</tr>
	<tr>
		<td>Password</td>
		<td>
			<?php 

			echo $form->textField($model,'password_hash');
			echo $form->error($model,'password_hash');

			?>
		</td>
	</tr>
	<tr>
		<td>Roles</td>
		<td>			
			<?php 

			echo $form->dropDownList($model,'roles',array(
					'admin' 		=> 'admin',
					'superadmin' 	=> 'superadmin',
					'keuangan' 		=> 'keuangan',
					'perencanaan' 	=> 'perencanaan',
					'perijinan' 	=> 'perijinan',	
					'pemasaran' 	=> 'pemasaran',			
			 	),
			array('style'=>'width:174px;')
			); 

			echo $form->error($model,'roles');

			?>
		</td>
	</tr>
</table>

<button class="small-button">Create</button>
<a href="<?php echo $url; ?>" class="small-button">Close</a>

<?php

$this->endWidget();
