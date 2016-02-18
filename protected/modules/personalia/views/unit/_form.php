<?php
/* @var $this UnitController */
/* @var $model Unit */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'unit-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<table>		
		<tr>
			<td><?php echo $form->labelEx($model,'kode'); ?></td>
			<td>
				<?php 
				
				$option = array();
				
				if($role=='perijinan'){
					$option = array('disabled'=>'true');	
					echo $form->textField($model,'kode',array('hidden'=>'true'));	
				} 
				elseif ($role=='perencanaan' and $model->status=='released') {
					$option = array('disabled'=>'true');	
					echo $form->textField($model,'kode',array('hidden'=>'true'));	
				}

				?>
				
				<?php echo $form->textField($model,'kode',$option); ?>
				<?php echo $form->error($model,'kode'); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'project_id'); ?></td>
			<td>

				<?php 
				
				$option = array('style'=>'width:173px;','id'=>'fieldProject');

				if($role=='perijinan') {
					$option = array('style'=>'width:173px;','id'=>'fieldProject','disabled'=>'true');
					echo $form->textField($model,'project_id',array('hidden'=>'true'));
				}
				elseif ($role=='perencanaan' and $model->status=='released') {
					$option = array('style'=>'width:173px;','id'=>'fieldProject','disabled'=>'true');
					echo $form->textField($model,'project_id',array('hidden'=>'true'));
				}
				
				?>

				<?php 
				
				$data['projects'][0] 							= ' --pilih-- ';
				if($model->project_id=='') $model->project_id 	= 0;

				echo $form->dropDownList($model,'project_id',$data['projects'],$option); 
				
				?>
				
				<?php echo $form->error($model,'project_id'); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'cluster_id'); ?></td>
			<td>
				<?php 				
				if($role=='perijinan'){
					echo $form->textField($model,'cluster_id',array('disabled'=>'true')); 
					echo $form->textField($model,'cluster_id',array('hidden'=>'true')); 
				}
				elseif ($role=='perencanaan' and $model->status=='released') {
					echo $form->textField($model,'cluster_id',array('disabled'=>'true')); 
					echo $form->textField($model,'cluster_id',array('hidden'=>'true')); 
				}
				else{
					if($model->project_id=='' or $model->project_id==0) echo $form->textField($model,'cluster_id',array('disabled'=>'true')); 
					else echo $form->dropDownList($model,'cluster_id',$data['clusters'],array('style'=>'width:173px;')); 					
				}				
				?>

				<?php echo $form->error($model,'cluster_id'); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'type_id'); ?></td>
			<td>
				<?php 
				if($role=='perijinan'){
					echo $form->textField($model,'type_id',array('disabled'=>'true')); 
					echo $form->textField($model,'type_id',array('hidden'=>'true')); 
				}
				elseif ($role=='perencanaan' and $model->status=='released') {
					echo $form->textField($model,'type_id',array('disabled'=>'true')); 
					echo $form->textField($model,'type_id',array('hidden'=>'true')); 
				}				
				else{
					if($model->project_id=='' or $model->project_id==0) echo $form->textField($model,'type_id',array('disabled'=>'true')); 
					else echo $form->dropDownList($model,'type_id',$data['types'],array('style'=>'width:173px;')); 								
				}				
				?>

				<?php echo $form->error($model,'type_id'); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'jalan'); ?></td>
			<td>
				<?php 
				$option = array();
				if($role=='perijinan'){
					$option = array('disabled'=>'true');	
					echo $form->textField($model,'jalan',array('hidden'=>'true'));
				} 
				elseif($role=='perencanaan' and $model->status=='released'){
					$option = array('disabled'=>'true');	
					echo $form->textField($model,'jalan',array('hidden'=>'true'));	
				}
				?>
				<?php echo $form->textField($model,'jalan',$option); ?>
				<?php echo $form->error($model,'jalan',$option); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'nomor'); ?></td>
			<td>
				<?php 
				$option = array();
				if($role=='perijinan') {
					$option = array('disabled'=>'true');
					echo $form->textField($model,'nomor',array('hidden'=>'true'));
				}
				elseif ($role=='perencanaan' and $model->status=='released') {
					$option = array('disabled'=>'true');
					echo $form->textField($model,'nomor',array('hidden'=>'true'));
				}
				?>
				<?php echo $form->textField($model,'nomor',$option); ?>
				<?php echo $form->error($model,'nomor'); ?>		
			</td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'lb'); ?></td>
			<td>
				<?php 
				$option = array();
				if($role=='perijinan') {
					$option = array('disabled'=>'true');
					echo $form->textField($model,'lb',array('hidden'=>'true'));
				}
				elseif ($role=='perencanaan' and $model->status=='released') {
					$option = array('disabled'=>'true');
					echo $form->textField($model,'lb',array('hidden'=>'true'));	
				}
				?>
				<?php echo $form->textField($model,'lb',$option); ?>
				<?php echo $form->error($model,'lb',$option); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'lt'); ?></td>
			<td>
				<?php 
				$option = array();
				if($role=='perijinan') {
					$option = array('disabled'=>'true');
					echo $form->textField($model,'lt',array('hidden'=>'true'));	
				}
				elseif ($role=='perencanaan' and $model->status=='released') {
					$option = array('disabled'=>'true');
					echo $form->textField($model,'lt',array('hidden'=>'true'));	
				}
				?>
				<?php echo $form->textField($model,'lt',$option); ?>
				<?php echo $form->error($model,'lt',$option); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'lb2'); ?></td>
			<td>
				<?php 
				$option = array();
				if($role=='perencanaan') {
					$option = array('disabled'=>'true');
					echo $form->textField($model,'lb2',array('hidden'=>'true'));
				}				
				?>
				<?php echo $form->textField($model,'lb2',$option); ?>
				<?php echo $form->error($model,'lb2'); ?>
			</td>
		</tr>	
		<tr>
			<td><?php echo $form->labelEx($model,'lt2'); ?></td>
			<td>
				<?php 
				$option = array();
				if($role=='perencanaan') {
					$option = array('disabled'=>'true');
					echo $form->textField($model,'lb2',array('hidden'=>'true'));
				}
				?>
				<?php echo $form->textField($model,'lt2',$option); ?>
				<?php echo $form->error($model,'lt2'); ?>
			</td>
		</tr>	
		<tr>
			<td><?php echo $form->labelEx($model,'lt_bpn'); ?></td>
			<td>
				<?php 
				$option = array();
				if($role=='perijinan') {
					$option = array('disabled'=>'true');
					echo $form->textField($model,'lt_bpn',array('hidden'=>'true'));	
				}
				elseif ($role=='perencanaan' and $model->status=='released') {
					$option = array('disabled'=>'true');
					echo $form->textField($model,'lt_bpn',array('hidden'=>'true'));	
				}
				?>
				<?php echo $form->textField($model,'lt_bpn',$option); ?>
				<?php echo $form->error($model,'lt_bpn'); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'status'); ?></td>
			<td>
				<?php 
				
				$statuss = array();
				
				if($role=='perencanaan' and $model->status==''){ 
					$statuss = array('new'=>'new');
				}
				elseif ($role=='perencanaan' and $model->status=='new') {
					$statuss = array('new'=>'new');
				}
				elseif ($role=='perencanaan' and $model->status=='hold') {
					$statuss = array('new'=>'hold');
				}
				elseif ($role=='perijinan' and $model->status=='new'){
					$statuss = array('new'=>'new','released'=>'released');
				}
				elseif ($role=='perijinan' and $model->status=='released') {
					$statuss = array('released'=>'released');
				}
				elseif ($role=='perijinan' and $model->status=='hold') {
					$statuss = array('hold'=>'hold','released'=>'released');	
				}
				elseif ($role=='perencanaan' and $model->status=='released') {
					$statuss = array('released'=>'released','hold'=>'hold');		
				}
				
				echo $form->dropDownList($model,'status',$statuss,array('style'=>'width:174px;')); 					
				?>
				
				<?php echo $form->error($model,'status'); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'kavling_area'); ?></td>
			<td>
				<?php 
				$option = array();
				
				if($role=='perijinan') {
					$option = array('disabled'=>'true');
					echo $form->textField($model,'kavling_area',array('hidden'=>'true'));
				}
				elseif ($role=='perencanaan' and $model->status=='released') {
					$option = array('disabled'=>'true');
					echo $form->textField($model,'kavling_area',array('hidden'=>'true'));
				}
				?>
				
				<?php echo $form->textField($model,'kavling_area',$option); ?>
				<?php echo $form->error($model,'kavling_area'); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $form->labelEx($model,'kavling_image'); ?></td>
			<td>
				<?php 
				$option = array();
				
				if($role=='perijinan') {
					$option = array('disabled'=>'true');
					echo $form->textField($model,'kavling_image',array('hidden'=>'true'));
				}
				elseif ($role=='perencanaan' and $model->status=='released') {
					$option = array('disabled'=>'true');
					echo $form->textField($model,'kavling_image',array('hidden'=>'true'));
				}
				?>
				
				<?php echo $form->textField($model,'kavling_image',$option); ?>
				<?php echo $form->error($model,'kavling_image'); ?>
			</td>
		</tr>		
	</table>											

	<input name="save" id="fieldSave" hidden>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('id'=>'buttonSubmit')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>

$('#fieldProject').change(function(){
	$('#fieldSave').val('false');
	$('#buttonSubmit').click();
});

</script>