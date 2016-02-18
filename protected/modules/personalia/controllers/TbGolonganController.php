<?php

class TbGolonganController extends Controller{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';
	public $state;

	/**
	 * @return array action filters
	 */
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('check','index','update'),
				'users'=>array('@'),
			),			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionCheck(){
		
	}

	public function actionIndex(){
		$this->state 	= 'Golongan';
		$url 			= 'create?action=create';	
		$golongans 		= TbGolongan::model()->findAll();		

		if(isset($_REQUEST['ketentuan'])){			
			$ketentuan = $_REQUEST['ketentuan'];
			if($ketentuan!='') $url = 'update/id/'.$ketentuan;
		}
		else $this->redirect(Yii::app()->createUrl('personalia/TbKetentuan/create'));
		
		$this->render('index',array('golongans'=>$golongans,'url'=>$url,'ketentuan'=>$ketentuan));
	}

	public function actionUpdate(){
		$this->state = 'Edit Golongan';		
		$url 		 = 'create?action=create';
 
		if(!isset($_REQUEST['ketentuan']))
			$this->redirect(Yii::app()->createUrl('personalia/TbKetentuan/create'));
		
		$ketentuan 	= $_REQUEST['ketentuan'];

		if($ketentuan!='') $url = 'update/id/'.$ketentuan;

		if(!isset($_REQUEST['id'])){
	 		Yii::app()->user->setFlash('error','anda belum memilih data.');
	 		$this->redirect('index?ketentuan='.$ketentuan);
	 	}

	 	$golongan = TbGolongan::model()->findByPk($_REQUEST['id']);
		
		if(isset($_REQUEST['action'])){
			if($_REQUEST['action']=='update'){
				$golongan->attributes = $_REQUEST['TbGolongan'];
				$golongan->save();
				Yii::app()->user->setFlash('success','data golongan berhasil disimpan.');
				$this->redirect('index?ketentuan='.$ketentuan);
			}
			elseif($_REQUEST['action']=='delete'){
				$golongan->delete();
				Yii::app()->user->setFlash('success','data golongan berhasil dihapus.');
				$this->redirect('index?ketentuan='.$ketentuan);	
			}
		}

		// echo $golongan.', '.$ketentuan;

		$this->render('update',array('golongan'=>$golongan,'ketentuan'=>$ketentuan,'url'=>$url));
	}
}
