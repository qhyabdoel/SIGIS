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
					'pendapatan','potongan','kasbon','Pph','ketentuan_pajak',
					'add_proyek','edit_proyek','update_proyek',
				),
				'users'=>array('@'),
			),			
			array('deny','users'=>array('*')),
		);
	}

	public function actionTes(){		

	}

	public function actionInput(){
		setcookie('from','input',time()+24*3600,'/');

		$nik_absens					= array();
		$karyawan_list				= CHtml::listData(TbKaryawan::model()->findAllByAttributes(array('active'=>1)),'NIK_Absen','Nama');
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
		$penggajians_isi 			= array();		
		$isis 						= array();
		$proyek_list 				= CHtml::listData(Proyek::model()->findAll(),'name','name');
		$proyek_list['add'] 		= '--tambah--';
		$proyek_list['edit'] 		= '--edit--';
		$karyawan_list[0] 			= ' --pilih-- ';

		if(isset($_REQUEST['action'])){
			$awal 		= $_REQUEST['awal'];
			$akhir 		= $_REQUEST['akhir'];
			$times 		= $_REQUEST['proyeks_count'];
			$proyeks 	= array();	

			if($_REQUEST['action']=='hapus_karyawan'){
				if(isset($_REQUEST['mark_nik'])) TbPenggajianProyek::model()->deleteAll(array('condition'=>'NIK = :NIK','params'=>array(':NIK'=>$_REQUEST['mark_nik'])));
			}

			if($awal!='' and $akhir!=''){
				$penggajians_isi = TbPenggajianProyek::model()->findAllByAttributes(array('awal'=>$awal,'akhir'=>$akhir));					
			}	

			foreach($penggajians_isi as $isi){
				if(!in_array($isi->NIK,$nik_absens)) $nik_absens[] = $isi->NIK;

				$isis[$isi->NIK][$isi->proyek] = TbPenggajianProyek::model()->findByAttributes(array('proyek'=>$isi->proyek,'NIK'=>$isi->NIK));
			}	

			for($i=0;$i<$times;$i++){
				$numb 		= $i+1;
				if(isset($_REQUEST['proyeks'])) $proyeks[] = $_REQUEST['proyeks'][$numb];
			}				

			if($_REQUEST['jumlah_karyawan']==0){
				$nik_absens[] = $_REQUEST['nama'];
			}
			else{
				$nik_hapus = 0;

				if(isset($_REQUEST['mark_nik'])) $nik_hapus = $_REQUEST['mark_nik'];

				if(!in_array($_REQUEST['nama'],$nik_absens)) $nik_absens[] = $_REQUEST['nama'];							

				foreach ($_REQUEST['nik_absens'] as $nik_absen){
					if(!in_array($nik_absen,$nik_absens) and $nik_absen!=$nik_hapus) $nik_absens[] = $nik_absen;
				}						
			}

			if($_REQUEST['action']=='hapus_karyawan'){
				if(!isset($_REQUEST['mark_nik'])) Yii::app()->user->setFlash('error', 'anda belum memilih data untuk dihapus.');
				else Yii::app()->user->setFlash('success', 'anda berhasil menghapus data penggajian.');
			}
			elseif($_REQUEST['action']=='tambah'){									
				if($_REQUEST['proyek']==''){
					Yii::app()->user->setFlash('error','Masukan nama proyek terlebih dahulu!');
				}
				elseif(in_array($_REQUEST['proyek'], $proyeks)){
					Yii::app()->user->setFlash('error','Proyek sudah ada.');
				}
				else $proyeks[] = $_REQUEST['proyek'];				

				$proyeks_count = count($proyeks);
			}
			elseif($_REQUEST['action']=='semua'){				
				$models 	= Proyek::model()->findAll();
				$proyeks 	= array();
				
				foreach ($models as $model) {
					$proyeks[] = $model->name;
				}

				$proyeks_count 	= count($proyeks);
				$nik_absens 	= array();
				$karyawans 		= TbKaryawan::model()->findAllByAttributes(array('active'=>1));

				foreach ($karyawans as $karyawan) {
					$nik_absens[] = $karyawan->NIK_Absen;
				}
			}
			elseif($_REQUEST['action']=='hapus'){				
				$proyeks_post 	= array();
				$proyeks 		= array();				

				for($i=0;$i<$times;$i++){					
					$numb 			= $i+1;
					$proyeks_post[] = $_REQUEST['proyeks'][$numb];

					if($_REQUEST['proyeks'][$numb]!=$_REQUEST['proyek']){
						$proyeks[] = $_REQUEST['proyeks'][$numb];						
					}					
				}						

				if(count($proyeks)==0){
					$proyeks[] = $_REQUEST['proyeks'][$numb];
					// Yii::app()->user->setFlash('error','Proyek tidak boleh kosong.');
				}
				
				if(!in_array($_REQUEST['proyek'], $proyeks_post)) 
					Yii::app()->user->setFlash('error','Proyek yang akan dihapus tidak ada.');				

				if($_REQUEST['proyek']=='') Yii::app()->user->setFlash('error','Masukan nama proyek terlebih dahulu!');				

				$proyeks_count = count($proyeks);									
			}					

			if(isset($_REQUEST['is_save']) and $_REQUEST['is_save']=='true'){
				$times 		= $_REQUEST['proyeks_count'];
				$proyeks 	= array();
				$awal 		= $awal;
				$akhir 		= $akhir;				
				$proyeks 	= $_REQUEST['proyeks'];

				for($i=0;$i<$times;$i++){					
					$proyek 	= $_REQUEST['proyeks'][$numb];
					// $proyeks[] 	= $proyek;									

					if($awal=='' or $akhir==''){																							
						Yii::app()->user->setFlash('error','Periode awal dan akhir harus diisi.');
					}
					elseif ($awal > $akhir){
						Yii::app()->user->setFlash('error','Awal periode harus lebih kecil daripada akhir periode.');	
					}
					else{
						if(isset($_REQUEST['nik_absens'])){
							foreach ($_REQUEST['nik_absens'] as $nik_absen){
								$karyawan = TbKaryawan::model()->findByAttributes(array('NIK_Absen'=>$nik_absen));

								$gaji_pokok 		= $_REQUEST['gaji_pokok'][$karyawan->NIK_Absen][$numb];								
								$tunjangan_jabatan 	= $_REQUEST['tunjangan_jabatan'][$karyawan->NIK_Absen][$numb];
								$pendapatan_intern 	= $_REQUEST['pendapatan_intern'][$karyawan->NIK_Absen][$numb];								

								$gaji_pokok 		= $this->convert($gaji_pokok);
								$tunjangan_jabatan  = $this->convert($tunjangan_jabatan);
								$pendapatan_intern 	= $this->convert($pendapatan_intern);

								// echo $gaji_pokok;
								// die();

								$penggajian	= TbPenggajianProyek::model()->findByAttributes(array(
									'awal'=>$awal,'akhir'=>$akhir,'proyek'=>$proyek,'NIK'=>$karyawan->NIK_Absen
								));

								if(count($penggajian)==0) $penggajian = new TbPenggajianProyek;

								$penggajian->awal 				= $awal;
								$penggajian->akhir 				= $akhir;
								$penggajian->proyek 			= $proyek;
								$penggajian->NIK 				= $karyawan->NIK_Absen;
								$penggajian->gaji_pokok 		= $gaji_pokok;
								$penggajian->tunjangan_jabatan 	= $tunjangan_jabatan;
								$penggajian->pendapatan_intern 	= $pendapatan_intern;

								if(($gaji_pokok!='' and !is_numeric($gaji_pokok)) or ($tunjangan_jabatan!='' and !is_numeric($tunjangan_jabatan)) or ($pendapatan_intern!='' and !is_numeric($pendapatan_intern))){
									if($gaji_pokok!='' or $tunjangan_jabatan!='' or $pendapatan_intern!=''){
										Yii::app()->user->setFlash('error','Data tidak berhasil disimpan.');																								
									}
								}
								else{
									$penggajian->save();									

									Yii::app()->user->setFlash('success','Data berhasil disimpan.');

									$view = 'input_report';							

									$penggajians['gaji_pokok'][$karyawan->NIK_Absen][$numb] = $_REQUEST['gaji_pokok'][$karyawan->NIK_Absen][$numb];;
									$penggajians['tunjangan_jabatan'][$karyawan->NIK_Absen][$numb] = $_REQUEST['tunjangan_jabatan'][$karyawan->NIK_Absen][$numb];;
									$penggajians['pendapatan_intern'][$karyawan->NIK_Absen][$numb] = $_REQUEST['pendapatan_intern'][$karyawan->NIK_Absen][$numb];;																	
								}							
							}						
						}						
					}

					$numb = $i+1;											
				}				

				$proyeks_count = count($proyeks);
			}			
		}
		else{

		}

		$this->render($view,array(		
			'total_tunjangan_jabatan' 	=> $total_tunjangan_jabatan,
			'total_pendapatan_intern' 	=> $total_pendapatan_intern,
			'total_gaji_pokok' 			=> $total_gaji_pokok,
			'penggajians_isi' 			=> $penggajians_isi,
			'karyawan_list'				=> $karyawan_list,
			'proyeks_count' 			=> $proyeks_count,
			'penggajians'				=> $penggajians,
			'proyek_list' 				=> $proyek_list,
			'nik_absens'				=> $nik_absens,			
			'proyeks' 					=> $proyeks,
			'akhir'						=> $akhir,
			'awal' 						=> $awal,
			'isis' 						=> $isis,
		));
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

		} else if(isset($_REQUEST['action2']) and $_REQUEST['action2']=='potongan'){
			$action2 		= 'potongan';
			$breadcrumb 	= 'Rekapitulasi Potongan Karyawan';
			$this->state 	= 'Rekapitulasi Potongan Karyawan';
			$url 			= '/site/rekapitulasi';
			$url2 			= Yii::app()->createUrl('site/rekapitulasi');

		} else {
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

			if(isset($_REQUEST['awal'])){
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
					if(isset($_REQUEST['action2']) and $_REQUEST['action2']=='payroll'){
						if(isset($_REQUEST['bank'])){													
							$karyawans = TbKaryawan::model()->findAllByAttributes(					
								array(
									'Bank_Rek' 	=> $_REQUEST['bank'],
									'active' 	=> 1
								),					
								array('order'=>'NIK_Absen')
							);

							$bank = $_REQUEST['bank'];
						}													
					} else if(isset($_REQUEST['action2']) and $_REQUEST['action2']=='potongan') {										
						$karyawans = TbKaryawan::model()->findAllByAttributes(array('active'=> 1),array('order'=>'NIK_Absen'));
					}
					else{
						$karyawans = TbKaryawan::model()->findAllByAttributes(array('active' => 1),array('order'=>'NIK_Absen'));					
					}										
				}
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
		$this->state 		= 'Periode Penggajian';
		$view_slip 			= 'slip';
		$jumlah_kehadiran 	= '';
		$maksimal_kehadiran = '';

		if(isset($_REQUEST['manual'])) $view_slip = 'slip_manual';			

		if(isset($_REQUEST['action'])){
			if($_REQUEST['action']=='ok'){
				$awal 	= $_REQUEST['awal'];
				$akhir 	= $_REQUEST['akhir'];				

				if($awal=='' or $akhir==''){
					Yii::app()->user->setFlash('error','awal dan akhir periode harus diisi.');

					$this->render('periode',array('view_slip'=>$view_slip));
				}
				elseif($awal>$akhir){
					Yii::app()->user->setFlash('error','awal periode harus lebih kecil nilainya dari akhir periode.');

					$this->render('periode',array('view_slip'=>$view_slip));
				}
				else{
					$this->state = 'Laporan Gaji Karyawan (Slip Gaji)';

					$this->render($view_slip,array(											
						'jabatan' 				=> '_',
						'akhir' 				=> $akhir,
						'awal' 					=> $awal,
						'nama' 					=> '_',
						'nik' 					=> '',
						'maksimal_kehadiran' 	=> $maksimal_kehadiran,
						'jumlah_kehadiran' 		=> $jumlah_kehadiran,
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

				$this->render($view_slip,array(
					'awal' 					=> $_REQUEST['awal'],
					'akhir' 				=> $_REQUEST['akhir'],
					'kali_lembur' 			=> $_REQUEST['kali_lembur'],
					'kali_luar_kota' 		=> $_REQUEST['kali_luar_kota'],					
					'kali_makan_transport' 	=> $_REQUEST['kali_makan_transport'],
					'maksimal_kehadiran' 	=> $maksimal_kehadiran,
					'jumlah_kehadiran' 		=> $jumlah_kehadiran,
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

			$ketentuan = $karyawan->ketentuan;
			
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

			if(count($penggajians)==0) Yii::app()->user->setFlash('error','karyawan belum memiliki data penggajian.');			

			if(isset($_REQUEST['jumlah_kehadiran'])) $jumlah_kehadiran = $_REQUEST['jumlah_kehadiran'];
			if(isset($_REQUEST['maksimal_kehadiran'])) $maksimal_kehadiran = $_REQUEST['maksimal_kehadiran'];

			$this->render($view_slip,array(			
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
				'karyawan' 				=> $karyawan,
				'jumlah_kehadiran' 		=> $jumlah_kehadiran,
				'maksimal_kehadiran' 	=> $maksimal_kehadiran,
			));
		}
		else $this->render('periode',array('view_slip'=>$view_slip));	

		echo $view_slip;	
	}

	public function actionPendapatan(){
		$this->state 	= 'Pendapatan';
		$karyawans 		= '';
		$akhir 			= '';
		$awal 			= '';
		$edit 			= '';
		$url 			= Yii::app()->createUrl('site/pendapatan');
		$url_ref 		= Yii::app()->createUrl('personalia/TbPenggajian/pendapatan?proyek='.$_REQUEST['proyek'].'&manual=true');
		$lain			= array(0);
		$manual 		= 'false';
		$view 			= 'pendapatan';
		$karyawan		= new TbKaryawan;	
		$pendapatan 	= new PendapatanManual;		
		$data_absen 	= new TbAbsenkar;

		if(isset($_REQUEST['manual'])) $manual = $_REQUEST['manual'];

		if($manual=='true') $view = 'pendapatan_manual';

		if(!isset($_REQUEST['proyek'])) $this->redirect($url);		

		if(isset($_REQUEST['nik'])){		
			$data_absen2 = TbAbsenkar::model()->findByAttributes(
				array('Nik'=>$_REQUEST['nik']),
				array(
					'condition' => 'awal between :awal and :akhir or akhir between :awal and :akhir',
					'params' 	=> array(':awal'=>$_REQUEST['TbAbsenkar']['awal'],':akhir'=>$_REQUEST['TbAbsenkar']['akhir']),
				)
			);							

			if(count($data_absen2)!=0) $data_absen = $data_absen2;
			
			$karyawan 	= TbKaryawan::model()->findByAttributes(array('NIK_Absen'=>$_REQUEST['nik']));

			if(count($karyawan)==0){
				Yii::app()->user->setFlash('error','data karyawan tidak ditemukan.');
				$karyawan = new TbKaryawan;
			}
			else{
				if($_REQUEST['action']=='submit'){		
					if($_REQUEST['TbAbsenkar']['awal']!='' and $_REQUEST['TbAbsenkar']['akhir']!=''){
						$data_absen->attributes		= $_REQUEST['TbAbsenkar'];
						$date_awal 					= strtotime($_REQUEST['TbAbsenkar']['awal']);
						$date_awal 					= date('d-m-Y',$date_awal);
						$date_akhir					= strtotime($_REQUEST['TbAbsenkar']['akhir']);
						$date_akhir					= date('d-m-Y',$date_akhir);
						$date_jumlah 				= $karyawan->countDay($date_awal,$date_akhir);
						$data_absen->Kehadiran_Maks = $date_jumlah;

						$data_absen->save();					
						
						if(count($data_absen->getErrors())==0) {
							Yii::app()->user->setFlash('success','data pendapatan berhasil disimpan.');
							$this->redirect($url_ref);					
						}
					}
					else Yii::app()->user->setFlash('error','periode harus diisi.');
				}
			}
		}

		if(isset($_REQUEST['awal'])){
			$awal 	= $_REQUEST['awal'];
			$akhir 	= $_REQUEST['akhir'];
			
			if(isset($_REQUEST['lain'])) $lain = $_REQUEST['lain'];

			if($_REQUEST['edit']=='true') $edit = 'true';			

			if($awal=='' or $akhir==''){
				Yii::app()->user->setFlash('error','awal periode dan akhir periode harus diisi.');
			}
			elseif($awal>$akhir){
				Yii::app()->user->setFlash('error','awal periode harus lebih kecil dari akhir periode.');
			}
			else{				

				$penggajians = TbPenggajianProyek::model()->findAllByAttributes(			
					array('proyek' => $_REQUEST['proyek'],'awal'=>$awal,'akhir'=>$akhir)
				);

				$karyawans = array();

				foreach($penggajians as $penggajian){
					$karyawan = TbKaryawan::model()->findByAttributes(array('NIK_Absen'=>$penggajian->NIK));
					if(count($karyawan)!=0 and $karyawan->active==1) $karyawans[] = $karyawan;
				}
			}			
		}

		$this->render($view,array(
			'data_absen' 	=> $data_absen,
			'proyek' 		=> $_REQUEST['proyek'],
			'karyawans' 	=> $karyawans,
			'awal' 			=> $awal,
			'akhir' 		=> $akhir,
			'edit' 			=> $edit,
			'lain' 			=> $lain,
			'karyawan'		=> $karyawan,
			'pendapatan' 	=> $pendapatan,
		));
	}

	public function actionPotongan(){
		$this->state = 'Potongan';		
		$this->render('potongan',array('proyek'=>$_REQUEST['proyek']));	
	}

	public function actionKasbon(){
		$this->state 		= 'Kasbon Karyawan';
		$kasbon 			= new TbKasbon;
		$pengajuan_kasbon 	= '';		
		$masa_kerja_tahun 	= '';
		$masa_kerja_bulan 	= '';
		$plafond_kasbon 	= '';
		$besar_potongan 	= '';
		$departemen 		= '';
		$masa_kerja 		= '';
		$keterangan 		= '';
		$jabatan 			= '';
		$proyek 			= '';
		$nama 				= '';
		$nik 				= '';
		$saved 				= 0;
		$pengembalians 		= array_fill(1, 12, '');				

		if(isset($_REQUEST['proyek'])){
			$proyek = $_REQUEST['proyek'];
		} 
		else $this->redirect(array('/site/potongan'));

		if(isset($_REQUEST['nik'])){			
			$nik 		= $_REQUEST['nik'];
			$karyawan 	= TbKaryawan::model()->findByAttributes(array('NIK_Absen'=>$nik,'active'=>1));
			$kasbon 	= TbKasbon::model()->findByAttributes(array('NIK'=>$_REQUEST['nik']));

			if(count($kasbon)==0){
				$kasbon = new TbKasbon;

				if($_REQUEST['action']=='submit'){
					$kasbon->attributes = $_REQUEST['TbKasbon'];
					$kasbon->save();
					
					if($kasbon->validate()) Yii::app()->user->setFlash('success','Data telah tersimpan');

					$pengajuan_kasbon 	= $kasbon->pengajuan_kasbon;
					$besar_potongan 	= $kasbon->besar_potongan;
					$keterangan 		= $kasbon->keterangan;
				}				
			}
			else{				
				$pengajuan_kasbon 	= $kasbon->pengajuan_kasbon;
				$besar_potongan 	= $kasbon->besar_potongan;
				$keterangan 		= $kasbon->keterangan;
				$pengembalians 		= array();																

				if($_REQUEST['action']=='submit'){
					$kasbon->save_pengembalian($_REQUEST['pengembalians']);
					Yii::app()->user->setFlash('success','Data telah tersimpan');
				}

				$pengembalian_rows 	= TbPengembalian::model()->findAllByAttributes(array('id_kasbon'=>$kasbon->id));

				foreach($pengembalian_rows as $pengembalian){
					$pengembalians[$pengembalian->bulan] = $pengembalian->jumlah;
				} 				
			}			
			
			if(count($karyawan)!=0){
				$plafond_kasbon 	= $karyawan->getKetentuan()->kasbon;
				$departemen 		= $karyawan->departemen->Nama_Department;
				$masa_kerja 		= $karyawan->Masa_Kerja;
				$jabatan 			= $karyawan->jabatan->Nama_Jabatan;
				$nama 				= $karyawan->Nama;										
				$masa_kerja_tahun 	= $karyawan->masa_kerja_tahun;
				$masa_kerja_bulan 	= $karyawan->masa_kerja_bulan;
			}
			else Yii::app()->user->setFlash('error','Nik yang anda masukan tidak tersedia.');			
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
			'pengembalians'		=> $pengembalians,
			'besar_potongan'	=> $besar_potongan,
			'plafond_kasbon' 	=> $plafond_kasbon,
			'pengajuan_kasbon'	=> $pengajuan_kasbon,
			'masa_kerja_tahun'	=> $masa_kerja_tahun,
			'masa_kerja_bulan' 	=> $masa_kerja_bulan,
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

	public function actionPerhitungan(){
		$this->state 	= 'Perhitungan Pph';
		$karyawans 		= array();		
		$awal 		 	= '';
		$akhir 		 	= '';
		
		if(isset($_REQUEST['proyek'])){
			$proyek	= $_REQUEST['proyek'];			
		}
		else $this->redirect(Yii::app()->createUrl('/site/potongan'));

		if(isset($_REQUEST['awal'])){
			$karyawans 	= TbKaryawan::model()->findAllByAttributes(array('active'=>1),array('order'=>'NIK_Absen'));		
			$awal 		= $_REQUEST['awal'];
			$akhir  	= $_REQUEST['akhir'];
		}

		$this->render('perhitungan',array('proyek'=>$proyek,'karyawans'=>$karyawans,'awal'=>$awal,'akhir'=>$akhir));
	}

	public function actionBpjs(){
		$this->state = 'BPJS';
		$proyek 	 = '';
		$karyawans 	 = TbKaryawan::model()->findAll();		
		$awal 		 = '';
		$akhir 		 = '';

		if(isset($_REQUEST['proyek'])){
			$proyek = $_REQUEST['proyek'];
		} 
		else $this->redirect(array('/site/potongan'));

		if(isset($_REQUEST['awal'])){
			$awal 	= $_REQUEST['awal'];
			$akhir  = $_REQUEST['akhir'];
		}

		$this->render('bpjs',array('proyek'=>$proyek,'karyawans'=>$karyawans,'awal'=>$awal,'akhir'=>$akhir));
	}

	public function actionAdd_proyek(){
		$proyek 		= new Proyek;
		$proyek->name 	= $_REQUEST['name'];
		// $proyek->wage 	= $_REQUEST['wage'];
		$proyek->save();

		$error = '';
		
		if(isset($proyek->getErrors()['proyek'][0])) $error = $proyek->getErrors()['proyek'][0];

		// print_r($proyek->getErrors()['wage']);

		if(isset($proyek->getErrors()['name'])) $error = $proyek->getErrors()['name'][0];
		if(isset($proyek->getErrors()['wage'])) $error = $proyek->getErrors()['wage'][0];

		echo json_encode(array('name'=>$proyek->name,'wage'=>$proyek->wage,'error'=>$error));
	}

	public function actionEdit_proyek(){
		$this->state 	= 'Proyek';				

		// if(isset($_REQUEST['from'])) setcookie('from',$_REQUEST['from'],time()+3600,'/');

		if(isset($_REQUEST['Proyek'])){
			$proyek = Proyek::model()->findByPk($_REQUEST['Proyek']['id']);

			$proyek->attributes = $_REQUEST['Proyek'];
			
			if($proyek->save()) Yii::app()->user->setFlash('success', 'data berhasil disimpan.');			
			else{
				$this->render('proyek_edit',array('proyek'=>$proyek));
				die();				
			}
		}
		else{
			if(isset($_REQUEST['action'])){				
				if(isset($_REQUEST['id'])){
					$proyek = Proyek::model()->findByPk($_REQUEST['id']);
					
					if($_REQUEST['action']=='delete'){
						$proyek->delete();
						Yii::app()->user->setFlash('success', 'data berhasil dihapus.');					
					}
					else{
						$this->render('proyek_edit',array('proyek'=>$proyek));
						die();
					}					
				}
				else Yii::app()->user->setFlash('error', 'anda belum memilih data untuk diedit.');			
			}
		}		

		$proyeks = Proyek::model()->findAll();
		$this->render('proyek_index',array('proyeks'=>$proyeks));		
	}		

	public function convert($data){
		$data = str_replace('.', '', $data);				

		return $data;
	}
}