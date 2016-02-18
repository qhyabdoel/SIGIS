<?php

class TbKetentuanController extends Controller{
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
				'actions'=>array('create','update','disable',
					'index','action','add_masa_kerja','add_golongan',
					'tambah_golongan','tambah_masa_kerja', 'tambah_department', 'tambah_jabatan', 'check',
					'request_verifikasi','verify'),
				'users'=>array('@'),
			),			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionCheck(){
		// $karyawan = TbKaryawan::model()->findByAttributes(array('NIK_Absen'=>14020));

		// echo "<pre>";
		// print_r($karyawan->getKetentuan());
		// echo "</pre>";
		
		echo Yii::app()->user->roles;
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id){
		$this->render('view',array('model'=>$this->loadModel($id),));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate(){
		$this->state 	= 'Input Ketentuan Personalia';
		$form 		 	= '_form2';
		$model 		 	= new TbKetentuan;		
		$role 		 	= Yii::app()->user->roles;
		$salt 			= openssl_random_pseudo_bytes(22);
		$salt 			= '$2a$%13$' . strtr($salt, array('_' => '.', '~' => '/'));		
		$from 			= 'create';

		//jika password ada
		if(isset($_REQUEST['password'])){			
			$password_hash 	= crypt($_REQUEST['password'],$salt);			
			$users 			= User::model()->findAllByAttributes(array('password_hash'=>$password_hash,'roles'=>'superadmin'));
			$countUser 		= count($users);
		}
		
		//mengisi variale
		$departmens 		= CHtml::listData(TbDepartmen::model()->findAll(),'Kode_Department','Nama_Department');
		$golongans			= CHtml::listData(TbGolongan::model()->findAll(),'ID','Nama_golongan');
		$jabatans 			= CHtml::listData(TbJabatan::model()->findAll(),'Kode_Jabatan','Nama_Jabatan');
		$masa_kerja 		= CHtml::listData(TbMasakerjaKetentuan::model()->findAll(),'masa_kerja_tampil','masa_kerja_tampil');
		$confirm 			= 0;
		$sql 				= 'select ID from tb_ketentuan order by ID desc limit 1';
		$max				= Yii::app()->db->createCommand($sql)->queryScalar();
		$nik				= $max+1;		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TbKetentuan'])){			
			$model->attributes = $_REQUEST['TbKetentuan'];			

			$model->setConvertion($_REQUEST['TbKetentuan']);

			if($model->validate()){
				if($model->save()) Yii::app()->user->setFlash('success', 'Data berhasil di simpan');			
			}
			else $form ='_form';								
		}
		else{
			if(isset($_REQUEST['action'])){
				if($_REQUEST['action']=='search'){					
					$ketentuan = TbKetentuan::model()->findByAttributes(array('id'=>$_REQUEST['id'],'active'=>1));

					if(count($ketentuan)==0){
						Yii::app()->user->setFlash('error', 'Tidak ada data dengan id '.$_REQUEST['id'].'!');
					}
					else $this->redirect(array('update','id'=>$ketentuan->id));
				}
				elseif($_REQUEST['action']=='create'){
					$form = '_form';
				}
				elseif($_REQUEST['action']=='cancel'){
					$this->redirect(array('/site/ketentuan'));
				}
			}
		}		

		if(isset($_REQUEST['from'])) $from = $_REQUEST['from'];		

		$this->render('create',array(
			'nik'				=> $nik,
			'form'				=> $form,
			'from'				=> $from,
			'model'				=> $model,
			'confirm'			=> $confirm,
			'jabatans'			=> $jabatans,
			'golongans'			=> $golongans,
			'departmens' 		=> $departmens,
			'masa_kerja'		=> $masa_kerja,			
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id){
		$this->state 	= 'Ketentuan Personalia';
		$form 			= '_form';
		$model 			= $this->loadModel($id);
		$role 			= Yii::app()->user->roles;
		$salt 			= openssl_random_pseudo_bytes(22);
		$salt 			= '$2a$%13$' . strtr($salt, array('_' => '.', '~' => '/'));		
		$from 			= 'create';

		if(isset($_REQUEST['password'])){			
			$password_hash 	= crypt($_REQUEST['password'],$salt);
			$users 			= User::model()->findAllByAttributes(array('password_hash'=>$password_hash,'roles'=>'superadmin'));
			$countUser 		= count($users);
		}
		
		$departmens 		= CHtml::listData(TbDepartmen::model()->findAll(),'Kode_Department','Nama_Department');
		$golongans			= CHtml::listData(TbGolongan::model()->findAll(),'ID','Nama_golongan');		
		$jabatans 			= CHtml::listData(TbJabatan::model()->findAll(),'Kode_Jabatan','Nama_Jabatan');		
		$masa_kerja 		= CHtml::listData(TbMasakerjaKetentuan::model()->findAll(),'masa_kerja_tampil','masa_kerja_tampil');
		$confirm 			= 0;	
		$nik				= $id;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);		

		if(isset($_REQUEST['TbKetentuan'])){
			$model->attributes 	= $_POST['TbKetentuan'];							
			
			$model->setConvertion($_REQUEST['TbKetentuan']);

			if($model->save()) Yii::app()->user->setFlash('success', 'Data berhasil disimpan!');									
			
			$this->redirect(array($_REQUEST['from']));
			die();
		}

		if(isset($_REQUEST['from'])) $from = $_REQUEST['from'];		

		$this->render('update',array(			
			'masa_kerja'		=> $masa_kerja,
			'departmens' 		=> $departmens,
			'golongans'			=> $golongans,
			'jabatans'			=> $jabatans,
			'confirm'			=> $confirm,			
			'model'				=> $model,
			'form'				=> $form,
			'from'				=> $from,
			'nik'				=> $nik,
			'id'				=> $_REQUEST['id'],
			'disable'			=> 'false',
		));
	}

	public function actionDisable($id){		
		$model 				= $this->loadModel($id);		
		$from 				= Yii::app()->createUrl('personalia/TbKetentuan/create');		

		if(isset($_REQUEST['from'])) $from = Yii::app()->createUrl('personalia/TbKetentuan/'.$_REQUEST['from']);	
		
		$model->active = 0;
		$model->save();
		Yii::app()->user->setFlash('success', 'Data berhasil dihapus');
		$this->redirect($from);
		die();
	}

	public function actionAction(){
		if(!isset($_REQUEST['action'])){
			$this->redirect(array('index'));			
		}

		if(isset($_REQUEST['id'])){
			if($_REQUEST['action']=='edit'){
				$this->redirect(array('update','id'=>$_REQUEST['id'],'from'=>'index'));
			}
			elseif($_REQUEST['action']=='delete') $this->redirect(array('disable','id'=>$_REQUEST['id'],'from'=>'index'));
		}
		else{
			if($_REQUEST['action']=='edit'){
				Yii::app()->user->setFlash('error','anda belum memilih data untuk diedit.');
				$this->redirect('index');
			}
			elseif($_REQUEST['action']=='delete'){
				Yii::app()->user->setFlash('error','anda belum memilih data untuk dihapus.');	
				$this->redirect('index');
			}
		}
	}

	public function actionTambah_golongan(){
		$id 		= 1;
		$error 		= '';
		$golongan 	= TbGolongan::model()->find(array('order'=>'ID desc'));

		if(!isset($_REQUEST['text'])) $this->redirect('create');				

		if(count($golongan)!=0) $id = $golongan->ID+1;				

		$golongan 					= new TbGolongan;
		$golongan->Nama_golongan 	= $_REQUEST['text'];
		$golongan->save();		

		if(isset($golongan->getErrors()['Nama_golongan'][0])) $error = $golongan->getErrors()['Nama_golongan'][0];

		echo json_encode(array('value'=>$id,'text'=>$_REQUEST['text'],'error'=>$error));
	}

	public function actionTambah_masa_kerja(){
		$id 		= 1;
		$error 		= '';
		$masa_kerja = TbMasakerjaKetentuan::model()->find(array('order'=>''));
		$satuan 	= $_REQUEST['satuan'];

		if(!isset($_REQUEST['awal'])) $this->redirect('create');				

		if(count($masa_kerja)!=0) $id = $masa_kerja->Id+1;				

		$awal 		= $_REQUEST['awal'];
		$akhir 		= $_REQUEST['akhir'];
		$awal_akhir = $awal.'-'.$akhir;

		if($satuan=='tahun') $awal_akhir = ($awal*12).'-'.($akhir*12);

		if(is_numeric($awal) and is_numeric($akhir)){		
			if(0<=$awal and $awal<=$akhir){					
				$masa_kerja 					= new TbMasakerjaKetentuan;
				$masa_kerja->masa_kerja 		= $awal_akhir;
				$masa_kerja->masa_kerja_tampil	= $awal.'-'.$akhir.' '.$satuan;
				$masa_kerja->save();

				if(isset($masa_kerja->getErrors()['masa_kerja'][0])) $error = $masa_kerja->getErrors()['masa_kerja'][0];
			}
			else $error = 'periode awal harus lebih kecil dari periode akhir.';
		}		
		else $error = 'data harus berupa angka.';

		echo json_encode(array('value'=>$id,'text'=>$masa_kerja->masa_kerja_tampil,'error'=>$error));
	}

	public function actionTambah_department(){
		$id 		= 1;
		$error 		= '';
		$department = TbDepartmen::model()->find(array('order'=>'Kode_Department desc'));

		if(count($department)!=0) $id = $department->Kode_Department+1;

		if($_REQUEST['nama']!=''){
			$department 					= new TbDepartmen;
			$department->Nama_Department 	= $_REQUEST['nama'];
			$department->save();
		}
		else $error = 'nama harus diisi';

		echo json_encode(array('value'=>$id,'text'=>$_REQUEST['nama'],'error'=>$error));
	}

	public function actionTambah_jabatan(){
		$id 		= 1;
		$error 		= '';
		$jabatan 	= TbJabatan::model()->find(array('order'=>'Kode_Jabatan desc'));

		if(count($jabatan)!=0) $id = $jabatan->Kode_Jabatan+1;

		if($_REQUEST['nama']!=''){
			$jabatan 				= new TbJabatan;
			$jabatan->Nama_Jabatan	= $_REQUEST['nama'];
			$jabatan->save();
		}
		else $error = 'nama harus diisi.';

		echo json_encode(array('value'=>$id,'text'=>$_REQUEST['nama'],'error'=>$error));
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
		$this->state 	= 'Ketentuan Personalia';		
		$model 			= TbKetentuan::model()->findAllByAttributes(array('active'=>1));

		$this->render('index',array('model'=>$model));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin(){
		$model = new TbKetentuan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TbKetentuan'])) $model->attributes=$_GET['TbKetentuan'];
		$this->render('admin',array('model'=>$model,));
	}

	public function actionRequest_verifikasi(){
		date_default_timezone_set('Asia/Jakarta');		

		$host 	= "localhost"; 
        $user 	= "root";      
        $db 	= "sigis";  
        $conn 	= mysql_connect($host,$user,"");
        
        mysql_select_db($db,$conn);
 
        if ($conn) echo "Koneksi Berhasil";
        else echo "Koneksi Gagal";        

        $result 	= mysql_query('select count(*) as jumlah from verification');
        $result2 	= mysql_query('select max(id) as max_id from verification');
        $data 		= mysql_fetch_assoc($result);
        $data2 		= mysql_fetch_assoc($result2);

        if($data['jumlah']!=0) $No = $data2['max_id']+1;
        else $No = 1;        

		$hardware 	= 1;
		$nik 		= 8888;
		$workcode 	= 0;
		$status 	= 5;		
		$date 		= date('Y-m-d H:i:s');		

		$query = "insert into verification (id,hardware_id,pin,verified,workcode,status) 
			values('$No','$hardware','$nik','$date','$workcode','$status')";
		
		$exe = mysql_query($query);        

		print_r(mysql_error());
	}

	public function actionVerify(){
		$host 	= "localhost"; 
        $user 	= "root";      
        $db 	= "sigis";  
        $conn 	= mysql_connect($host,$user,"");
        
        mysql_select_db($db,$conn);
 
        // if ($conn) echo "Koneksi Berhasil";
        // else echo "Koneksi Gagal";        

        $query 			= 'select * from verification order by id desc limit 1';
        $verification	= mysql_fetch_assoc(mysql_query($query));
        $hw_id 			= $verification['hardware_id'];
        $PIN 			= $verification['pin'];        
        $Status 		= 5;
        $Workcode 		= $verification['workcode'];
        
        $select_query 	= 'SELECT * FROM raw WHERE hardware_id='.$hw_id. ' AND pin='.$PIN . ' AND status=' . $Status . ' AND workcode=' .$Workcode;
		$select_result 	= mysql_query($select_query);

		// print_r(mysql_fetch_array($select_result));

		$found = 0;

		while ($row = mysql_fetch_array($select_result,MYSQL_ASSOC)) {			
			$request_time = $verification['verified'];

			$time_diff = new DateTime;
		    $time_diff = strtotime($row["datetime"]) - strtotime($request_time);			

		    // echo "<br><br>";
		    // echo "request_time: ".$request_time.", verify: ".$row['datetime'].", time diff: ".$time_diff;
		    // echo "<br>";

			// if ($time_diff < 30 and $time_diff > 0) 
				$found = 1;			
		}

		// echo ": <br><br>".$found.", ".$time_diff;

		// print_r(mysql_error());

		if(count(mysql_error()==0)){
			if($found==1) echo json_encode(array('error'=>0,'found'=>1));
			else echo json_encode(array('error'=>0,'found'=>0));
		}
		else echo json_encode(array('error'=>1,'found'=>0));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TbKetentuan the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id){
		$model=TbKetentuan::model()->findByPk($id);
		if($model===null) throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param TbKetentuan $model the model to be validated
	 */
	protected function performAjaxValidation($model){
		if(isset($_POST['ajax']) && $_POST['ajax']==='tb-ketentuan-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
