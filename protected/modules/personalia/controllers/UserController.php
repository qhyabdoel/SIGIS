<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout 	= '//layouts/column2';
	public $state 	= 'Error';	

	/**
	 * @return array action filters
	 */
	public function filters()
	{		
		return array(
			'accessControl', // perform access control for CRUD operations
			// 'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(			
			array(
				'allow',				
				'actions' 	=> array('create','update','index','admin','delete'),
				'users' 	=> array('@'),
			),			
			array('deny','users'=>array('*')),
		);
	}	
	
	public function actionCreate()
	{				
		$model = new User;

		if(isset($_REQUEST['User'])){
			$model->attributes 		= $_REQUEST['User'];
			$salt 					= '$2a$%13$' . strtr(openssl_random_pseudo_bytes(22), array('_' => '.', '~' => '/'));
			$model->password_hash 	= crypt($_REQUEST['User']['password_hash'],$salt);
			$model->id 				= User::model()->find(array('order'=>'id desc'))->id+1;
			$model->save();
			
			if(count($model->getErrors())==0) Yii::app()->user->setFlash('success','data user berhasil disimpan');			
		}

		$model = new User;
		
		$this->render('create',array('model'=>$model));
	}

	public function actionUpdate($id)
	{		
		if($_REQUEST['id']==''){
			Yii::app()->user->setFlash('error','anda belum memilih data user');
			$this->redirect(Yii::app()->createUrl('personalia/user/index'));
		}
		else{
			$this->state 			= 'Update User';
			$model  				= $this->loadModel($_REQUEST['id']);
			$password_hash 			= $model->password_hash;
			$model->password_hash 	= '';
			$salt 					= '$2a$%13$' . strtr(openssl_random_pseudo_bytes(22), array('_' => '.', '~' => '/'));

			if(isset($_REQUEST['User'])){
				$model->attributes 		= $_REQUEST['User'];

				if($model->password_hash=='') $model->password_hash = $password_hash;
				else $model->password_hash 	= crypt($_REQUEST['User']['password_hash'],$salt);

				$model->save();
				
				if(count($model->getErrors())==0){
					$model->password_hash = '';
					Yii::app()->user->setFlash('success','data user berhasil disimpan');
				}
			};
			
			$this->render('update',array('model'=>$model));
		}			
	}

	public function actionDelete($id)
	{
		$model = User::model()->findByPk($id);
		
		if(count($model)!=0){
			$model->delete();
			Yii::app()->user->setFlash('success','anda berhasil menghapus data user.');	
		} 
		else Yii::app()->user->setFlash('error','data user yang tidak ditemukan.');
		
		$this->redirect(Yii::app()->createUrl('personalia/user/index'));
	}
	
	public function actionIndex()
	{
		$this->state 	= 'Daftar User';
		$users 			= User::model()->findAll();

		$this->render('index',array('users'=>$users));
	}	
	
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Unit $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='unit-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
