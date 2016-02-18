<?php

class TbJamKerjaController extends Controller{
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
		$jam_kerjas = CHtml::listData(TbJamKerja::model()->findAll(),'id','dropdown_list_data');

		foreach($jam_kerjas as $jam_kerja){
			echo $jam_kerja;
		}
	}	

	public function actionAjax_create(){
		$name 		= $_REQUEST['name'];
		$awal 		= $_REQUEST['awal'];
		$akhir 		= $_REQUEST['akhir'];
		$id 		= 1;
		$jam_kerja 	= TbJamKerja::model()->find(array('order'=>'id desc'));
		$error 		= '';
		$text 		= $name.' ('.date('h:i',strtotime($awal)).' - '.date('h:i',strtotime($akhir)).')';;

		if(count($jam_kerja)!=0) $id = $jam_kerja->id+1;

		$jam_kerja 			= new TbJamKerja;
		$jam_kerja->name 	= $name;
		$jam_kerja->awal 	= $awal;
		$jam_kerja->akhir 	= $akhir;
		$jam_kerja->save();

		foreach($jam_kerja->getErrors() as $errors){
			foreach($errors as $err){
				$error = $err;
			}
		}					

		echo json_encode(array('text'=>$text,'value'=>$id,'error'=>$error));
	}

	public function actionIndex(){
		$this->state 	= 'Jam Kerja';
		$jam_kerjas 	= TbJamKerja::model()->findAll();
		$datas 			= array();

		if(!isset($_REQUEST['nik']) or !isset($_REQUEST['awal']) or !isset($_REQUEST['akhir'])) 
			$this->redirect('index?nik=&awal=&akhir');
		
		$datas['nik'] 	= $_REQUEST['nik'];
		$datas['awal'] 	= $_REQUEST['awal'];
		$datas['akhir'] = $_REQUEST['akhir'];
		$url 			= 'nik='.$datas['nik'].'&awal='.$datas['awal'].'&akhir='.$datas['akhir'];

		$this->render('index',array('jam_kerjas'=>$jam_kerjas,'url'=>$url,'datas'=>$datas));
	}

	public function actionUpdate(){		
		$this->state 	= 'Edit Jam Kerja';		
		$datas 			= array();

		if(!isset($_REQUEST['nik']) or !isset($_REQUEST['awal']) or !isset($_REQUEST['akhir'])) 
			$this->redirect('index?nik=&awal=&akhir');

		$datas['nik'] 	= $_REQUEST['nik'];
		$datas['awal'] 	= $_REQUEST['awal'];
		$datas['akhir'] = $_REQUEST['akhir'];
		$url 			= 'nik='.$datas['nik'].'&awal='.$datas['awal'].'&akhir='.$datas['akhir'];

		if(!isset($_REQUEST['id'])){
			Yii::app()->user->setFlash('error','anda belum memilih data jam kerja.');
			$this->redirect('index?'.$url);
		}

		$jam_kerja 		= TbJamKerja::model()->findByPk($_REQUEST['id']);

		if($_REQUEST['action']=='delete'){
			$jam_kerja->delete();
			Yii::app()->user->setFlash('success','data jam kerja berhasil dihapus.');
			$this->redirect('index?'.$url);
		}
		elseif($_REQUEST['action']=='update'){
			$jam_kerja->attributes = $_REQUEST['TbJamKerja'];
			$jam_kerja->save();
			if(count($jam_kerja->getErrors())==0) Yii::app()->user->setFlash('success','data jam kerja berhasil disimpan');
			$this->redirect('index?'.$url);
		}

		$this->render('update',array('jam_kerja'=>$jam_kerja,'url'=>$url,'datas'=>$datas));
	}
}
