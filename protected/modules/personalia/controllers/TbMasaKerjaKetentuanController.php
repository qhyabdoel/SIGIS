<?php

class TbMasaKerjaKetentuanController extends Controller{
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
		$this->state 	= 'Masa Kerja';
		$url 			= 'create?action=create';	
		$masa_kerjas	= TbMasaKerjaKetentuan::model()->findAll();

		if(isset($_REQUEST['ketentuan'])){			
			$ketentuan = $_REQUEST['ketentuan'];
			if($ketentuan!='') $url = 'update/id/'.$ketentuan;
		}
		else $this->redirect(Yii::app()->createUrl('personalia/TbKetentuan/create'));
		
		$this->render('index',array('masa_kerjas'=>$masa_kerjas,'url'=>$url,'ketentuan'=>$ketentuan));
	}

	public function actionUpdate(){
		$this->state 	= 'Edit Golongan';		
		$url 		 	= 'create?action=create';
		$error 			= '';
 
		if(!isset($_REQUEST['ketentuan'])){
			$this->redirect(Yii::app()->createUrl('personalia/TbKetentuan/create'));
		}	 	
		
		$ketentuan 	= $_REQUEST['ketentuan'];

		if($ketentuan!='') $url = 'update/id/'.$ketentuan;

		if(!isset($_REQUEST['id'])){
	 		Yii::app()->user->setFlash('error','anda belum memilih data.');
	 		$this->redirect('index?ketentuan='.$ketentuan);
	 	}

	 	$masa_kerja = TbMasaKerjaKetentuan::model()->findByPk($_REQUEST['id']);
		
		if(isset($_REQUEST['action'])){
			if($_REQUEST['action']=='update'){
				$satuan 	= $_REQUEST['satuan'];
				$awal 		= $_REQUEST['awal'];
				$akhir 		= $_REQUEST['akhir'];
				$awal_akhir = $awal.'-'.$akhir;

				if($satuan=='tahun') $awal_akhir = ($awal*12).'-'.($akhir*12);

				if(is_numeric($awal) and is_numeric($akhir)){		
					if(0<=$awal and $awal<=$akhir){											
						$masa_kerja->masa_kerja 		= $awal_akhir;
						$masa_kerja->masa_kerja_tampil	= $awal.'-'.$akhir.' '.$satuan;
						$masa_kerja->save();

						if(isset($masa_kerja->getErrors()['masa_kerja'][0])) $error = $masa_kerja->getErrors()['masa_kerja'][0];
					}
					else $error = 'periode awal harus lebih kecil dari periode akhir.';
				}		
				else $error = 'data harus berupa angka.';

				if($error==''){
					Yii::app()->user->setFlash('success','data masa kerja berhasil disimpan.');
					$this->redirect('index?ketentuan='.$ketentuan);
				}				
			}
			elseif($_REQUEST['action']=='delete'){
				$masa_kerja->delete();
				Yii::app()->user->setFlash('success','data masa kerja berhasil dihapus.');
				$this->redirect('index?ketentuan='.$ketentuan);	
			}
		}

		// echo $golongan.', '.$ketentuan;

		$this->render('update',array('masa_kerja'=>$masa_kerja,'ketentuan'=>$ketentuan,'url'=>$url,'error'=>$error));
	}
}
