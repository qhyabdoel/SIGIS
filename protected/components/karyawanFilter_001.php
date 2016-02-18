<?php

class karyawanFilter_001 extends CFilter
{	
	protected function preFilter($filterChain)
	{
		$role = Yii::app()->user->roles;	
		
		if($role=='admin' || $role='superadmin')
		{
			return true;
		}
		else
		{
			return false;
			throw new CHttpException(403, 'Youre not authorized to see this page');
		}
	}

	protected function postFilter($filterChain)
	{
		// logic being applied after the action is executed		
		
	}


}

?>