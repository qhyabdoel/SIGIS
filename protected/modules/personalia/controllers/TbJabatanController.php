<?php

class TbJabatanController extends Controller{
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
		$this->state 		= 'Jabatan';
		$jabatans 	 		= TbJabatan::model()->findAll();
		$ketentuan 			= $_REQUEST['ketentuan'];
		$datas 				= array();		
		$ketentuan_count 	= count(Tbketentuan::model()->findByPk($_REQUEST['ketentuan']));
		$url 				= 'create?action=search&id='.$_REQUEST['ketentuan'];
		
		if($ketentuan_count==0) $url = 'create?action=create';				

		$this->render('index',array('jabatans'=>$jabatans,'url'=>$url,'datas'=>$datas,'ketentuan'=>$ketentuan));
	}

	public function actionUpdate(){				
		$this->state 		= 'Edit Jabatan';		
		$datas 				= array();		
		$ketentuan_count 	= count(Tbketentuan::model()->findByPk($_REQUEST['ketentuan']));
		$url 				= 'create?action=search&id='.$_REQUEST['ketentuan'];
		$ketentuan 			= $_REQUEST['ketentuan'];		
		
		if($ketentuan_count==0) $url = 'create?action=create';				

		if(!isset($_REQUEST['id'])){			
			Yii::app()->user->setFlash('error','anda belum memilih data jabatan.');			
			$this->redirect('index?ketentuan='.$_REQUEST['ketentuan']);
		}

		$jabatan = TbJabatan::model()->findByPk($_REQUEST['id']);

		if($_REQUEST['action']=='delete'){
			$jabatan->delete();
			Yii::app()->user->setFlash('success','data jabatan berhasil dihapus.');
			$this->redirect('index?ketentuan='.$_REQUEST['ketentuan']);
		}
		elseif($_REQUEST['action']=='update'){
			$jabatan->attributes = $_REQUEST['TbJabatan'];
			$jabatan->save();
			if(count($jabatan->getErrors())==0) Yii::app()->user->setFlash('success','data departemen berhasil disimpan');
			$this->redirect('index?ketentuan='.$_REQUEST['ketentuan']);
		}

		$this->render('update',array('jabatan'=>$jabatan, 'ketentuan'=>$ketentuan, 'datas'=>$datas, 'url'=>$url));
	}
}
