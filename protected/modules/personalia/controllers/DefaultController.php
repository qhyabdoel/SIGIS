<?php

class DefaultController extends Controller{
	public function filters(){
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request			
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules(){
		return array(
			array(
				'deny',				
				'actions' 	=> array('index'),
				'users' 	=> array('*'),
			),			
		);
	}

	public function actionIndex(){
		$this->render('index');
	}
}