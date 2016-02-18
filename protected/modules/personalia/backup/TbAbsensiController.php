<?php

class TbAbsensiController extends Controller{
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
				'allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions' 	=> array('index','per_karyawan','check', 'eksport_per_karyawan','eksport_index','verifikasi'),
				'users' 	=> array('@')
			),			
			array('deny','users'=>array('*')),
		);
	}

	public function actionCheck(){
		$jam_keluar 		= '01:00:00';
		$akhir_jam_kerja	= '01:00:00';

		echo $jam_keluar.', '.$akhir_jam_kerja.', ';
		echo date('H',strtotime($jam_keluar)-strtotime($akhir_jam_kerja));		
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id){
		$this->render('view',array('model'=>$this->loadModel($id)));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate(){		
		$model 		= new TbAbsensi;
		$max		= Yii::app()->db->createCommand('select max(Id_Absen) from tb_absensi')->queryScalar();
		$id 		= $max+1;		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TbAbsensi'])){			
			if ($_REQUEST['TbAbsensi']['NIK']){		
				$countKaryawan = Yii::app()->db
					->createCommand('select count(*) from tb_karyawan where NIK='.$_REQUEST['TbAbsensi']['NIK'])
					->queryScalar();
					
				if($countKaryawan!=0){
					$absensis = TbAbsensi::model()->findAllByAttributes(array(
						'Tanggal' 	=> date('Y-m-d'),
						'NIK_Absen' => $_REQUEST['TbAbsensi']['NIK']
					));

					$countAbsensi = count($absensis);

					if($countAbsensi=='0'){				
						$model->attributes 	= $_POST['TbAbsensi'];
						$model->Tanggal 		= date('Y-m-d');
						$model->Jam_Masuk		= date('H:i:s');

						if($model->validate()){							
							if($model->save()) Yii::app()->user->setFlash('success','Anda telah mencatat kehadiran masuk!');					
						}			
					}
					elseif($countAbsensi=='1'){				
						$sql 		= 'select * from tb_absensi where NIK='.$_REQUEST['TbAbsensi']['NIK'];		
						$model 		= TbAbsensi::model()->findBySql($sql);
						$seconds 	= strtotime(date('H:i:s'))-strtotime($model->Jam_Masuk);
						$hours 		= floor($seconds/3600);
						$minutes 	= floor(($seconds-($hours*3600))/60);
						$seconds 	= $seconds-(($minutes*60)+($hours*3600));
						$interval 	= $hours.':'.$minutes.':'.$seconds;
						
						$model->Jam_Keluar 			= date('H:i:s');
						$model->Total_Jam_Kerja 	= $interval;
						$model->save();						

						Yii::app()->user->setFlash('success','Anda telah mencatat kehadiran keluar!');
					}	
				}		
				else{
					Yii::app()->user->setFlash('error','Nik yang anda masukan salah');		
				}		
			}
			else Yii::app()->user->setFlash('error','Nik yang anda masukan salah');		
		}

		$model = new TbAbsensi;

		$this->render('create',array('model'=>$model,'id'=>$id,'date'=>date('d-m-Y')));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id){
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TbAbsensi'])){
			$model->attributes = $_POST['TbAbsensi'];
			if($model->save()) $this->redirect(array('view','id'=>$model->Id_Absen));
		}

		$this->render('update',array('model'=>$model));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id){
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax'])) $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex(){
		$this->state 	= 'Rekapitulasi Absensi';
		$karyawan 	 	= TbKaryawan::model()->findAll(array('order'=>'NIK_Absen'));
		$awal 			= '';
		$akhir 			= '';
		
		// get data from finger print machine
		Yii::app()->finger_print->scan;

		if(isset($_REQUEST['awal'])){
			$awal 	= $_REQUEST['awal'];
			$akhir 	= $_REQUEST['akhir'];			
		}

		$this->render('index',array('karyawans'=>$karyawan,'awal'=>$awal,'akhir'=>$akhir));
	}

	/**
	 * Lists all models per karyawan.
	 */	
	public function actionPer_karyawan(){		
		$this->state 	= 'Absensi per Karyawan';
		$url    		= Yii::app()->createUrl('site/report_absensi');
		$nik 			= '';
		$nama 			= '';
		$awal 		 	= '';
		$akhir 			= '';
		$jam_kerjas 	= CHtml::listData(TbJamKerja::model()->findAll(),'id','dropdown_list_data');

		$akhir_jam_kerja	= 0;
		$id 	 			= 0;

		// get data from finger print machine
		Yii::app()->finger_print->scan;

		if(isset($_REQUEST['nik'])){
			$awal 		= $_REQUEST['awal'];
			$akhir 		= $_REQUEST['akhir'];	
			$nik 		= $_REQUEST['nik'];
			$karyawan 	= TbKaryawan::model()->findByAttributes(array('NIK_Absen'=>$nik,'active'=>'1'));
			$id 	 	= $_REQUEST['jam_kerja'];
			
			if($id==0) $akhir_jam_kerja = TbJamKerja::model()->find()->akhir;
			else $akhir_jam_kerja = TbJamKerja::model()->findByPk($id)->akhir;

			if(count($karyawan)!=0){
				$nama = $karyawan->Nama;	
			}
			else Yii::app()->user->setFlash('error', 'Tidak ada data dengan nik:'.$_REQUEST['nik'].'.');
		}				
		
		$absensis = TbAbsensi::model()->findAll(array(
				'condition' => 'NIK = :NIK and Tanggal between :awal and :akhir',
				'params' 	=> array(':NIK'=>$nik, ':awal'=>$awal, ':akhir'=>$akhir),
				'order' 	=> 'Tanggal'
		));		

		$this->render('per_karyawan',array(		
			'akhir_jam_kerja' 	=> $akhir_jam_kerja,
			'jam_kerjas' 		=> $jam_kerjas,
			'absensis' 			=> $absensis,			
			'akhir' 			=> $akhir,
			'awal' 				=> $awal,
			'nama' 				=> $nama,
			'nik' 				=> $nik,
			'id' 				=> $id,
		));
	}

	// eksport models data per karyawan to excel format
	public function actionEksport_per_karyawan(){
		$nama = TbKaryawan::model()->findByAttributes(array('NIK_Absen'=>$_REQUEST['nik']))->Nama;				

		$query = 'select NIK, "'.$nama.'" 
			as Nama, Tanggal, Jam_Masuk, Jam_Keluar, Total_Jam_Kerja from tb_absensi where NIK = "'.$_REQUEST['nik'].'" 
			and Tanggal between "'.$_REQUEST['awal'].'" and "'.$_REQUEST['akhir'].'" order by Tanggal';
		
		$command = Yii::app()->eksport;

		$command->setGenerate($query, 2);
		$command->generate;		
	}

	// eksport models to excel format
	public function actionEksport_index(){
		$query = 'select tb_absensi.NIK, tb_karyawan.Nama, count(tb_absensi.NIK) 
			from tb_absensi 
			left join tb_karyawan 
			on tb_absensi.NIK = tb_karyawan.NIK_Absen 
			where Tanggal between "'.$_REQUEST['awal'].'" and "'.$_REQUEST['akhir'].'"
			group by tb_karyawan.Nama
			order by tb_absensi.NIK
			';

		$command = Yii::app()->eksport;

		$command->setGenerate($query, 1);
		$command->generate;		
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TbAbsensi('search');

		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['TbAbsensi']))
			$model->attributes=$_GET['TbAbsensi'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	// verifikasi absensi	
	public function actionVerifikasi()
	{
		$this->state 			= 'Verifikasi Absen';
		$cuti 					= new Cuti;
		$ijin 					= new Ijin;
		$sakit 					= new Sakit;
		$terlambat 				= new Terlambat;
		$karyawan_departemen	= '';		
		$karyawan_jabatan	 	= '';		
		$nama 					= '';
		$nik 					= '';		
		$masa_kerja 			= 0;
		$active_tab 			= 0;
		$masa_kerja_tahun 		= 0;
		$masa_kerja_bulan 		= 0;		
		$lama_ijins_sum			= 0;
		$lama_terlambats_sum	= 0;
		
		if(isset($_REQUEST['active_tab'])) $active_tab = $_REQUEST['active_tab'];		

		if(isset($_REQUEST['Cuti'])){
			$tanggalIjin 		= $_REQUEST['Ijin']['Tanggal_Awal'];
			$tanggalTerlambat 	= $_REQUEST['Terlambat']['Tanggal_Awal'];

			if($tanggalIjin!=''){				
				$bulanIjin 				= substr($tanggalIjin,5,2);			
				$bulanTerlambat 		= substr($tanggalTerlambat,5,2);
				$condition_ijins		= 'Tanggal_Awal like "_____'.$bulanIjin.'___"';
				$ijins 					= Ijin::model()->findAll(array('condition'=>$condition_ijins));
				$condition_terlambats 	= 'Tanggal_Awal like "_____'.$bulanTerlambat.'___"';
				$terlambats 			= Terlambat::model()->findAll(array('condition'=>$condition_terlambats));
				$lama_ijins_sum			= array_sum(CHtml::listData($ijins,'Lama_Ijin','Id'));
				$lama_terlambats_sum 	= array_sum(CHtml::listData($terlambats,'Lama_Terlambat','Id'));
			}			

			$cuti->attributes 		= $_REQUEST['Cuti'];
			$ijin->attributes 		= $_REQUEST['Ijin'];
			$sakit->attributes 		= $_REQUEST['Sakit'];
			$terlambat->attributes 	= $_REQUEST['Terlambat'];
		}

		if(isset($_REQUEST['nik'])){		
			$nik 		= $_REQUEST['nik'];
			$karyawan 	= TbKaryawan::model()->findByAttributes(array('NIK_Absen'=>$nik));			
			
			if(count($karyawan)!=0){				
				$nama 					= $karyawan->Nama;				
				$masa_kerja 			= $karyawan->Masa_Kerja;
				$masa_kerja_tahun 		= floor($masa_kerja/12);
				$masa_kerja_bulan 		= $masa_kerja%12;
				$karyawan_departemen 	= $karyawan->departemen->Nama_Department;
				$karyawan_jabatan 		= $karyawan->jabatan->Nama_Jabatan;
				$cuti 					= Cuti::model()->findByAttributes(array('NIK'=>$karyawan->NIK_Absen));
				$ijin 					= Ijin::model()->findByAttributes(array('NIK'=>$karyawan->NIK_Absen));
				$sakit 					= Sakit::model()->findByAttributes(array('NIK'=>$karyawan->NIK_Absen));
				$terlambat 				= Terlambat::model()->findByAttributes(array('NIK'=>$karyawan->NIK_Absen));

				if(count($cuti)==0) $cuti = new Cuti;
				if(count($ijin)==0) $ijin = new Ijin;
				if(count($sakit)==0) $sakit = new Sakit;
				if(count($terlambat)==0) $terlambat = new Terlambat;

				if(isset($_REQUEST['action']) and $_REQUEST['action']=='submit'){
					if($active_tab==0){										
						$cuti->save();
						if(count($cuti->getErrors())==0) Yii::app()->user->setFlash('success','Data cuti telah tersimpan');
					}
					elseif($active_tab==1){						
						$ijin->save();						
						if(count($ijin->getErrors())==0) Yii::app()->user->setFlash('success','Data ijin telah tersimpan.');
					}
					elseif($active_tab==2){
						$sakit->save();
						if(count($sakit->getErrors())==0) Yii::app()->user->setFlash('success','Data sakit telah tersimpan.');	
					}
					elseif($active_tab==3){
						$terlambat->save();
						if(count($terlambat->getErrors())==0) 
							Yii::app()->user->setFlash('success','Data terlambat telah tersimpan.');	
					}
				}
			}
			else Yii::app()->user->setFlash('error','data dengan nik = '.$nik.' tidak ditemukan.');			
		}

		$this->render('verifikasi',array(
			'nik' 					=> $nik,
			'nama' 					=> $nama,
			'cuti' 					=> $cuti,
			'ijin'					=> $ijin,
			'sakit'					=> $sakit,
			'terlambat'				=> $terlambat,
			'masa_kerja'			=> $masa_kerja,
			'active_tab'			=> $active_tab,
			'lama_ijins_sum'		=> $lama_ijins_sum,
			'karyawan_jabatan'		=> $karyawan_jabatan,
			'masa_kerja_bulan' 		=> $masa_kerja_bulan,
			'masa_kerja_tahun' 		=> $masa_kerja_tahun,
			'lama_terlambats_sum' 	=> $lama_terlambats_sum,
			'karyawan_departemen' 	=> $karyawan_departemen,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TbAbsensi the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TbAbsensi::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TbAbsensi $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tb-absensi-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
