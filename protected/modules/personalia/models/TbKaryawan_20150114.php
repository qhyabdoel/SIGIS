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
 * @property string $No_Rek
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
			array('Nama, No_ID, Nama_Rek, Tempat_Lahir, Alamat_Email, No_NPWP, No_KPJ, No_Rek', 'length', 'max'=>50),
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
				Alamat_Rumah, No_Telp_Rumah, No_HP, No_HP2, Alamat_Email, No_NPWP, No_KPJ, Nama_Rek, 
				Bank_Rek, No_Rek, NIK_Absen', 'safe', 'on'=>'search'
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
			'departemen' => array(self::BELONGS_TO,'TbDepartmen','Kode_Departement'),
			'nik_absen'  => array(self::HAS_ONE,'NikAbsen','nik_karyawan'),
			'jabatan' 	 => array(self::BELONGS_TO,'TbJabatan','Kode_Jabatan'),
			'kasbons' 	 => array(self::HAS_MANY,'TbKasbon','NIK'),			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels(){
		return array(
			'NIK' 				=> 'NIK',
			'Nama' 				=> 'Nama',
			'No_ID' 			=> 'No',
			'No_HP' 			=> 'No Hp',
			'Status' 			=> 'Status',
			'No_HP2' 			=> 'No Hp2',
			'No_KPJ' 			=> 'No Kpj',
			'No_Rek' 			=> 'No',
			'No_NPWP' 			=> 'No Npwp',
			'Bank_Rek' 			=> 'Bank',
			'Jenis_ID' 			=> 'Jenis',
			'Nama_Rek'			=> 'Nama',
			'NIK_Absen'			=> 'NIK Absen',
			'Masa_Kerja' 		=> 'Masa Kerja',
			'Kode_Jabatan' 		=> 'Jabatan',
			'Status_Kerja' 		=> 'Status Kerja',
			'Tempat_Lahir' 		=> 'Tempat Lahir',
			'Alamat_Rumah' 		=> 'Alamat Rumah',
			'Kontrak_Awal' 		=> 'Periode Kontrak',
			'Kontrak_Akhir' 	=> 'Kontrak Akhir',
			'Alamat_Email' 		=> 'Alamat Email',
			'Tanggal_Lahir' 	=> 'Tanggal Lahir',
			'Tanggal_Masuk' 	=> 'Tanggal Masuk',
			'No_Telp_Rumah' 	=> 'No Telp Rumah',
			'Kode_Departement' 	=> 'Departement',
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
		$criteria->compare('No_Rek',$this->No_Rek,true);
		$criteria->compare('No_NPWP',$this->No_NPWP,true);
		$criteria->compare('Bank_Rek',$this->Bank_Rek,true);
		$criteria->compare('Nama_Rek',$this->Nama_Rek,true);
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
		$result->active = 1;

		$ketentuans = TbKetentuan::model()->findAllByAttributes(array(
			'kode_department' 	=> $this->Kode_Departement,
			'kode_jabatan' 		=> $this->Kode_Jabatan,			
		));		

		foreach($ketentuans as $ketentuan){			
			$masa_kerja = explode("-",$ketentuan->Masa_Kerja);
			
			if($this->masa_kerja>=$masa_kerja[0] and $this->masa_kerja<=$masa_kerja[1]) 
				$result = $ketentuan;			
		}		

		return $result;
	}

	public function getKehadiran($awal,$akhir){
		$kehadirans = TbAbsensi::model()->findAll(array(
			'condition' => 'NIK = :NIK and Ketidakhadiran is null and Tanggal between :awal and :akhir',
			'params' 	=> array('NIK'=>$this->NIK_Absen,'awal'=>$awal,'akhir'=>$akhir)
		));

		return count($kehadirans);
	}

	public function getKetidakhadiran($ketidakhadiran,$awal,$akhir){
		$kehadirans = TbAbsensi::model()->findAll(array(
			'condition' => 'NIK = :NIK and Ketidakhadiran = :ketidakhadiran and Tanggal between :awal and :akhir',
			'params' 	=> array('NIK'=>$this->NIK_Absen, 'ketidakhadiran'=>$ketidakhadiran, 'awal'=>$awal,'akhir'=>$akhir)
		));

		return count($kehadirans);	
	}

	public function getTotalKasbon(){
		$total = 0;

		foreach($this->kasbons as $kasbon){
			$total = $total+$this->pengajuan_kasbon;
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
		$pendapatan       	= $this->getTotalPenggajian($proyek,$awal,$akhir);
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
		$pendapatan 	= $this->getTotalPenggajian($proyek,$awal,$akhir);
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
		// $cutis 	= Cuti::model()->findAllByAttributes(array('NIK'=>$this->NIK_Absen));
		// $result = 12;		

		// foreach($cutis as $cuti){
		// 	$result = $result-$cuti->Cuti_Terpakai;
		// }

		$result = 12;
		$cuti 	= Cuti::model()->find(array('order'=>'Id DESC'));

		if(count($cuti)!=0){
			$result = $cuti->Sisa_Cuti;
		}

		return $result;
	}

	public function getCuti_terpakai(){
		$total_cuti	= 12;
		$result 	= $total_cuti-$this->sisa_cuti;

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
}