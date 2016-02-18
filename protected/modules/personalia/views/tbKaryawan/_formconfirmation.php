<?php
/* @var $this TbKaryawanController */
/* @var $model TbKaryawan */
/* @var $form CActiveForm */
?>

<div class="form">

	<div class="row">
		<form action="/tigade/FC_Sistem_Personalia/index.php/tbkaryawan/create" method="post">
		<label>Masukan password superadmin untuk menyimpan data!</label>
		<br>
		<?php 
		// echo $form->numberField($model,'NIK',array('id'=>'nikField')); ?>
		<input name="password_superadmin">		
		<button id="buttonCreate">Create</button>	
		</form>
	</div>
	
</div><!-- form -->

<?php var_dump($model);