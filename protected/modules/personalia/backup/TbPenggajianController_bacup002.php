<?php

class TbPenggajianController extends Controller{
	public $state;

	/**
	 * @return array action filters
	 */
	public function filters(){
		return array('accessControl','postOnly + delete');
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
				'actions'=>array(				
					'slip','input','rekapitulasi','payroll','perhitungan','bpjs','tes',
					'pendapatan','potongan','kasbon','Pph','ketentuan_pajak','add_proyek'
				),
				'users'=>array('@'),
			),			
			array('deny','users'=>array('*')),
		);
	}

	public function actionTes(){
		
	}

	public function actionInput(){
		$karyawans 					= TbKaryawan::model()->findAllByAttributes(array('active'=>1),array('order'=>'NIK_Absen'));
		$proyeks 					= array('SIL');
		$gaji_karyawans 			= array();		
		$penggajians 				= array();
		$this->state 				= 'Gaji All PT';
		$view 						= 'input';
		$total_tunjangan_jabatan 	= '';
		$total_pendapatan_intern 	= '';
		$total_gaji_pokok 			= '';
		$akhir 						= '';
		$awal 						= '';
		$proyeks_count 				= 1;		

		if(isset($_REQUEST['action']) and $_REQUEST['action']!=''){
			$times 		= $_REQUEST['proyeks_count'];
			$proyeks 	= array();

			if($_REQUEST['action']=='tambah'){					
				for($i=0;$i<$times;$i++){
					$numb 		= $i+1;
					$proyeks[] 	= $_REQUEST['proyeks'][$numb];
				}

				if($_REQUEST['proyek']==''){
					Yii::app()->user->setFlash('error','Masukan nama proyek terlebih dahulu!');
				}
				elseif(in_array($_REQUEST['proyek'], $proyeks)){
					Yii::app()->user->setFlash('error','Proyek sudah ada.');
				}
				else $proyeks[] = $_REQUEST['proyek'];				

				$proyeks_count = count($proyeks);
			}
			elseif($_REQUEST['action']=='hapus'){
				$proyeks_post = array();

				for($i=0;$i<$times;$i++){
					$numb 			= $i+1;
					$proyeks_post[] = $_REQUEST['proyeks'][$numb];

					if($_REQUEST['proyeks'][$numb]!=$_REQUEST['proyek']){
						$proyeks[] = $_REQUEST['proyeks'][$numb];
					}					
				}				

				if(count($proyeks)==0){
					$proyeks[] = $_REQUEST['proyeks'][$numb];
					Yii::app()->user->setFlash('error','Proyek tidak boleh kosong.');
				}
				
				if(!in_array($_REQUEST['proyek'], $proyeks_post)) Yii::app()->user->setFlash('error','Proyek yang akan dihapus tidak ada.');				
				if($_REQUEST['proyek']=='') Yii::app()->user->setFlash('error','Masukan nama proyek terlebih dahulu!');				

				$proyeks_count 	= count($proyeks);					
			}
		}
		else{
			if(isset($_REQUEST['is_save'])){
				$times 		= $_REQUEST['proyeks_count'];
				$proyeks 	= array();
				$awal 		= $_REQUEST['awal'];
				$akhir 		= $_REQUEST['akhir'];				
				
				for($i=0;$i<$times;$i++){
					$numb 		= $i+1;
					$proyek 	= $_REQUEST['proyeks'][$numb];
					$proyeks[] 	= $proyek;									

					if($awal=='' or $akhir==''){																							
						Yii::app()->user->setFlash('error','Periode awal dan akhir harus diisi.');
					}
					elseif ($awal > $akhir){
						Yii::app()->user->setFlash('error','Awal periode harus lebih kecil daripada akhir periode.');	
					}
					else{
						foreach ($karyawans as $karyawan){
							if ($karyawan->active == 1){
								$penggajian 					= new TbPenggajianProyek;
								$penggajian->awal 				= $awal;
								$penggajian->akhir 				= $akhir;
								$penggajian->proyek 			= $proyek;
								$penggajian->NIK 				= $karyawan->NIK_Absen;
								$penggajian->gaji_pokok 		= $_REQUEST['gaji_pokok'][$karyawan->NIK_Absen][$numb];
								$penggajian->tunjangan_jabatan 	= $_REQUEST['tunjangan_jabatan'][$karyawan->NIK_Absen][$numb];
								$penggajian->pendapatan_intern 	= $_REQUEST['pendapatan_intern'][$karyawan->NIK_Absen][$numb];
								
								if($penggajian->validate()){}
								else{
									echo "<pre>";
									print_r($penggajian->getErrors());
									echo "</pre>";
								}
								
								$penggajian->save();
								
								$penggajians[] = TbPenggajianProyek::model()->findByPK($penggajian->id);

								if($total_gaji_pokok==''){
									$total_gaji_pokok = $penggajian->gaji_pokok;									
									if($total_gaji_pokok=='') $total_gaji_pokok=0;									
								}
								elseif ($total_gaji_pokok!=''){
									$total_gaji_pokok = $total_gaji_pokok+$penggajian->gaji_pokok;
								}

								if($total_tunjangan_jabatan==''){
									$total_tunjangan_jabatan = $penggajian->tunjangan_jabatan;
									if($total_tunjangan_jabatan=='') $total_tunjangan_jabatan=0;									
								}
								elseif($total_tunjangan_jabatan!='') 
									$total_tunjangan_jabatan = $total_tunjangan_jabatan+$penggajian->tunjangan_jabatan;								

								if($total_pendapatan_intern==''){
									$total_pendapatan_intern = $penggajian->pendapatan_intern;
									if($total_pendapatan_intern=='') $total_pendapatan_intern=0;									
								}
								elseif($total_pendapatan_intern!='') 
									$total_pendapatan_intern = $total_pendapatan_intern+$penggajian->pendapatan_intern;								
							}				
						}

						Yii::app()->user->setFlash('success','Data berhasil disimpan.');

						$view = 'input_report';
					}											
				}				

				$proyeks_count = count($proyeks);
			}			
		}

		$this->render($view,array(		
			'total_tunjangan_jabatan' 	=> $total_tunjangan_jabatan,
			'total_pendapatan_intern' 	=> $total_pendapatan_intern,
			'total_gaji_pokok' 			=> $total_gaji_pokok,
			'proyeks_count' 			=> $proyeks_count,
			'penggajians'				=> $penggajians,
			'karyawans' 				=> $karyawans,
			'proyeks' 					=> $proyeks,
			'akhir'						=> $akhir,
			'awal' 						=> $awal,
		));
	}

	public function actionAdd_proyek(){

	}

	public function actionPayroll(){
		$this->state = 'Payroll';
		$this->redirect(array('rekapitulasi?proyek='.$_REQUEST['proyek'].'&action2=payroll'));
	}

	public function actionRekapitulasi(){
		if(isset($_REQUEST['action2']) and $_REQUEST['action2']=='payroll'){
			$action2 		= 'payroll';
			$breadcrumb 	= 'Payroll';
			$this->state 	= 'Payroll';
			$url 			= '/site/payroll';
			$url2 			= Yii::app()->createUrl('site/payroll');
		}
		else{
			$action2 		= '';
			$breadcrumb 	= 'Rekapitulasi Gaji Bulanan';
			$this->state 	= 'Rekapitulasi Gaji Bulanan';
			$url 			= '/site/rekapitulasi';
			$url2 			= Yii::app()->createUrl('site/rekapitulasi');
		}			

		$proyek 	= '';
		$karyawans 	= '';
		$awal 		= '';
		$akhir 		= '';
		$bank 		= '';
		$edit 		= '';
		
		if(isset($_REQUEST['proyek']) and $_REQUEST['proyek']!=''){			
			$proyek = $_REQUEST['proyek'];
			
			if(isset($_REQUEST['bank'])){	
				$awal 	= $_REQUEST['awal'];
				$akhir 	= $_REQUEST['akhir'];
				$edit 	= $_REQUEST['edit'];				

				if($awal=='' or $akhir==''){
					Yii::app()->user->setFlash('error','awal periode dan akhir periode harus diisi.');
				}
				elseif($awal>$akhir){
					Yii::app()->user->setFlash('error','awal periode harus lebih kecil dari akhir periode.');
				}
				else{
					$karyawans = TbKaryawan::model()->findAllByAttributes(					
						array(
							'Bank_Rek' 	=> $_REQUEST['bank'],
							'active' 	=> 1
						),					
						array('order'=>'NIK_Absen')
					);
				}
				
				$bank = $_REQUEST['bank'];
			}			
		}		
		else
			$this->redirect(array('/site/rekapitulasi'));

		$this->render('rekapitulasi',array(			
			'breadcrumb' 	=> $breadcrumb,
			'karyawans' 	=> $karyawans,
			'action2' 		=> $action2,
			'proyek' 		=> $proyek,
			'akhir' 		=> $akhir,
			'awal' 			=> $awal,
			'bank' 			=> $bank,
			'edit' 			=> $edit,
			'url2' 			=> $url2,
			'url' 			=> $url,
		));
	}

	public function actionSlip(){
		$this->state = 'Periode Penggajian';

		if(isset($_REQUEST['action'])){
			if($_REQUEST['action']=='ok'){
				$awal 	= $_REQUEST['awal'];
				$akhir 	= $_REQUEST['akhir'];

				if($awal=='' or $akhir==''){
					Yii::app()->user->setFlash('error','awal dan akhir periode harus diisi.');

					$this->render('periode');
				}
				elseif($awal>$akhir){
					Yii::app()->user->setFlash('error','awal periode harus lebih kecil nilainya dari akhir periode.');

					$this->render('periode');
				}
				else{
					$this->state = 'Laporan Gaji Karyawan (Slip Gaji)';

					$this->render('slip',array(											
						'jabatan' 			=> '_',
						'akhir' 			=> $akhir,
						'awal' 				=> $awal,
						'nama' 				=> '_',
						'nik' 				=> ''
					));
				}				
			}
			else $this->redirect(array('/site/bulanan'));			
		}
		elseif(isset($_REQUEST['nik'])) 
		{	
			$this->state 	= 'Laporan Gaji Karyawan (Slip Gaji)';
			$nik 			= $_REQUEST['nik'];
			$karyawan 		= TbKaryawan::model()->findByAttributes(array('NIK_Absen'=>$nik,'active'=>1));

			if(count($karyawan)==0){				
				Yii::app()->user->setFlash('error','data karyawan tidak ditemukan.');				

				$this->render('slip',array(
					'awal' 					=> $_REQUEST['awal'],
					'akhir' 				=> $_REQUEST['akhir'],
					'kali_lembur' 			=> $_REQUEST['kali_lembur'],
					'kali_luar_kota' 		=> $_REQUEST['kali_luar_kota'],					
					'kali_makan_transport' 	=> $_REQUEST['kali_makan_transport'],
				));
								
				die();
			}

			$nama 			= $karyawan->Nama;
			$jabatan 		= $karyawan->jabatan->Nama_Jabatan;
			$jabatan_id 	= $karyawan->jabatan->Kode_Jabatan;
			$departemen_id 	= $karyawan->departemen->Kode_Department;
			
			$penggajians = TbPenggajianProyek::model()->findAllByAttributes(
				array('NIK'=>$_REQUEST['nik']),
				array('condition'=>'awal <= :akhir','params'=>array('akhir'=>$_REQUEST['akhir'])),
				array('condition'=>'akhir >= :awal','params'=>array('awal'=>$_REQUEST['awal']))				
			);

			$total_makan_transport 	= 0;
			$total_penerimaan 		= 0;
			$total_luar_kota 		= 0;
			$total_lembur			= 0;
			$gaji_pokok 			= 0;			

			$ketentuan = TbKetentuan::model()->findByAttributes(array(
				'kode_department' 	=> $departemen_id,
				'kode_jabatan' 		=> $jabatan_id,
				'Masa_Kerja' 		=> $karyawan->Masa_Kerja,
			));
			
			$tunjangan_jabatan 	= 0;
			
			foreach($penggajians as $row){
				$tunjangan_jabatan = $tunjangan_jabatan+$row->tunjangan_jabatan;
			}

			if(isset($_REQUEST['gaji_pokok'])){
				$kali_makan_transport 	= $_REQUEST['kali_makan_transport'];
				$makan_transport 		= $_REQUEST['tunj_makan_transport'];
				$kali_luar_kota 		= $_REQUEST['kali_luar_kota'];
				$kali_lembur 			= $_REQUEST['kali_lembur'];
				$gaji_pokok 			= $_REQUEST['gaji_pokok'];
				$luar_kota 				= $_REQUEST['tunj_luar_kota'];
				$potongan 				= $_REQUEST['potongan'];
				$lembur					= $_REQUEST['tunj_lembur'];
				$final 					= $_REQUEST['final'];				

				if($kali_lembur=='' or $kali_makan_transport=='' or $kali_luar_kota=='' or 
					!is_numeric($kali_lembur) or !is_numeric($kali_makan_transport) or !is_numeric($kali_luar_kota)){

					if($final=='true'){
						Yii::app()->user->setFlash('error','data yang anda masukan salah.');
						$final = 'false';
					}
				}
				
				$total_makan_transport 	= $makan_transport*$kali_makan_transport;
				$total_luar_kota 		= $luar_kota*$kali_luar_kota;
				$total_lembur			= $lembur*$kali_lembur;
				$gaji_pokok 			= $gaji_pokok+$total_makan_transport+$total_luar_kota+$total_lembur;
				$total_penerimaan 		= $gaji_pokok-$potongan;				
			}

			$this->render('slip',array(			
				'total_makan_transport' => $total_makan_transport,
				'kali_makan_transport' 	=> $kali_makan_transport,
				'tunjangan_jabatan' 	=> $tunjangan_jabatan,
				'total_penerimaan' 		=> $total_penerimaan,
				'total_luar_kota' 		=> $total_luar_kota,
				'kali_luar_kota'		=> $kali_luar_kota,
				'total_lembur' 			=> $total_lembur,
				'kali_lembur'			=> $kali_lembur,
				'penggajians' 			=> $penggajians,
				'gaji_pokok' 			=> $gaji_pokok,
				'ketentuan' 			=> $ketentuan,
				'potongan' 				=> $potongan,
				'jabatan' 				=> $jabatan,
				'final' 				=> $final,
				'akhir'					=> $_REQUEST['akhir'],
				'awal' 					=> $_REQUEST['awal'],
				'nama'					=> $nama,
				'nik'  					=> $nik,
			));
		}
		else $this->render('periode');		
	}

	public function actionPendapatan(){
		$this->state 	= 'Pendapatan';
		$karyawans 		= '';
		$akhir 			= '';
		$awal 			= '';
		$edit 			= '';
		$url 			= Yii::app()->createUrl('site/pendapatan');

		if(!isset($_REQUEST['proyek'])) $this->redirect($url);		

		if(isset($_REQUEST['awal'])){
			$awal 	= $_REQUEST['awal'];
			$akhir 	= $_REQUEST['akhir'];

			if($_REQUEST['edit']=='true') $edit = 'true';			

			if($awal=='' or $akhir==''){
				Yii::app()->user->setFlash('error','awal periode dan akhir periode harus diisi.');
			}
			elseif($awal>$akhir){
				Yii::app()->user->setFlash('error','awal periode harus lebih kecil dari akhir periode.');
			}
			else{
				$penggajians = TbPenggajianProyek::model()->findAllByAttributes(			
					array('proyek' 		=> $_REQUEST['proyek']),			
					array('condition'	=> 'akhir >= :awal_date','params' => array('awal_date' 	=> $awal)),
					array('condition'	=> 'awal <= :akhir_date','params' => array('akhir_date' => $akhir))
				);

				$karyawans = array();

				foreach($penggajians as $penggajian){
					$karyawan = TbKaryawan::model()->findByAttributes(array('NIK_Absen'=>$penggajian->NIK));
					if(count($karyawan)!=0 and $karyawan->active==1) $karyawans[] = $karyawan;
				}
			}			
		}

		$this->render('pendapatan',array('proyek'=>$_REQUEST['proyek'],'karyawans'=>$karyawans,'awal'=>$awal,'akhir'=>$akhir,'edit'=>$edit));
	}

	public function actionPotongan(){
		$this->state = 'Potongan';		
		$this->render('potongan',array('proyek'=>$_REQUEST['proyek']));	
	}

	public function actionKasbon(){
		$this->state 		= 'Kasbon Karyawan';
		$kasbon 			= new TbKasbon;
		$pengajuan_kasbon 	= '';		
		$plafond_kasbon 	= '';
		$besar_potongan 	= '';
		$departemen 		= '';
		$masa_kerja 		= '';
		$keterangan 		= '';
		$jabatan 			= '';
		$nama 				= '';
		$nik 				= '';
		$proyek 			= '';

		if(isset($_REQUEST['proyek'])){
			$proyek = $_REQUEST['proyek'];
		} 
		else $this->redirect(array('/site/potongan'));

		if(isset($_REQUEST['nik'])){
			$nik 		= $_REQUEST['nik'];
			$karyawan 	= TbKaryawan::model()->findByAttributes(array('NIK_Absen'=>$nik,'active'=>1));
			
			if(count($karyawan)!=0){
				$plafond_kasbon 	= $karyawan->getKetentuan()->kasbon;
				$departemen 		= $karyawan->departemen->Nama_Department;
				$masa_kerja 		= $karyawan->Masa_Kerja;
				$jabatan 			= $karyawan->jabatan->Nama_Jabatan;
				$nama 				= $karyawan->Nama;										
			}
			else Yii::app()->user->setFlash('error','Nik yang anda masukan tidak tersedia.');			
		}

		if(isset($_REQUEST['TbKasbon'])) $kasbon->attributes = $_REQUEST['TbKasbon'];		

		if(isset($_REQUEST['action']) and $_REQUEST['action']=='submit'){
			if(count(TbKasbon::model()->findByAttributes(array('NIK'=>$_REQUEST['nik'])))==0){
				$kasbon->save();
				if($kasbon->validate()) Yii::app()->user->setFlash('success','Data telah tersimpan');
			}
			else Yii::app()->user->setFlash('error','sudah ada kasbon untuk karyawan ini.');
		}

		$this->render('kasbon',array(
			'nik' 				=> $nik,
			'nama' 				=> $nama,
			'proyek'			=> $proyek,
			'kasbon' 			=> $kasbon,
			'jabatan' 			=> $jabatan,
			'departemen' 		=> $departemen,
			'masa_kerja' 		=> $masa_kerja,
			'keterangan' 		=> $keterangan,			
			'plafond_kasbon' 	=> $plafond_kasbon,
		));	
	}

	public function actionPph(){
		$this->state 	= 'Pph';
		$proyek 		= '';

		if(isset($_REQUEST['proyek'])){
			$proyek = $_REQUEST['proyek'];
		} 
		else $this->redirect(array('/site/potongan'));

		$this->render('pph',array('proyek'=>$proyek));
	}

	public function actionKetentuan_pajak(){
		$this->state = 'Ketentuan Pajak Pph21';
		$this->render('ketentuan_pajak');
	}

	public function actionPerhitungan(){
		$this->state = 'PERHITUNGAN PPH';
		$this->render('perhitungan');
	}

	public function actionBpjs(){
		$this->state 	= 'BPJS';
		$proyek 		= '';

		if(isset($_REQUEST['proyek'])){
			$proyek = $_REQUEST['proyek'];
		} 
		else $this->redirect(array('/site/potongan'));

		$this->render('bpjs',array('proyek'=>$proyek));
	}
}