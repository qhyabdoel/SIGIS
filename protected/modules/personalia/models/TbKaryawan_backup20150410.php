<?php

/**
 * This is the model class for table "tb_karyawan".
 *
 * The followings are the available columns in table 'tb_karyawan':
 * @property integer $NIK
 * @property string $Nama
 * @property integer $Kode_Departement
 * @property integer $Kode_Jabatan
 * @property string $Tanggal_Masuk
 * @property integer $Masa_Kerja
 * @property string $Status_Kerja
 * @property string $Kontrak_Awal
 * @property string $Kontrak_Akhir
 * @property string $Jenis_ID
 * @property string $No_ID
 * @property string $Status
 * @property string $Tempat_Lahir
 * @property string $Tanggal_Lahir
 * @property string $Alamat_Rumah
 * @property integer $No_Telp_Rumah
 * @property integer $No_HP
 * @property integer $No_HP2
 * @property string $Alamat_Email
 * @property string $No_NPWP
 * @property string $No_KPJ
 * @property string $Bank_Rek
 * @property string $No_Rek_BCA
 * @property string $Nama_Rek
 * @property integer $NIK_Absen
 */
class TbKaryawan extends CActiveRecord{
	/**
	 * @return string the associated database table name
	 */
	public function tableName(){
		return 'tb_karyawan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(			
			array('Nama, Kode_Departement, Kode_Jabatan, Tanggal_Masuk, Masa_Kerja, 
				Jenis_ID, No_ID, Tempat_Lahir, Tanggal_Lahir, No_HP, Alamat_Email, NIK_Absen', 'required'),
			array('NIK_Absen', 'unique'),			
			array('Kode_Departement, Kode_Jabatan, Masa_Kerja, No_Telp_Rumah, No_HP, No_HP2, NIK_Absen', 'numerical',
				 'integerOnly'=>true),
			array('Nama, No_ID, Nama_Rek_BCA, Nama_Rek_BTN, Tempat_Lahir, Alamat_Email, No_NPWP, No_KPJ, No_Rek_BCA, No_Rek_BTN', 'length', 'max'=>50),
			array('Status_Kerja, Bank_Rek', 'length', 'max'=>20),
			array('Jenis_ID', 'length', 'max'=>7),
			array('Status', 'length', 'max'=>2),
			array('Alamat_Rumah', 'length', 'max'=>100),
			array('NIK_Absen', 'unique'),	
			array('Kontrak_Awal, Kontrak_Akhir','customValidationRule'),		
			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.		
				
			array(

				'NIK, Nama, Kode_Departement, Kode_Jabatan, Tanggal_Masuk, Masa_Kerja, Status_Kerja, 
				Kontrak_Awal, Kontrak_Akhir, Jenis_ID, No_ID, Status, Tempat_Lahir, Tanggal_Lahir, 
				Alamat_Rumah, No_Telp_Rumah, No_HP, No_HP2, Alamat_Email, No_NPWP, No_KPJ, Nama_Rek_BCA, Nama_Rek_BTN 
				Bank_Rek, No_Rek_BCA, NIK_Absen, jam_kerja_id, jam_kerja_id_2', 'safe', 'on'=>'search'
			),
		);
	}

	public function customValidationRule($attributes,$params){		
	    if($this->Status_Kerja!='TETAP'){
	    	if($this->$attributes=='') $this->addError($attributes,'Periode kontrak cannot be blank.');	    	
	    }
	}

	/**
	 * @return array relational rules.
	 */
	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'departemen' 			=> array(self::BELONGS_TO,'TbDepartmen','Kode_Departement'),
			'nik_absen'  			=> array(self::HAS_ONE,'NikAbsen','nik_karyawan'),
			'jabatan' 	 			=> array(self::BELONGS_TO,'TbJabatan','Kode_Jabatan'),
			'kasbons' 	 			=> array(self::HAS_MANY,'TbKasbon','NIK'),			
			'jam_kerja'  			=> array(self::BELONGS_TO,'TbJamKerja','jam_kerja_id'),	
			'keluarkota_sementara' 	=> array(self::HAS_ONE,'KeluarKotaSementara','','foreignKey'=>array('NIK'=>'NIK_Absen')),		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels(){
		return array(
			'NIK' 				=> 'NIK',
			'Nama' 				=> 'NAMA',
			'No_ID' 			=> 'NO',
			'No_HP' 			=> 'No HP',
			'Status' 			=> 'STATUS',
			'No_HP2' 			=> 'NO HP2',
			'No_KPJ' 			=> 'NO KPJ',
			'No_Rek_BCA' 		=> 'NO',
			'No_Rek_BTN' 		=> 'NO',
			'No_NPWP' 			=> 'No NPWP',
			'Bank_Rek' 			=> 'BANK',
			'Jenis_ID' 			=> 'JENIS',
			'Nama_Rek_BCA'		=> 'NAMA',
			'Nama_Rek_BTN' 		=> 'Nama',
			'NIK_Absen'			=> 'NIK ABSEN',
			'Masa_Kerja' 		=> 'MASA KERJA',
			'Kode_Jabatan' 		=> 'JABATAN',
			'Status_Kerja' 		=> 'STATUS KERJA',
			'Tempat_Lahir' 		=> 'TEMPAT LAHIR',
			'Alamat_Rumah' 		=> 'ALAMAT RUMAH',
			'Kontrak_Awal' 		=> 'PERIODE KONTRAK',
			'Kontrak_Akhir' 	=> 'KONTRAK AKHIR',
			'Alamat_Email' 		=> 'ALAMAT EMAIL',
			'Tanggal_Lahir' 	=> 'TANGGAL LAHIR',
			'Tanggal_Masuk' 	=> 'TANGGAL MASUK',
			'No_Telp_Rumah' 	=> 'NO TELP RUMAH',
			'Kode_Departement' 	=> 'DEPARTEMEN',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('NIK',$this->NIK);
		$criteria->compare('No_HP',$this->No_HP);
		$criteria->compare('No_HP2',$this->No_HP2);
		$criteria->compare('Masa_Kerja',$this->Masa_Kerja);
		$criteria->compare('No_Telp_Rumah',$this->No_Telp_Rumah);
		$criteria->compare('Kode_Departement',$this->Kode_Departement);

		$criteria->compare('Nama',$this->Nama,true);
		$criteria->compare('No_ID',$this->No_ID,true);
		$criteria->compare('Status',$this->Status,true);
		$criteria->compare('No_KPJ',$this->No_KPJ,true);
		$criteria->compare('No_Rek_BCA',$this->No_Rek_BCA,true);
		$criteria->compare('No_Rek_BTN',$this->No_Rek_BTN,true);
		$criteria->compare('No_NPWP',$this->No_NPWP,true);
		$criteria->compare('Bank_Rek',$this->Bank_Rek,true);
		$criteria->compare('Nama_Rek_BCA',$this->Nama_Rek_BCA,true);
		$criteria->compare('Nama_Rek_BTN',$this->Nama_Rek_BTN,true);
		$criteria->compare('Jenis_ID',$this->Jenis_ID,true);
		$criteria->compare('NIK_Absen',$this->NIK_Absen,true);
		$criteria->compare('Kode_Jabatan',$this->Kode_Jabatan);
		$criteria->compare('Kontrak_Awal',$this->Kontrak_Awal,true);
		$criteria->compare('Status_Kerja',$this->Status_Kerja,true);
		$criteria->compare('Alamat_Email',$this->Alamat_Email,true);
		$criteria->compare('Tempat_Lahir',$this->Tempat_Lahir,true);
		$criteria->compare('Alamat_Rumah',$this->Alamat_Rumah,true);
		$criteria->compare('Kontrak_Akhir',$this->Kontrak_Akhir,true);
		$criteria->compare('Tanggal_Lahir',$this->Tanggal_Lahir,true);
		$criteria->compare('Tanggal_Masuk',$this->Tanggal_Masuk,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TbKaryawan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getTotalPenggajian($proyek,$awal,$akhir)
	{
		$penggajians = TbPenggajianProyek::model()->findAllByAttributes(			
			array('NIK'=>$this->NIK_Absen,'proyek'=> $proyek,),			
			array('condition'=> 'awal <= :akhir_date','params'=>array('akhir_date'=>$akhir)),
			array('condition'=>'akhir >= :awal_date','params'=>array('awal_date'=>$awal))
		);
		
		$total = 0;

		foreach($penggajians as $penggajian){
			$total 	= $total+$penggajian->gaji_pokok+$penggajian->tunjangan_jabatan+$penggajian->pendapatan_intern;			
		}

		return $total;
	}

	public function getTotalPendapatanIntern($proyek,$awal,$akhir){
		$penggajians = TbPenggajianProyek::model()->findAllByAttributes(			
			array('NIK'=>$this->NIK_Absen,'proyek'=> $proyek,),			
			array('condition'=> 'awal <= :akhir_date','params'=>array('akhir_date'=>$akhir)),
			array('condition'=>'akhir >= :awal_date','params'=>array('awal_date'=>$awal))
		);
		
		$total = 0;

		foreach($penggajians as $penggajian){
			$total 	= $total+$penggajian->pendapatan_intern;			
		}

		return $total;	
	}

	public function getTotalPendapatanEkstern($proyek,$awal,$akhir){
		$jumlah_hadir               = $this->getKehadiran($awal,$akhir);
		$tunjangan_jabatan          = $this->getTunjanganJabatan($proyek,$awal,$akhir);
		$makan_transport            = $this->getKetentuan()->makan_transport;
		$makan_transport            = $jumlah_hadir*$makan_transport;
		$gaji_pokok                 = $this->getGajiPokok($proyek,$awal,$akhir);
		$lembur                     = $this->getJam_lembur($awal,$akhir);
		$luar_kota                  = $this->getLuar_kota($awal,$akhir);
		$premi_hadir                = $this->getPremi_hadir($awal,$akhir);
		$bonus_hadir                = $this->getBonus_hadir($awal,$akhir);
		$total_pendapatan           = $gaji_pokok+$tunjangan_jabatan+$makan_transport+$lembur+$luar_kota+$premi_hadir+$bonus_hadir; 	
		$pendapatan_intern 			= $this->getTotalPendapatanIntern($proyek,$awal,$akhir);

		return $total_pendapatan - $pendapatan_intern;
	}

	public function getGajiPokok($proyek,$awal,$akhir){
		$penggajians = TbPenggajianProyek::model()->findAllByAttributes(			
			array('NIK'=>$this->NIK_Absen,'proyek'=> $proyek,),
			array('condition'=>'awal <= :akhir_date','params'=>array('akhir_date'=>$akhir)),
			array('condition'=>'akhir >= :awal_date','params'=>array('awal_date'=>$awal))
		);

		$total = 0;

		foreach($penggajians as $penggajian){$total	= $total+$penggajian->gaji_pokok;}

		return $total;
	}

	public function getTunjanganJabatan($proyek,$awal,$akhir){
		$penggajians = TbPenggajianProyek::model()->findAllByAttributes(			
			array('NIK'=>$this->NIK_Absen,'proyek'=> $proyek,),			
			array('condition'=> 'awal <= :akhir_date','params'=>array('akhir_date'=>$akhir)),
			array('condition'=>'akhir >= :awal_date','params'=>array('awal_date'=>$awal))
		);

		$total = 0;

		foreach($penggajians as $penggajian){
			$total	= $total+$penggajian->tunjangan_jabatan;
		}

		return $total;
	}

	public function getMasa_kerja(){
		$result = strtotime(date('Y-m-d'))-strtotime($this->Tanggal_Masuk);
		$result = floor($result/(3600*60*12));
		return $result;
	}

	public function getKetentuan(){
		$result 		= new TbKetentuan;
		// $result 		= TbKetentuan::model()->find();		

		$ketentuans = TbKetentuan::model()->findAllByAttributes(array(
			'kode_department' 	=> $this->Kode_Departement,
			'kode_jabatan' 		=> $this->Kode_Jabatan,			
		));		

		foreach($ketentuans as $ketentuan){			
			$masa_kerja 			= explode("-",$ketentuan->Masa_Kerja);
			$masa_kerja_karyawan 	= strtotime(date('Y-m-d')) - strtotime($this->Tanggal_Masuk);			
			$masa_kerja_karyawan  	= floor($masa_kerja_karyawan/(3600*60*12));			
			$masa_kerja[1] 			= preg_replace('/\D/', '', $masa_kerja[1]); 

			if(substr($ketentuan->Masa_Kerja,-5)=='tahun'){
				$masa_kerja[0] = $masa_kerja[0]*12;
				$masa_kerja[1] = $masa_kerja[1]*12;
			}
			
			if($masa_kerja_karyawan>=$masa_kerja[0] and $masa_kerja_karyawan<=$masa_kerja[1]) 
				$result = $ketentuan;			
		}		

		if(isset($this->jam_kerja) and $this->jam_kerja->name=='Direksi') {
			$result 		= new TbKetentuan;
			$result->active = 1;
		}

		return $result;
	}

	public function getKehadiran($awal,$akhir){
		$result = 0;

		// $kehadirans = TbAbsensi::model()->findAll(array(
		// 	'condition' => 'NIK = :NIK and Ketidakhadiran is null and Tanggal between :awal and :akhir',
		// 	'params' 	=> array('NIK'=>$this->NIK_Absen,'awal'=>$awal,'akhir'=>$akhir)
		// ));

		$kehadiran = TbAbsenkar::model()->findByAttributes(			
			array('Nik'=>$this->NIK_Absen,),			
			array('condition'=> 'awal <= :akhir_date','params'=>array('akhir_date'=>$akhir)),
			array('condition'=>'akhir >= :awal_date','params'=>array('awal_date'=>$awal))
		);

		if(count($kehadiran)!=0) $result = $kehadiran->Kehadiran_Kary;

		// return count($kehadirans);

		return $result;
	}

	public function getKetidakhadiran($ketidakhadiran,$awal,$akhir){
		$kehadirans = TbAbsensi::model()->findAll(array(
			'condition' => 'NIK = :NIK and Ketidakhadiran = :ketidakhadiran and Tanggal between :awal and :akhir',
			'params' 	=> array('NIK'=>$this->NIK_Absen, 'ketidakhadiran'=>$ketidakhadiran, 'awal'=>$awal,'akhir'=>$akhir)
		));

		return count($kehadirans);	
	}

	public function getBonus_hadir($awal,$akhir){
		$bonus 			= 0;

		$kehadiran = TbAbsenkar::model()->findByAttributes(			
			array('Nik'=>$this->NIK_Absen,),			
			array('condition'=> 'awal <= :akhir_date','params'=>array('akhir_date'=>$akhir)),
			array('condition'=>'akhir >= :awal_date','params'=>array('awal_date'=>$awal))
		);

		if(count($kehadiran)!=0) 
			if($kehadiran->Kehadiran_Maks == $kehadiran->Kehadiran_Kary) $bonus = $this->ketentuan->bonus_hadir;

		// $jumlah_hari 	= Yii::app()->count_day->getNo_weekend(date('d-m-Y',strtotime($awal)),date('d-m-Y',strtotime($akhir)),'-');
		// $jumlah_hadir 	= $this->getKehadiran($awal,$akhir) + $this->getKetidakhadiran('cuti',$awal,$akhir);			

		// if($jumlah_hari==$jumlah_hadir) $bonus = $this->ketentuan->bonus_hadir;

		return $bonus;
	}

	public function getPremi_hadir($awal,$akhir){		
		$premi = 0;
		
		// $jumlah_hari 	= Yii::app()->count_day->getNo_weekend(date('d-m-Y',strtotime($awal)),date('d-m-Y',strtotime($akhir)),'-');
		// $jumlah_hadir 	= $this->getKehadiran($awal,$akhir) + $this->getKetidakhadiran('cuti',$awal,$akhir);			

		$kehadiran = TbAbsenkar::model()->findByAttributes(			
			array('Nik'=>$this->NIK_Absen,),			
			array('condition'=> 'awal <= :akhir_date','params'=>array('akhir_date'=>$akhir)),
			array('condition'=>'akhir >= :awal_date','params'=>array('awal_date'=>$awal))
		);

		if(count($kehadiran)!=0) {
			$jumlah_hari 	= $kehadiran->Kehadiran_Maks;
			$jumlah_hadir 	= $kehadiran->Kehadiran_Kary;
			$premi  		= $this->ketentuan->premi_hadir-($jumlah_hari-$jumlah_hadir)*(0.1*$this->ketentuan->premi_hadir);
		}

		// if($jumlah_hari==$jumlah_hadir) $bonus = $this->ketentuan->bonus_hadir;
		
		// $premi = $this->ketentuan->premi_hadir-($jumlah_hari-$jumlah_hadir)*(0.1*$this->ketentuan->premi_hadir);

		return $premi;	
	}

	public function getTotalKasbon(){
		$total = 0;

		foreach($this->kasbons as $kasbon){
			$total = $total+$kasbon->pengajuan_kasbon;
		}

		return $total;
	}

	public function getMasa_kerja_bulan(){
		$tanggal_masuk 	= strtotime($this->Tanggal_Masuk);
		$now 			= strtotime(date('Y-m-d'));
		$diff 			= $now-$tanggal_masuk;

		return floor(($diff%31104000)/2592000);
	}

	public function getMasa_kerja_tahun(){
		$tanggal_masuk 	= strtotime($this->Tanggal_Masuk);
		$now 			= strtotime(date('Y-m-d'));
		$diff 			= $now-$tanggal_masuk;

		return floor($diff/31104000);	
	}

	public function getTarif_ptpkp(){
		return TbPtkp::model()->findByAttributes(array('status'=>$this->Status))->tarif;
	}	

	public function getTake_home_pay($proyek,$awal,$akhir){
		$result 			= 0;
		$pendapatan       	= $this->getTotalPendapatanEkstern($proyek,$awal,$akhir);
	    $lembur           	= $this->ketentuan->lembur;
	    $lembur_luar_kota 	= $this->ketentuan->lembur_luarkota;

	    return ($pendapatan-$lembur-$lembur_luar_kota)*12;	    
	}

	public function getProgressive($proyek,$awal,$akhir){		
	    $take_home_pay    	= $this->getTake_home_pay($proyek,$awal,$akhir);
		$ketentuan_pph 		= TbKetentuanPph::model()->find();
		$awal 				= $ketentuan_pph->batas_take_home_pay_1;
		$akhir 				= $ketentuan_pph->batas_take_home_pay_2;
		$persentase1 		= $ketentuan_pph->persentase_tarif_1/100;
		$persentase2 		= $ketentuan_pph->persentase_tarif_2/100;
		$persentase3 		= $ketentuan_pph->persentase_tarif_3/100;
		$persentase4 		= $ketentuan_pph->persentase_tarif_4/100;

		if($take_home_pay<=$awal) $result = $take_home_pay*$persentase1;

		if($take_home_pay>=$awal and $take_home_pay<=$akhir){
			$result = $awal*$persentase1;
			$result = $result+($take_home_pay-$awal)*$persentase2;
		}

		if($take_home_pay>=$akhir){
			$result = $awal*$persentase1;
			$result = $result+$akhir*$persentase2;
			$result = $result+($take_home_pay-$awal-$akhir)*$persentase3;
		}

		if($this->No_NPWP=='') $result = $take_home_pay*$persentase4;

		return $result;
	}

	public function getDenda_npwp($proyek,$awal,$akhir){
		$pendapatan 	= $this->getTotalPendapatanEkstern($proyek,$awal,$akhir);
		$ketentuan_pph 	= TbKetentuanPph::model()->find();
		$result 		= 0;
		$take_home_pay 	= $this->getTake_home_pay($proyek,$awal,$akhir);
		$awal 			= $ketentuan_pph->batas_take_home_pay_1;
		$akhir 			= $ketentuan_pph->batas_take_home_pay_2;
		$persentase1 	= $ketentuan_pph->persentase_tarif_1/100;
		$persentase2 	= $ketentuan_pph->persentase_tarif_2/100;
		$persentase3 	= $ketentuan_pph->persentase_tarif_3/100;
		$persentase4 	= $ketentuan_pph->persentase_tarif_4/100;
		
		// if($take_home_pay<=$awal) $result = $take_home_pay*$persentase1;

		// if($take_home_pay>=$awal and $take_home_pay<=$akhir){
		// 	$result = $awal*$persentase1;
		// 	$result = $result+($take_home_pay-$awal)*$persentase2;
		// }

		// if($take_home_pay>=$akhir){
		// 	$result = $awal*$persentase1;
		// 	$result = $result+$akhir*$persentase2;
		// 	$result = $result+($take_home_pay-$awal-$akhir)*$persentase3;
		// }

		if($this->No_NPWP=='') $result = $take_home_pay*($persentase4);
		else $result = 0;

		return $result;
	}	

	public function getSisa_cuti(){		
		$result = 12;
		$cuti 	= Cuti::model()->findByAttributes(array('NIK'=>$this->NIK_Absen),array('order'=>'Id DESC'));

		if(count($cuti)!=0){
			$result = $cuti->Sisa_Cuti;
		}

		return $result;
	}

	public function getCuti_terpakai(){
		$result = 0;
		$cuti 	= Cuti::model()->findByAttributes(array('NIK'=>$this->NIK_Absen),array('order'=>'Id DESC'));

		if(count($cuti)!=0){
			$result = $cuti->Cuti_Terpakai;
		}		

		return $result;
	}

	public function getCuti(){
		$result = CutiSementara::model()->findByAttributes(array('NIK'=>$this->NIK_Absen));
		
		if(count($result)==0){
			$result 				= new CutiSementara;
			$result->Sisa_Cuti 		= $this->sisa_cuti;
			$result->Cuti_Terpakai 	= $this->cuti_terpakai;
		}
		
		return $result;
	}	

	public function getTerlambat(){
		$result = TerlambatSementara::model()->findByAttributes(array('NIK'=>$this->NIK_Absen));
		if(count($result)==0) $result = new TerlambatSementara;
		return $result;
	}

	public function getLembur(){
		$result = LemburSementara::model()->findByAttributes(array('NIK'=>$this->NIK_Absen));
		if(count($result)==0) $result = new LemburSementara;
		return $result;
	}

	public function getIjin(){
		$result = IjinSementara::model()->findByAttributes(array('NIK'=>$this->NIK_Absen));
		if(count($result)==0) $result = new IjinSementara;				
		return $result;	
	}	

	public function getJam_lembur($awal,$akhir){
		$kehadirans = TbAbsensi::model()->findAll(array(
			'condition' => 'NIK = :NIK and Ketidakhadiran is null and Tanggal between :awal and :akhir',
			'params' 	=> array('NIK'=>$this->NIK_Absen,'awal'=>$awal,'akhir'=>$akhir)
		));

		$akhir_jam_kerja 	= $this->jam_kerja->akhir;
		$jam_lembur 		= 0;

		foreach ($kehadirans as $kehadiran) {
			$lembur 	= $kehadiran->getLembur($akhir_jam_kerja);							
			$jam_lembur = $jam_lembur+$lembur[0];
		}

		return $jam_lembur*$this->ketentuan->lembur;
	}	

	public function getKeluarkota(){
		$result = KeluarKotaSementara::model()->findByAttributes(array('NIK'=>$this->NIK_Absen));
		if(count($result)==0) $result = new KeluarKotaSementara;				
		return $result;		
	}

	public function getLuar_kota($awal,$akhir){
		$kehadirans = TbAbsensi::model()->findAll(array(
			'condition' => 'NIK = :NIK and Ketidakhadiran = "ke luar kota" and Tanggal between :awal and :akhir',
			'params' 	=> array('NIK'=>$this->NIK_Absen,'awal'=>$awal,'akhir'=>$akhir)
		));		

		return count($kehadirans)*$this->ketentuan->lembur_luarkota;
	}

	// public function getRaw_absens(){
	// 	$raw_absens = RawAbsen::model()->findAllByAttributes(array('pin'=>$this->NIK_Absen));
		// $datas 		= array();
		// $tanggals 	= array();

		// foreach($raw_absens as $raw_absen){
		// 	if !in_array(ndaa, haystack)
		// }
	// }

	public function getPotongan_terlambat($awal,$akhir){		
		$Jam_Masuk	= $this->jam_kerja->awal;						
		
		$terlambats = TbAbsensi::model()->findAll(array(
			'condition' => 'NIK = :NIK and Jam_Masuk > :Jam_Masuk and Tanggal between :awal and :akhir',
			'params' 	=> array(':NIK'=>$this->NIK_Absen,':Jam_Masuk'=>$Jam_Masuk,':awal'=>$awal,':akhir'=>$akhir),
		));

		return count($terlambats)*$this->ketentuan->makan_transport;
	}

	public function getTotalPotongan($proyek,$awal,$akhir){
		$terlambat        = $this->getPotongan_terlambat($awal,$akhir);
        $pendapatan       = $this->getTotalPenggajian($proyek,$awal,$akhir);    
        $take_home_pay    = $this->getTake_home_pay($proyek,$awal,$akhir);
        $progressive      = $this->getProgressive($proyek,$awal,$akhir);        
        $denda_npwp       = $this->getDenda_npwp($proyek,$awal,$akhir);
        $pph_per_th       = $progressive+$denda_npwp/12;
        $bpjs             = (0.89/100+0.3/100+5.7/100)*$pendapatan;
        $kasbon           = $this->totalKasbon;                
        
        return $pph_per_th + $bpjs + $kasbon + $terlambat;
	}

	public function countDay($awal,$akhir){
		$weekend = 0;
		
		if($this->jam_kerja_id_2!=0) $weekend = 1;

		$date_awal 		= strtotime($awal);
		$date_awal 		= date('d-m-Y',$date_awal);
		$date_akhir		= strtotime($akhir);
		$date_akhir		= date('d-m-Y',$date_akhir);
		$date_jumlah 	= Yii::app()->count_day->getNo_weekend($date_awal,$date_akhir,'-',$weekend);		

		return $date_jumlah;
	}
}