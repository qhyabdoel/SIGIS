<?php

class TbDepartmenController extends Controller{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout 	= '//layouts/column2';
	public $state 	= 'Error';

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
			array(
				'allow',
				'actions' 	=> array('check','ajax_create','index','update'),
				'users' 	=> array('@'),
			),			
			array('deny','users'=>array('*')),
		);
	}

	public function actionCheck(){								
		
	}	

	public function actionAjax_create(){
		
	}

	public function actionIndex(){
		$this->state 		= 'Departemen';
		$departemens 		= TbDepartmen::model()->findAll();
		$ketentuan 			= $_REQUEST['ketentuan'];
		$datas 				= array();		
		$ketentuan_count 	= count(Tbketentuan::model()->findByPk($_REQUEST['ketentuan']));
		$url 				= 'create?action=search&id='.$_REQUEST['ketentuan'];
		
		if($ketentuan_count==0) $url = 'create?action=create';		

		// $url = 'ketentuan='.$_REQUEST['ketentuan'];

		$this->render('index',array('departemens'=>$departemens,'url'=>$url,'datas'=>$datas,'ketentuan'=>$ketentuan));
	}

	public function actionUpdate(){				
		$this->state 	= 'Edit Departemen';		
		$datas 			= array();
		
		$ketentuan_count 	= count(Tbketentuan::model()->findByPk($_REQUEST['ketentuan']));
		$url 				= 'create?action=search&id='.$_REQUEST['ketentuan'];
		
		if($ketentuan_count==0) $url = 'create?action=create';		

		// if(!isset($_REQUEST['nik']) or !isset($_REQUEST['awal']) or !isset($_REQUEST['akhir'])) {
		// 	Yii::app()->user->setFlash('error','anda belum memilih data jam kerja.');			
		// 	$this->redirect('index?nik=&awal=&akhir&ketentuan='.$_REQUEST['ketentuan']);
		// }

		$ketentuan 	= $_REQUEST['ketentuan'];		

		if(!isset($_REQUEST['id'])){			
			Yii::app()->user->setFlash('error','anda belum memilih data departemen.');			
			$this->redirect('index?ketentuan='.$_REQUEST['ketentuan']);
		}

		$departemen	= TbDepartmen::model()->findByPk($_REQUEST['id']);

		if($_REQUEST['action']=='delete'){
			$departemen->delete();
			Yii::app()->user->setFlash('success','data departemen berhasil dihapus.');
			$this->redirect('index?ketentuan='.$_REQUEST['ketentuan']);
		}
		elseif($_REQUEST['action']=='update'){
			$departemen->attributes = $_REQUEST['TbDepartmen'];
			$departemen->save();
			if(count($departemen->getErrors())==0) Yii::app()->user->setFlash('success','data departemen berhasil disimpan');
			$this->redirect('index?ketentuan='.$_REQUEST['ketentuan']);
		}

		$this->render('update',array('departemen'=>$departemen, 'ketentuan'=>$ketentuan, 'datas'=>$datas, 'url'=>$url));
	}
}
