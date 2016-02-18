
<?php

class TbKaryawanController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */

	public $layout 	= '//layouts/column2';		
	public $state;
	public $departmens;
	public $jabatans;	
	public $jam_kerjas;
	public $jam_kerjas2;
	public $salt;
	public $role;

	/**
	 * @return array action filters
	 */
	public function filters(){
		return array(
			'accessControl', 		// perform access control for CRUD operations
			'postOnly + delete', 	// we only allow deletion via POST request			
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
				'actions' 	=> array('create','update','index','disable','check','administrasi','surat','form_surat',
					'action','admin','request_verifikasi','verify'),
				'users' 	=> array('@'),
			),			
			array('deny','users'=>array('*')),
		);
	}

	public function actionCheck(){		
		$con = mysql_connect('localhost', 'root', '') or die("Unable to connect to MySQL");
	
		mysql_select_db('sigis2', $con);
			if (mysql_error()) {
			exit('Connection to <b>' . self::MYSQL_NAME . '</b> failed.');
		}

		$salt 			= '$2a$%13$' . strtr(openssl_random_pseudo_bytes(22), array('_' => '.', '~' => '/'));

		// $password adalah variabel untuk password yang di crypt
		$password 		= crypt('personalia',$salt);		

		// perintah sql untuk memasukan data ke tabel user
		$sql_command	= mysql_query('INSERT INTO user VALUES(6,"personalia","personalia@gmail.co","'.$password.'","admin")');
	}

	public function loadData(){
		$this->departmens 	= CHtml::listData(TbDepartmen::model()->findAll(),'Kode_Department','Nama_Department');
		$this->jabatans 	= CHtml::listData(TbJabatan::model()->findAll(),'Kode_Jabatan','Nama_Jabatan');
		$this->jam_kerjas 	= CHtml::listData(TbJamKerja::model()->findAll(),'id','dropdown_list_data');
		$this->salt 		= '$2a$%13$' . strtr(openssl_random_pseudo_bytes(22), array('_' => '.', '~' => '/'));
		$this->role 		= Yii::app()->user->roles;		
		$jam_kerja 			= TbJamKerja::model()->findByAttributes(array('name'=>'weekend'));
		$this->jam_kerjas2 	= array(0=>'libur',$jam_kerja->id=>$jam_kerja->dropdown_list_data);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id){
		$this->render('view',array('model'=>$this->loadModel($id)));
	}	

	//create new data
	public function actionCreate(){
		$this->state 	= 'Data Karyawan';				
		$this->loadData();

		if(isset($_REQUEST['password'])){			
			$password_hash 	= crypt($_REQUEST['password'],$this->salt);
			$data 			= array('password_hash'=>$password_hash,'roles'=>'superadmin');
			$countUser 		= count(User::model()->findAllByAttributes($data));
		}
		
		$query 				= 'select NIK from tb_karyawan order by NIK desc limit 1';
		$max				= Yii::app()->db->createCommand($query)->queryScalar();
		$model 				= new TbKaryawan;
		$form 				= '_form2';
		$nik 				= $max+1;		
		$message			= '';		
		$user 				= Yii::app()->user->name;
		$confirm 			= 0;
		$masa_kerja_bulan 	= 0;
		$masa_kerja_tahun 	= 0;
		$from 				= '';

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TbKaryawan'])){
			$nik 				= $_REQUEST['TbKaryawan']['NIK_Absen'];			
			$model->attributes 	= $_POST['TbKaryawan'];
			$karyawan 			= TbKaryawan::model()->find('NIK=:NIK',array(':NIK'=>$_POST['TbKaryawan']['NIK']));			

			if(isset($karyawan)){
				Yii::app()->user->setFlash('success', "Data telah tersimpan!");
				$form = '_form2';
			}
			else{
				$model->attributes 		= $_POST['TbKaryawan'];			
				$model->jam_kerja_id 	= $_REQUEST['TbKaryawan']['jam_kerja_id'];
			
				if($model->validate()){					
					if($model->save()){
						$form = '_form2';
						Yii::app()->user->setFlash('success', "Data berhasil disimpan!");
					}
				}
				else $form = '_form';				
			}			
		}
		else{			
			if(isset($_REQUEST['method'])){			
				if($_REQUEST['method']=='search'){	
					$karyawan = TbKaryawan::model()->findByAttributes(array('NIK_Absen'=>$_REQUEST['nik'],'active'=>1));					

					if(count($karyawan)!=0){
						$nik = $karyawan->NIK_Absen;
						$this->redirect(array('update','id'=>$nik));
						die();						
					}
					else{		
						Yii::app()->user->setFlash('error', "Tidak ada data dengan NIK:". $_REQUEST['nik'] ."!");
						$nik = 0;						
					}
				}
				elseif($_REQUEST['method']=='create'){				
					$form 	= '_form';
					$nik 	= $_REQUEST['nik'];
				}
				elseif($_REQUEST['method']=='cancel'){
					$this->redirect(array('/site/karyawan'));
				}
			}		
		}						

		$this->render('create',array(
			'masa_kerja_bulan' 	=> $masa_kerja_bulan,
			'masa_kerja_tahun' 	=> $masa_kerja_tahun,
			'departmens'		=> $this->departmens,
			'jabatans'			=> $this->jabatans,
			'jam_kerjas' 		=> $this->jam_kerjas,
			'jam_kerjas2'		=> $this->jam_kerjas2,
			'confirm'			=> $confirm,
			'model'				=> $model,			
			'form'				=> $form,
			'from'				=> $from,
			'nik' 				=> $nik,
		));
	}

	// public function actionEsc_update(){			
	// 	$id 				= $_REQUEST['TbKaryawan']['NIK_Absen'];
	// 	$model 				= TbKaryawan::model()->findByAttributes(array('NIK_Absen'=>$id));
	// 	$model->attributes 	= $_REQUEST['TbKaryawan'];

	// 	if($model->save()){
	// 		$form = '_form2';
	// 		Yii::app()->user->setFlash('success', "Data berhasil disimpan!");
	// 	}
	// }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id){
		$this->state 		= 'Data Karyawan';
		$this->loadData();

		$model 				= TbKaryawan::model()->findByAttributes(array('NIK_Absen'=>$id));
		$user 				= Yii::app()->user->name;
		$confirm 			= 0;
		$form 				= '_form';			
		$nik 				= $id;
		$masa_kerja_tahun 	= $model->masa_kerja_tahun;
		$masa_kerja_bulan 	= $model->masa_kerja_bulan;		
		$from 				= '';		

		if(isset($_REQUEST['password'])){			
			$password_hash 	= crypt($_REQUEST['password'],$this->salt);
			$countUser 		= count(User::model()->findAllByAttributes(array('password_hash'=>$password_hash,'roles'=>'superadmin')));
		}		

		if(isset($_REQUEST['from'])) $from = $_REQUEST['from'];

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TbKaryawan'])){
			$model->attributes 		= $_REQUEST['TbKaryawan'];
			$nik 					= $_REQUEST['TbKaryawan']['NIK_Absen'];
			$model->jam_kerja_id 	= $_REQUEST['TbKaryawan']['jam_kerja_id'];
			$model->jam_kerja_id_2 	= $_REQUEST['TbKaryawan']['jam_kerja_id_2'];			

			// echo "<pre>";
			// print_r($model);
			// echo "</pre>";
			// die();
			
			if($model->validate()){					
				if($model->save()){					
					Yii::app()->user->setFlash('success', "Data berhasil disimpan!");											
					$this->redirect(array($_REQUEST['from']));
					die();						
				}						
			}
			else $form = '_form';							
		}				

		$this->render('update',array(
			'masa_kerja_bulan' 	=> $masa_kerja_bulan,
			'masa_kerja_tahun' 	=> $masa_kerja_tahun,
			'departmens'		=> $this->departmens,
			'jabatans'			=> $this->jabatans,
			'jam_kerjas' 		=> $this->jam_kerjas,
			'jam_kerjas2'		=> $this->jam_kerjas2,
			'confirm'			=> $confirm,
			'model'				=> $model,
			'form' 				=> $form,
			'nik'				=> $nik,
		));
	}	

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id);

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionDisable($id)
	{
		$this->state 		= 'Data Karyawan';		
		$this->loadData();

		$model 				= TbKaryawan::model()->findByAttributes(array('NIK_Absen'=>$id));
		$form 				= '_form2';		
		$confirm 			= 0;
		$masa_kerja_tahun 	= floor($model->Masa_Kerja/12);
		$masa_kerja_bulan 	= $model->Masa_Kerja%12;		
		$from 				= '';

		if(isset($_REQUEST['from'])) $from = $_REQUEST['from'];

		$model->active 	= 0;
		$url 			= Yii::app()->createUrl('personalia/TbKaryawan/create');

		if(isset($_REQUEST['from'])){
			if($_REQUEST['from']=='index'){
				$url = Yii::app()->createUrl('personalia/TbKaryawan/index');				
			}
		}
			
		if($model->save()){
			Yii::app()->user->setFlash('success','Data telah dihapus');
			$this->redirect($url);
			die();
		}		

		$this->render('update',array(
			'masa_kerja_tahun' 	=> $masa_kerja_tahun,
			'masa_kerja_bulan' 	=> $masa_kerja_bulan,
			'model'				=> $model,
			'departmens'		=> $this->departmens,
			'jabatans'			=> $this->jabatans,
			'confirm'			=> $confirm,
			'button'			=> 'delete',
			'form' 				=> $form,
			'from'				=> $from,
			'nik'				=> $id,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex(){
		$this->state 	= 'Report Data Karyawan';
		$dataProvider 	= new CActiveDataProvider('TbKaryawan');
		$lists 			= $model = TbKaryawan::model()->findAll(array('order'=>'NIK_Absen'));		
		
		$this->render('index',array(
			'dataProvider' 	=> $dataProvider,			
			'lists'			=> $lists
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new TbKaryawan('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['TbKaryawan']))
			$model->attributes=$_GET['TbKaryawan'];

		$this->render('admin',array('model'=>$model));
	}

	public function actionAdministrasi()
	{
		$this->state = 'Administrasi Karyawan';

		$this->render('administrasi');
	}

	public function actionForm_surat()
	{
		$this->state = 'Input Form Surat';

		$this->render('form_surat');
	}

	public function actionSurat(){
		$this->state 	= 'Cetak Surat Personalia';
		$niks 			= CHtml::listData(TbKaryawan::model()->findAll(array('order'=>'NIK_Absen')),'NIK_Absen','NIK_Absen');
		$niks[0] 		= '--pilih--';
		$nik 			= 0;
		$jenis 			= 0;
		$awal 			= '';
		$akhir 			= '';
		$tanggung_jawab = 0;
		$view 			= 'cetak';
		$departemen		= 0;
		$jabatan 		= 0;

		if(isset($_REQUEST['nik'])){
			$nik 			= $_REQUEST['nik'];
			$jenis 			= $_REQUEST['jenis'];
			$tanggung_jawab = $_REQUEST['tanggung_jawab'];
			$awal 			= $_REQUEST['awal'];
			$akhir 			= $_REQUEST['akhir'];
			$departemen 	= $_REQUEST['departemen'];
			$jabatan 		= $_REQUEST['jabatan'];

			if($_REQUEST['action']=='save') $view = 'preview';
		} 

		// if(isset($_REQUEST['nik'])){
		// 	$this->render('preview');
		// }
		// else $this->render('cetak',array('niks'=>$niks));					

		$this->render($view,array(
			'nik'=>$nik,
			'niks'=>$niks,
			'jenis'=>$jenis,
			'awal'=>$awal,
			'akhir'=>$akhir,
			'tanggung_jawab'=>$tanggung_jawab,
			'departemen'=>$departemen,
			'jabatan'=>$jabatan,
		));
	}

	public function actionAction(){
		if(isset($_REQUEST['nik'])){
			if($_REQUEST['action']=='edit'){
				$this->redirect(array('update','id'=>$_REQUEST['nik'],'from'=>'index'));
			}
			elseif($_REQUEST['action']=='delete') $this->redirect(array('disable','id'=>$_REQUEST['nik'],'from'=>'index'));
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
		// include('pullfpdata.php');
		
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
			$request_time 	= $verification['verified'];
			$time_diff 		= new DateTime;
		    $time_diff 		= strtotime($row["datetime"]) - strtotime($request_time);			

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
	 * @return TbKaryawan the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id){
		$model = TbKaryawan::model()->findByPk($id);		
		if($model===null) throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TbKaryawan $model the model to be validated
	 */
	protected function performAjaxValidation($model){
		if(isset($_POST['ajax']) && $_POST['ajax']==='tb-karyawan-form'){
			echo CActiveForm::validate($model);			
			Yii::app()->end();
		}
	}
}