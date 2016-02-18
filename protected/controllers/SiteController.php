<?php

class SiteController extends Controller{
	public $state;

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
			array('deny',				
				'actions'=>array('personalia','karyawan','ketentuan','gaji',
					'bulanan','perhitungan','absensi','report_absensi','date_picker','tes','post'),
				'users'=>array('?'),
			),			
		);
	}

	public function actionTes(){
		$this->render('tes4');
	}

	public function actionPost(){
		$data = $_REQUEST['data'];
		echo "fuck ".$data;
	}

	/**
	 * Declares class-based actions.
	 */
	public function actions(){
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionCheck(){
		$proyeks = Proyek::model()->findAll();
		echo "<pre>";
		print_r($proyeks);
		echo "</pre>";
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex(){
		$this->state = 'SIG';
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError(){
		if($error=Yii::app()->errorHandler->error){
			if(Yii::app()->request->isAjaxRequest) echo $error['message'];
			else $this->render('error', $error);
		}
	}

	public function actionPersonalia(){
		$this->state = 'Personalia';
		$this->render('personalia');
	}

	public function actionKaryawan(){
		$this->state = 'Karyawan';
		$this->render('karyawan');	
	}

	public function actionKetentuan(){
		$this->state = 'Ketentuan Personalia';
		$this->render('ketentuan');
	}

	public function actionGaji(){
		$this->state = 'Gaji dan Upah';
		$this->render('gaji');	
	}

	public function actionBulanan(){
		$this->state = 'Gaji Bulanan';
		$this->render('bulanan');
	}

	public function actionPerhitungan(){
		$this->state = 'Gaji Bulanan';
		$this->render('perhitungan');
	}

	public function actionAbsensi(){
		$this->state = 'Absensi';
		$this->render('absensi');
	}

	public function actionReport_absensi(){
		$this->state = 'Report Absensi';
		$this->render('report_absensi');
	}

	public function actionRekapitulasi(){
		$this->state = 'Pilih Proyek';
		$state2 	 = 'rekapitulasi';

		$proyeks 			= CHtml::listData(Proyek::model()->findAll(),'name','name');
		$proyeks['add'] 	= 'Tambah Proyek';
		$proyeks['edit'] 	= 'Edit Proyek';

		$this->render('proyek',array('state'=>$state2,'proyeks'=>$proyeks));
	}

	public function actionPayroll(){
		$this->state = 'Pilih Proyek';
		$state2 	 = 'payroll';

		$proyeks 			= CHtml::listData(Proyek::model()->findAll(),'name','name');
		$proyeks['add'] 	= 'Tambah Proyek';
		$proyeks['edit'] 	= 'Edit Proyek';

		$this->render('proyek',array('state'=>$state2,'proyeks'=>$proyeks));
	}

	public function actionPendapatan(){
		setcookie('from','pendapatan',time()+24*3600,'/');

		$manual 			= 'false';
		$this->state 		= 'Pilih Proyek';
		$state2 	 		= 'pendapatan';
		$proyeks 			= CHtml::listData(Proyek::model()->findAll(),'name','name');
		$proyeks['add'] 	= 'Tambah Proyek';
		$proyeks['edit'] 	= 'Edit Proyek';

		if(isset($_REQUEST['manual'])) $manual = 'true';

		$this->render('proyek',array('state'=>$state2,'proyeks'=>$proyeks, 'manual'=>$manual));	
	}

	public function actionPotongan(){
		setcookie('from','potongan',time()+24*3600,'/');

		$this->state 		= 'Pilih Proyek';
		$state2 	 		= 'potongan';
		$proyeks 			= CHtml::listData(Proyek::model()->findAll(),'name','name');
		$proyeks['add'] 	= 'Tambah Proyek';
		$proyeks['edit'] 	= 'Edit Proyek';

		$this->render('proyek',array('state'=>$state2,'proyeks'=>$proyeks));
	}

	public function actionDate_picker(){
		$this->state = 'Contoh Datepicker';
		$this->render('date_picker_example');
	}

	public function actionTanggal_libur(){
		$this->state = 'Tanggal Libur';
		$this->render('tanggal_libur');
	}

	public function actionUser(){
		$this->state = 'User';
		$this->render('user');
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin(){
		$this->state 	= 'Login';
		$model 			= new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm'])){
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout(){
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}