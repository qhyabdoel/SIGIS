<?php

class UnitController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout 	='//layouts/column2';
	public $state 	= 'Error';	

	/**
	 * @return array action filters
	 */
	public function filters()
	{		
		Yii::app()->unit_filter->filter;

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
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->state 	= 'Unit';

		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{		
		Yii::app()->perencanaan_filter->filter;
		
		$role 				= Yii::app()->user->roles;
		$model 				= new Unit;
		$this->state 		= 'Unit Baru';
		$data['project_id'] = '';		
		$data['projects']  	= CHtml::listData(Project::model()->findAll(),'id','project_name');		
		$data['clusters'] 	= array();
		$data['types']	  	= array();		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Unit']))
		{
			$model->attributes = $_POST['Unit'];			

			if($model->project_id!=0){
				$clusters 			= Cluster::model()->findAllByAttributes(array('project_id'=>$model->project_id));
				$types 				= Type::model()->findAllByAttributes(array('project_id'=>$model->project_id));
				$data['clusters'] 	= CHtml::listData($clusters,'id','cluster_name');		
				$data['types'] 		= CHtml::listData($types,'id','type_name');		
			}

			if($_REQUEST['save']!='false'){
				if($model->project_id==0) $model->project_id = '';								

				if($model->save()){					
					$id = Unit::model()->find(array('order'=>'id desc'))->id;
					$this->redirect(array('view','id'=>$id));
				}
			}				
		}

		$this->render('create',array(
			'model' => $model,
			'data' 	=> $data,
			'role' 	=> $role,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$role			= Yii::app()->user->roles;
		$model 			= $this->loadModel($id);
		$this->state 	= 'Update Unit';		
		$clusters		= Cluster::model()->findAllByAttributes(array('project_id'=>$model->project_id));
		$types 			= Type::model()->findAllByAttributes(array('project_id'=>$model->project_id));
		
		$data['clusters'] 	= CHtml::listData($clusters,'id','cluster_name');		
		$data['types'] 	 	= CHtml::listData($types,'id','type_name');
		$data['projects'] 	= CHtml::listData(Project::model()->findAll(),'id','project_name');		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Unit']))
		{			
			if($_POST['Unit']['project_id']==0) $_POST['Unit']['project_id'] = $model->project_id;

			$model->attributes 	= $_POST['Unit'];			
			$clusters			= Cluster::model()->findAllByAttributes(array('project_id'=>$model->project_id));
			$types 				= Type::model()->findAllByAttributes(array('project_id'=>$model->project_id));
			$data['clusters'] 	= CHtml::listData($clusters,'id','cluster_name');		
			$data['types'] 	 	= CHtml::listData($types,'id','type_name');

			if($_REQUEST['save']!='false') if($model->save()) $this->redirect(array('view','id'=>$model->id));							
		}

		$this->render('update',array(
			'model'=>$model,'data'=>$data,'role'=>$role,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$role 			= Yii::app()->user->roles;
		$this->state 	= 'Daftar Unit';

		$dataProvider=new CActiveDataProvider('Unit');
		$this->render('index',array(
			'dataProvider'	=> $dataProvider,
			'role' 			=> $role,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$role			= Yii::app()->user->roles;
		$model 			= new Unit('search');
		$this->state 	= 'Daftar Unit'; 

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Unit']))
			$model->attributes=$_GET['Unit'];

		$this->render('admin',array(
			'model' => $model,
			'role' 	=> $role,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Unit the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Unit::model()->findByPk($id);
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
