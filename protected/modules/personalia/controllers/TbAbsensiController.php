<?php

class TbAbsensiController extends Controller{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout 	= '//layouts/column2';
	public $state 	= 'Error';
	
	const URLUPLOAD = "/../images/";

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
				'actions'=>array('index','per_karyawan','check','eksport_per_karyawan',
					'eksport_index','verifikasi','count_absen'),
				'users'=>array('@'),
			),			
			array('deny','users'=>array('*')),
		);
	}

	public function actionCheck(){		
		// echo Yii::app()->count_day->getNot_weekend('06-03-2015','10-03-2015','-');
		// $this->render('tes');

		$date = strtotime('2015-03-10');
		$date = date('d-m-Y',$date);

		echo $date;
	}
	
	public function actionView($id){
		
	}
	
	public function actionCreate(){		

	}
	
	public function actionUpdate($id){
		
	}
	
	public function actionDelete($id){
		
	}

	// Lists all models.
	public function actionIndex(){
		ini_set('max_execution_time', 300);
		
		// include('pullfpdata.php');

		$this->state 	= 'Rekapitulasi Absensi';	
		$awal 			= '';
		$akhir 			= '';
		$karyawan 		= TbKaryawan::model()->findAll(array('order'=>'NIK_Absen'));

		// Yii::app()->finger_print->scan;

		if(isset($_REQUEST['awal'])){
			$awal 	= $_REQUEST['awal'];
			$akhir 	= $_REQUEST['akhir'];			
		}		

		$this->render('index',array('karyawans'=>$karyawan,'awal'=>$awal,'akhir'=>$akhir));
	}

	// Lists all models per karyawan.
	public function actionPer_karyawan(){		
		ini_set('max_execution_time', 300);

		// $karyawan = TbAbsensi::model()->findByAttributes(array('NIK'=>14020,'Tanggal'=>'2015-01-19'));
		
		// print_r($karyawan->lembur);

		// die();

		// include('pullfpdata.php');

		$this->state 		= 'Absensi per Karyawan';
		$url    			= Yii::app()->createUrl('site/report_absensi');
		$karyawan_list		= CHtml::listData(TbKaryawan::model()->findAllByAttributes(array('active'=>1),array('order'=>'NIK_Absen')),'NIK_Absen','NIK_Absen');
		$nik 				= '';
		$nama 				= '';
		$awal 		 		= '';
		$akhir 				= '';
		$jam_kerjas 		= CHtml::listData(TbJamKerja::model()->findAll(),'id','dropdown_list_data');
		$akhir_jam_kerja	= 0;
		$awal_jam_kerja 	= 0;
		$id 	 			= 0;	
		$karyawan_count 	= 0;		

		// Yii::app()->finger_print->scan;

		if(isset($_REQUEST['nik'])){
			$karyawan 			= TbKaryawan::model()->findByAttributes(array('NIK_Absen'=>$_REQUEST['nik'],'active'=>'1'));
			$karyawan_count 	= count($karyawan);
			$awal 				= $_REQUEST['awal'];
			$akhir 				= $_REQUEST['akhir'];	
			$nik 				= $_REQUEST['nik'];				

			if(count($karyawan->jam_kerja_id)!=0) $id = $karyawan->jam_kerja_id;

			if($id==0){
				$akhir_jam_kerja 	= TbJamKerja::model()->find()->akhir;
				$awal_jam_kerja 	= TbJamKerja::model()->find()->awal;
			} 
			else{
				$akhir_jam_kerja 	= TbJamKerja::model()->findByPk($id)->akhir;	
				$awal_jam_kerja 	= TbJamKerja::model()->findByPk($id)->awal;	
				// echo $akhir_jam_kerja;
			} 			

			if(count($karyawan)!=0){
				$nama = $karyawan->Nama;	
			}
			else Yii::app()->user->setFlash('error', 'Tidak ada data dengan nik:'.$_REQUEST['nik'].'.');

			// echo $_REQUEST['action'];

			if($_REQUEST['action']=='submit'){				
				$absensi_karyawan = TbAbsenkar::model()->findByAttributes(
					array('Nik'=>$_REQUEST['nik_absen']),
					array('condition' => 'awal between "'.$awal.'" and "'.$akhir.'" or akhir between "'.$awal.'" and "'.$akhir.'"',)
				);

				if(count($absensi_karyawan)==0) $absensi_karyawan = new TbAbsenkar;										

				$absensi_karyawan->Nik  					= $_REQUEST['nik_absen'];
				$absensi_karyawan->Nama 					= $_REQUEST['nama'];
				$absensi_karyawan->Kehadiran_Maks 			= $_REQUEST['jumlah_maks'];
				$absensi_karyawan->Kehadiran_Kary 			= $_REQUEST['jumlah_hadir'];
				$absensi_karyawan->Jumlah_Lembur 			= $_REQUEST['total_lembur'];
				$absensi_karyawan->Jumlah_Keterlambatan  	= $_REQUEST['total_terlambat'];
				$absensi_karyawan->Jumlah_DLK 				= $_REQUEST['total_dlk'];
				$absensi_karyawan->awal 					= $awal;
				$absensi_karyawan->akhir 					= $akhir;
				$absensi_karyawan->save();

				Yii::app()->user->setFlash('success','data absensi karyawan berhasil disimpan.');				
			}
		}						

		$absensis = TbAbsensi::model()->findAll(array(
			'condition' => 'NIK = :NIK and Tanggal between :awal and :akhir',
			'params' 	=> array(':NIK'=>$nik, ':awal'=>$awal, ':akhir'=>$akhir),
			'order' 	=> 'Tanggal'
		));				

		$this->render('per_karyawan',array(		
			'akhir_jam_kerja' 	=> $akhir_jam_kerja,
			'awal_jam_kerja'	=> $awal_jam_kerja,
			'jam_kerjas' 		=> $jam_kerjas,
			'absensis' 			=> $absensis,			
			'akhir' 			=> $akhir,
			'awal' 				=> $awal,
			'nama' 				=> $nama,
			'nik' 				=> $nik,
			'id'				=> $id,
			'karyawan_count'	=> $karyawan_count,
			'karyawan_list'		=> $karyawan_list,
		));
	}

	public function actionCount_absen(){
		$nik 	= $_REQUEST['nik'];
		$awal 	= $_REQUEST['awal'];
		$akhir 	= $_REQUEST['akhir'];

		$absens = TbAbsenkar::model()->findAllByAttributes(
			array('Nik'=>$nik),
			array('condition' => 'awal between "'.$awal.'" and "'.$akhir.'" or akhir between "'.$awal.'" and "'.$akhir.'"',)
		);

		$count = count($absens);
		
		echo json_encode(array('nik'=>$nik,'awal'=>$awal,'akhir'=>$akhir,'count_absen'=>$count));
	}

	public function actionEksport_per_karyawan(){
		$nama = TbKaryawan::model()->findByAttributes(array('NIK_Absen'=>$_REQUEST['nik']))->Nama;

		$query = 'select NIK, "'.$nama.'" ,Tanggal, Jam_Masuk, Jam_Keluar, Total_Jam_Kerja 
			from tb_absensi where NIK = "'.$_REQUEST['nik'].'" 
			and Tanggal between "'.$_REQUEST['awal'].'" and "'.$_REQUEST['akhir'].'"';

		// $query = 'select tb_absensi.NIK, tb_karyawan.Nama, tb_absensi.Tanggal, 
		// 	tb_absensi.Jam_Masuk, tb_absensi.Jam_Keluar, tb_absensi.Total_Jam_Kerja
		// 	from tb_absensi left join tb_karyawan 
		// 	on tb_absensi.NIK = tb_karyawan.NIK_Absen 
		// 	where NIK = "'.$_REQUEST['nik'].'" and Tanggal between "'.$_REQUEST['awal'].'" and "'.$_REQUEST['akhir'].'"			
		// 	';
		
		$command = Yii::app()->eksport;

		$command->setGenerate($query, 2);
		$command->generate;		
	}

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
	public function actionAdmin(){
		$model = new TbAbsensi('search');

		$model->unsetAttributes();  // clear any default values		
		if(isset($_GET['TbAbsensi'])) $model->attributes=$_GET['TbAbsensi'];

		$this->render('admin',array('model'=>$model));
	}	

	public function actionVerifikasi(){
		$this->state 			= 'Verifikasi Absen';
		$role 					= Yii::app()->user->roles;
		$cuti 					= new CutiSementara;
		$ijin 					= new IjinSementara;
		$sakit 					= new Sakit;
		$terlambat 				= new TerlambatSementara;
		$lembur 				= new LemburSementara;
		$keluarkota				= new KeluarKotaSementara;
		$surat  				= new SuratSakit;
		$karyawan_departemen	= '';		
		$karyawan_jabatan	 	= '';		
		$nama 					= '';
		$nik 					= '';		
		$masa_kerja 			= 0;
		$active_tab 			= 0;
		$masa_kerja_tahun 		= 0;
		$masa_kerja_bulan 		= 0;		
		$lama_ijins_sum			= 12;
		$lama_terlambats_sum	= 12;
		$Cuti_Terpakai 		 	= $cuti->Cuti_Terpakai;
		$Sisa_Cuti 		 		= $cuti->Sisa_Cuti;
		$durasi_cuti 			= 0;
		$durasi_sakit 			= 0;
		$durasi_keluarkota 		= 0;
		$surat_sakits 			= array(0=>'--pilih--');
		
		//cek tab yang aktif pada form verifikasi
		if(isset($_REQUEST['active_tab'])) $active_tab = $_REQUEST['active_tab'];		

		//jika pada form verifikasi menekan tombol submit maka akan mengirim data CutiSementara.
		if(isset($_REQUEST['CutiSementara'])){						
			$tanggalIjin 		= $_REQUEST['IjinSementara']['Tanggal_Awal'];
			$tanggalTerlambat 	= $_REQUEST['TerlambatSementara']['Tanggal_Awal'];

			if($tanggalIjin!='' or $tanggalTerlambat!=''){							
				$bulanIjin 				= substr($tanggalIjin,5,2);			
				$bulanTerlambat 		= substr($tanggalTerlambat,5,2);
				$condition 				= 'NIK = "'.$_REQUEST['nik'].'" and Tanggal_Awal like "_____'.$bulanIjin.'___"';
				$ijins 					= Ijin::model()->find(array('condition'=>$condition,'order'=>'Id DESC'));
				$condition 				= 'NIK = "'.$_REQUEST['nik'].'" and Tanggal_Awal like "_____'.$bulanTerlambat.'___"';
				$terlambats  			= Terlambat::model()->find(array('condition'=>$condition,'order'=>'Id DESC'));
				
				if(count($ijins)!=0) $lama_ijins_sum = $ijins->Ijin_Bulanan;				
				if(count($terlambats)!=0) $lama_terlambats_sum = $terlambats->Terlambat_Bulanan;						

				echo $lama_terlambats_sum;														
			}			

			$cuti->attributes 			= $_REQUEST['CutiSementara'];						
			$ijin->attributes 			= $_REQUEST['IjinSementara'];
			$sakit->attributes 			= $_REQUEST['Sakit'];
			$terlambat->attributes 		= $_REQUEST['TerlambatSementara'];			
			$lembur->attributes 		= $_REQUEST['LemburSementara'];
			$keluarkota->attributes 	= $_REQUEST['KeluarKotaSementara'];
		}

		if(isset($_REQUEST['nik'])){								
			$nik 		= $_REQUEST['nik'];
			$karyawan 	= TbKaryawan::model()->findByAttributes(array('NIK_Absen'=>$nik));			
			$sakits 	= Sakit::model()->findAllByAttributes(array('NIK'=>$nik));			

			foreach ($sakits as $model) {
				$surat_sakits[$model->surat->image] = $model->surat->image;
			}
			
			if(count($karyawan)!=0){				
				$nama 					= $karyawan->Nama;				
				$masa_kerja 			= $karyawan->Masa_Kerja;
				$masa_kerja_tahun 		= floor($masa_kerja/12);
				$masa_kerja_bulan 		= $masa_kerja%12;
				$karyawan_departemen 	= $karyawan->departemen->Nama_Department;
				$karyawan_jabatan 		= $karyawan->jabatan->Nama_Jabatan;				

				$cuti 		= $karyawan->cuti;
				$ijin 		= $karyawan->ijin;				
				$lembur 	= $karyawan->lembur;

				if(isset($_REQUEST['CutiSementara']['Tanggal_Akhir'])){
					$a = $_REQUEST['CutiSementara']['Tanggal_Awal'];
					$b = $_REQUEST['CutiSementara']['Tanggal_Akhir'];

					if($a!='' and $b!='') $durasi_cuti = $karyawan->countDay($a,$b);
				}					

				$Cuti_Terpakai 	= $cuti->Cuti_Terpakai;
				$Sisa_Cuti 		= $cuti->Sisa_Cuti;

				if(count($karyawan->keluarkota_sementara)!=0) $keluarkota = $karyawan->keluarkota_sementara;				
								
				if(count($sakit)==0) $sakit = new Sakit;										

				if(isset($_REQUEST['action']) and $_REQUEST['action']=='submit'){
					$cuti->attributes 				= $_REQUEST['CutiSementara'];
					$ijin->attributes 				= $_REQUEST['IjinSementara'];
					$sakit->attributes 				= $_REQUEST['Sakit'];
					$terlambat->attributes 			= $_REQUEST['TerlambatSementara'];
					$lembur->attributes 			= $_REQUEST['LemburSementara'];
					$keluarkota->attributes 		= $_REQUEST['KeluarKotaSementara'];					
					$ijin->Lama_Ijin 				= $karyawan->countDay($ijin->Tanggal_Awal,$ijin->Tanggal_Akhir);
					$ijin->Ijin_Bulanan 			= $lama_ijins_sum - $ijin->Lama_Ijin;
					$terlambat->Lama_Terlambat 		= $karyawan->countDay($terlambat->Tanggal_Awal,$terlambat->Tanggal_Akhir);
					$terlambat->Terlambat_Bulanan 	= $lama_terlambats_sum - $terlambat->Lama_Terlambat;
					$cuti->Cuti_Terpakai 			= $karyawan->Cuti_Terpakai + $durasi_cuti;
					$cuti->Sisa_Cuti 				= $karyawan->Sisa_Cuti - $durasi_cuti;																	
					$durasi_sakit 					= $karyawan->countDay($sakit->Tanggal_Awal,$sakit->Tanggal_Akhir);
					$durasi_keluarkota 				= $karyawan->countDay($keluarkota->Tanggal_Awal,$keluarkota->Tanggal_Akhir);

					// echo $durasi_sakit;
					
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
						
						if(count($sakit->getErrors())==0){							
							Yii::app()->user->setFlash('success','Data sakit telah tersimpan.');	
						} 	

						$cekFile = $surat->image = CUploadedFile::getInstance($surat, 'image');					
             
			            if(empty($cekFile)){
			                $surat->attributes 	= $_POST['SuratSakit'];
			                $surat->sakit_id 	= $sakit->Id;
			                $surat->save();
			                echo $cekFile;		               
			            }
			            else{
			                $surat->attributes 	= $_POST['SuratSakit'];
			                $surat->sakit_id 	= $sakit->Id;
			                $surat->image 		= CUploadedFile::getInstance($surat, 'image');
			                 
			                if($surat->save()) $surat->image->saveAs(Yii::app()->basePath.self::URLUPLOAD.$surat->image.'');		                
			            }
					}
					elseif($active_tab==3){
						$terlambat->save();																
						if(count($terlambat->getErrors())==0) Yii::app()->user->setFlash('success','Data terlambat telah tersimpan.');	
					}
					elseif($active_tab==4){
						$lembur->save();
						if(count($lembur->getErrors())==0) Yii::app()->user->setFlash('success','Data lembur telah tersimpan.');		
					}
					elseif($active_tab==5){
						$keluarkota->save();
						if(count($keluarkota->getErrors())==0) Yii::app()->user->setFlash('success','Data keluar kota telah tersimpan.');								
					}					
				}
				else{
					$terlambat 	= $karyawan->terlambat;
					$cuti 		= $karyawan->cuti;					
					$sakit 		= new Sakit;
					$ijin 		= $karyawan->ijin;
					$keluarkota = $karyawan->keluarkota;
				}
			}
			else Yii::app()->user->setFlash('error','data dengan nik = '.$nik.' tidak ditemukan.');			
		}

		$this->render('verifikasi',array(
			'nik' 					=> $nik,
			'nama' 					=> $nama,
			'role' 					=> $role,
			'cuti' 					=> $cuti,
			'ijin'					=> $ijin,
			'sakit'					=> $sakit,
			'lembur' 				=> $lembur,
			'keluarkota'			=> $keluarkota,
			'terlambat'				=> $terlambat,
			'masa_kerja'			=> $masa_kerja,
			'active_tab'			=> $active_tab,
			'lama_ijins_sum'		=> $lama_ijins_sum,
			'karyawan_jabatan'		=> $karyawan_jabatan,
			'masa_kerja_bulan' 		=> $masa_kerja_bulan,
			'masa_kerja_tahun' 		=> $masa_kerja_tahun,
			'karyawan_departemen' 	=> $karyawan_departemen,
			'lama_terlambats_sum' 	=> $lama_terlambats_sum,
			'Cuti_Terpakai' 		=> $Cuti_Terpakai,
			'Sisa_Cuti' 			=> $Sisa_Cuti,
			'durasi_cuti' 			=> $durasi_cuti,
			'durasi_sakit' 			=> $durasi_sakit,
			'durasi_keluarkota' 	=> $durasi_keluarkota,
			'surat' 				=> $surat,
			'surats' 				=> $surat_sakits, 			
		));
	}	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TbAbsensi the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id){
		$model = TbAbsensi::model()->findByPk($id);
		if($model===null) throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TbAbsensi $model the model to be validated
	 */
	protected function performAjaxValidation($model){
		if(isset($_POST['ajax']) && $_POST['ajax']==='tb-absensi-form'){
			echo CActiveForm::validate($model);			
			Yii::app()->end();
		}
	}	

	public function countDay($awal,$akhir){
		$date_awal 		= strtotime($awal);
		$date_awal 		= date('d-m-Y',$date_awal);
		$date_akhir		= strtotime($akhir);
		$date_akhir		= date('d-m-Y',$date_akhir);
		$date_jumlah 	= Yii::app()->count_day->getNo_weekend($date_awal,$date_akhir,'-');

		return $date_jumlah;
	}
}
