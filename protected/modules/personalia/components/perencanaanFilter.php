<?php

class perencanaanFilter extends CFilter
{	
	protected function getFilter()
	{
		$role = Yii::app()->user->roles;					
		if($role!='perencanaan') throw new CHttpException(403, 'Youre not authorized to see this page');		
	}	
}

?>