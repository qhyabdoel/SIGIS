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
			array('Kode_Departement, Kode_Jabatan, Masa_Kerja, No_Telp_Rumah, No_HP, No_HP2, NIK_Absen', 'numerical', 'integerOnly'=>true),
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
	    	if($this->$attributes=='') $this->addError($attributes,'Periode kontrak belum diisi.');	    	
	    }
	}

	/**
	 * @return array relational rules.
	 */
	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'departemen' 	=> array(self::BELONGS_TO, 'TbDepartmen', 'Kode_Departement'),
			'jabatan' 		=> array(self::BELONGS_TO, 'TbJabatan', 'Kode_Jabatan'),
			'nik_absen' 	=> array(self::HAS_ONE, 'NikAbsen', 'nik_karyawan'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels(){
		return array(

			'NIK' 				=> 'NIK',
			'Nama' 				=> 'NAMA',
			'Kode_Departement' 	=> 'DEPARTEMEN',
			'Kode_Jabatan' 		=> 'JABATAN',
			'Tanggal_Masuk' 	=> 'TANGGAL MASUK',
			'Masa_Kerja' 		=> 'MASA KERJA',
			'Status_Kerja' 		=> 'STATUS KERJA',
			'Kontrak_Awal' 		=> 'PERIODE KONTRAK',
			'Kontrak_Akhir' 	=> 'KONTRAK AKHIR',
			'Jenis_ID' 			=> 'JENIS',
			'No_ID' 			=> 'NO',
			'Status' 			=> 'STATUS',
			'Tempat_Lahir' 		=> 'TEMPAT LAHIR',
			'Tanggal_Lahir' 	=> 'TANGGAL LAHIR',
			'Alamat_Rumah' 		=> 'ALAMAT RUMAH',
			'No_Telp_Rumah' 	=> 'NO TELP.RUMAH ',
			'No_HP' 			=> 'NO HP',
			'No_HP2' 			=> 'NO HP2',
			'Alamat_Email' 		=> 'ALAMAT EMAIL',
			'No_NPWP' 			=> 'NO NPWP',
			'No_KPJ' 			=> 'NO KPJ',
			'Bank_Rek' 			=> 'BANK',
			'No_Rek' 			=> 'NO',
			'Nama_Rek'			=> 'NAMA',
			'NIK_Absen'			=> 'NIK ABSEN',
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
		$criteria->compare('Nama',$this->Nama,true);
		$criteria->compare('Kode_Departement',$this->Kode_Departement);
		$criteria->compare('Kode_Jabatan',$this->Kode_Jabatan);
		$criteria->compare('Tanggal_Masuk',$this->Tanggal_Masuk,true);
		$criteria->compare('Masa_Kerja',$this->Masa_Kerja);
		$criteria->compare('Status_Kerja',$this->Status_Kerja,true);
		$criteria->compare('Kontrak_Awal',$this->Kontrak_Awal,true);
		$criteria->compare('Kontrak_Akhir',$this->Kontrak_Akhir,true);
		$criteria->compare('Jenis_ID',$this->Jenis_ID,true);
		$criteria->compare('No_ID',$this->No_ID,true);
		$criteria->compare('Status',$this->Status,true);
		$criteria->compare('Tempat_Lahir',$this->Tempat_Lahir,true);
		$criteria->compare('Tanggal_Lahir',$this->Tanggal_Lahir,true);
		$criteria->compare('Alamat_Rumah',$this->Alamat_Rumah,true);
		$criteria->compare('No_Telp_Rumah',$this->No_Telp_Rumah);
		$criteria->compare('No_HP',$this->No_HP);
		$criteria->compare('No_HP2',$this->No_HP2);
		$criteria->compare('Alamat_Email',$this->Alamat_Email,true);
		$criteria->compare('No_NPWP',$this->No_NPWP,true);
		$criteria->compare('No_KPJ',$this->No_KPJ,true);
		$criteria->compare('Bank_Rek',$this->Bank_Rek,true);
		$criteria->compare('No_Rek',$this->No_Rek,true);
		$criteria->compare('NIK_Absen',$this->NIK_Absen,true);
		$criteria->compare('Nama_Rek',$this->Nama_Rek,true);

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

		foreach($penggajians as $penggajian) 
		{
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

		foreach($penggajians as $penggajian){$total	= $total+$penggajian->tunjangan_jabatan;}

		return $total;
	}

	public function getKetentuan(){
		$ketentuan = TbKetentuan::model()->findByAttributes(array(
			'kode_department' 	=> $this->Kode_Departement,
			'kode_jabatan' 		=> $this->Kode_Jabatan,
			'Masa_Kerja' 		=> $this->Masa_Kerja,
		));

		return $ketentuan;		
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
}
