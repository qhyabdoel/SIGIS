<?php

class TbKetentuanController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';
	public $state;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
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
						
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','disable','index'),
				'users'=>array('@'),
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionCheck()
	{
		// $max = Yii::app()->db->createCommand('select ID from tb_ketentuan order by ID desc limit 1')->queryScalar();
		// echo $max+1;
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
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
		$this->state = 'Input Ketentuan Personalia';
		$form 		 = '_form2';
		$model 		 = new TbKetentuan;		
		$role 		 = Yii::app()->user->roles;

		$salt 		= openssl_random_pseudo_bytes(22);
		$salt 		= '$2a$%13$' . strtr($salt, array('_' => '.', '~' => '/'));		

		if(isset($_REQUEST['password']))
		{			
			$password_hash = crypt($_REQUEST['password'],$salt);

			$countUser 	= Yii::app()->db
				->createCommand("select count(*) from user where roles = 'superadmin' and password_hash='".$password_hash."'")
				->queryScalar();
		}
		
		$departmens = CHtml::listData(TbDepartmen::model()->findAll(),'Kode_Department','Nama_Department');
		$golongans	= CHtml::listData(TbGolongan::model()->findAll(),'ID','Nama_golongan');
		$jabatans 	= CHtml::listData(TbJabatan::model()->findAll(),'Kode_Jabatan','Nama_Jabatan');
		$confirm 	= 0;
		$max		= Yii::app()->db->createCommand('select ID from tb_ketentuan order by ID desc limit 1')->queryScalar();
		$nik		= $max+1;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TbKetentuan']))
		{
			$model->attributes=$_POST['TbKetentuan'];

			if($model->validate())
			{
				if($role=='superadmin')
				{
					if($model->save())						
						Yii::app()->user->setFlash('success', 'Data berhasil di simpan');
				}
				else{
					if(isset($_REQUEST['password']))
					{
						if($countUser==1)
						{
							if($model->save())								
								Yii::app()->user->setFlash('success', 'Data berhasil di simpan');			
						}else
						{
							$confirm 	= 1;
							$form 		= '_form';
							Yii::app()->user->setFlash('error', 'Password yang anda masukan salah');			
						}
					}else
					{						
						$confirm 	= 1;
						$form 		= '_form';
					}
				}
			}
			else{
				$form ='_form';
			}					
		}
		else
		{
			if(isset($_REQUEST['action']))
			{
				if($_REQUEST['action']=='search')
				{
					$id = Yii::app()->db
						->createCommand("select id from tb_ketentuan where id = '".$_REQUEST['id']."' and active = 1")
						->queryScalar();		

					if($id=='')
					{
						Yii::app()->user->setFlash('error', 'Tidak ada data dengan id '.$_REQUEST['id'].'!');
					}
					else
					{
						$this->redirect(array('update','id'=>$id));
					}
				}
				elseif($_REQUEST['action']=='create')
				{
					$form = '_form';
				}
				elseif($_REQUEST['action']=='cancel')
				{
					$this->redirect(array('/site/ketentuan'));
				}
			}
		}		

		$this->render('create',array(
			'model'			=> $model,
			'form'			=> $form,
			'departmens' 	=> $departmens,
			'jabatans'		=> $jabatans,
			'golongans'		=> $golongans,
			'nik'			=> $nik,
			'confirm'		=> $confirm,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->state = 'Ketentuan Personalia';
		$form 		= '_form';
		$model 		= $this->loadModel($id);
		$role 		= Yii::app()->user->roles;

		$salt 		= openssl_random_pseudo_bytes(22);
		$salt 		= '$2a$%13$' . strtr($salt, array('_' => '.', '~' => '/'));		

		if(isset($_REQUEST['password']))
		{			
			$password_hash = crypt($_REQUEST['password'],$salt);

			$countUser 	= Yii::app()->db
				->createCommand("select count(*) from user where roles = 'superadmin' and password_hash='".$password_hash."'")
				->queryScalar();
		}
		
		$departmens = CHtml::listData(TbDepartmen::model()->findAll(),'Kode_Department','Nama_Department');
		$golongans	= CHtml::listData(TbGolongan::model()->findAll(),'ID','Nama_golongan');		
		$jabatans 	= CHtml::listData(TbJabatan::model()->findAll(),'Kode_Jabatan','Nama_Jabatan');
		$disable 	= 'false';
		$confirm 	= 0;	
		$nik		= $id;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);		

		if(isset($_POST['TbKetentuan']))
		{
			if($role=='superadmin')
			{	
				if($_REQUEST['TbKetentuan']['active']=='0')			
				{
					$model->active = 0;
					$model->save();
					Yii::app()->user->setFlash('success', 'Data berhasil dihapus!');			
				}
				else
				{
					$model->attributes = $_POST['TbKetentuan'];
					
					if($model->save())
						Yii::app()->user->setFlash('success', 'Data berhasil disimpan');
				}				
				$form = '_form2';
			}
			else
			{
				if(isset($_REQUEST['password']))
				{
					if($countUser==1)
					{
						if($_REQUEST['TbKetentuan']['active']=='0')			
						{
							$model->active = 0;
							$model->save();
							Yii::app()->user->setFlash('success', 'Data berhasil dihapus!');			
						}
						else
						{
							$model->attributes = $_POST['TbKetentuan'];
							
							if($model->save())
								Yii::app()->user->setFlash('success', 'Data berhasil disimpan!');
						}			

						$confirm 	= 0;
						$form 		= '_form2';						
					}
					else
					{
						$confirm 	= 1;
						$form 		= '_form';
						Yii::app()->user->setFlash('error', 'Password yang anda masukan salah');			

						if($_REQUEST['TbKetentuan']['active']=='0')
							$disable = 'true';
					}
				}else
				{			
					$model->attributes = $_REQUEST['TbKetentuan'];

					$confirm 	= 1;
					$form 		= '_form';

					if($_REQUEST['TbKetentuan']['active']=='0')
						$disable = 'true';
				}
			}
		}

		$this->render('update',array
		(
			'departmens' 	=> $departmens,
			'golongans'		=> $golongans,
			'jabatans'		=> $jabatans,
			'confirm'		=> $confirm,
			'disable'		=> $disable,
			'model'			=> $model,
			'form'			=> $form,
			'nik'			=> $nik,
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
		$this->state = 'Ketentuan Personalia';		

		$model = TbKetentuan::model()->findAll();

		$this->render('index',array(
			'model'=>$model
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TbKetentuan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TbKetentuan']))
			$model->attributes=$_GET['TbKetentuan'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TbKetentuan the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TbKetentuan::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TbKetentuan $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tb-ketentuan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
