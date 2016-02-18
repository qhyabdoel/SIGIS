<?php

class TbKetentuanPphController extends Controller{
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
				'actions'=>array('check','create'),
				'users'=>array('@'),
			),			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionCheck(){
		echo TbKaryawan::model()->find()->tarif_ptpkp;
	}	

	public function actionCreate(){
		$this->state 				= 'Ketentuan Pajak Pph21';						
		$ketentuan_pph 				= TbKetentuanPph::model()->find();
		$ketentuan_pph_saved 		= false;
		$ptkp_tarif_errors 			= array();
		$ptkp_tarif_errors_count 	= 0;
		$ptkps 						= TbPtkp::model()->findAll();

		if(count($ptkps)!=0){
			foreach($ptkps as $ptkp){
				$ptkp_tarif_errors[$ptkp->id] = '';
			}
		}			

		if(count($ketentuan_pph)==0) $ketentuan_pph = new TbKetentuanPph;

		if(isset($_REQUEST['proyek'])){
			$proyek = $_REQUEST['proyek'];
		}
		else $this->redirect(Yii::app()->createUrl('/site/potongan'));		

		if(isset($_POST) and $_POST!=array()){
			// print_r($_REQUEST['TbKetentuanPph']['batas_take_home_pay_1']);
			// die();

			$val = $_REQUEST['TbKetentuanPph']['batas_take_home_pay_1'];
			$_REQUEST['TbKetentuanPph']['batas_take_home_pay_1'] = str_replace('.', '', $val);

			$val = $_REQUEST['TbKetentuanPph']['batas_take_home_pay_2'];
			$_REQUEST['TbKetentuanPph']['batas_take_home_pay_2'] = str_replace('.', '', $val);			

			$ketentuan_pph->attributes = $_REQUEST['TbKetentuanPph'];
			$ketentuan_pph->save();			
			
			if(count($ketentuan_pph->getErrors())==0) $ketentuan_pph_saved = true;			
		}

		if($ketentuan_pph_saved==true){
			foreach($_REQUEST['ptkp2s'] as $post_ptkp){
				$ptkp 			= TbPtkp::model()->findByPk($post_ptkp['id']);
				$ptkp->tarif 	= str_replace('.', '', $post_ptkp['tarif']);;
				$ptkp->save();

				foreach($ptkp->getErrors() as $errs){
					foreach($errs as $err){
						$ptkp_tarif_errors[$post_ptkp['id']] = $err;						
					}
				}

				if(count($ptkp->getErrors())!=0) $ptkp_tarif_errors_count++;				
			}

			if($ptkp_tarif_errors_count==0) 
				Yii::app()->user->setFlash('success','data ketentuan pph berhasil disimpan.');
		}

		$ptkps = TbPtkp::model()->findAll();

		$this->render('create',array(
			'proyek' 			=> $proyek,
			'ptkps' 			=> $ptkps,
			'ketentuan_pph' 	=> $ketentuan_pph,
			'ptkp_tarif_errors' => $ptkp_tarif_errors,
		));
	}
}
