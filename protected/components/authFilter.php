<?php
	
	
class authFilter extends CFilter
{
	public $state;

	protected function preFilter($filterChain)
	{	
		if(Yii::app()->user->roles == 'superadmin') 
		{
			return true;
		} 
		
		else 
		{
			$this->state = 'Error';

			throw new CHttpException(403, 'Youre not authorized to see this page');
			return false;
				
		}		
	}

	protected function postFilter($filterChain)
	{
		// logic being applied after the action is executed
	}
}