<?php

class unitFilter extends CFilter
{	
	protected function getFilter()
	{
		$role = Yii::app()->user->roles;			
		
		if($role=='perencanaan' || $role=='perijinan' || $role=='pemasaran')
		{
			// return true;			
		}
		else
		{
			// return false;
			throw new CHttpException(403, 'Youre not authorized to see this page');		
		}
	}	
}

?>