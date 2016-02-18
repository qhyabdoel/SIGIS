<?php

/**
 * This is the model class for table "ijin".
 *
 * The followings are the available columns in table 'ijin':
 * @property integer $Id
 * @property integer $NIK
 * @property string $Nama
 * @property string $Department
 * @property string $Jabatan
 * @property string $Tanggal_Awal
 * @property string $Tanggal_Akhir
 * @property integer $Ijin_Bulanan
 * @property integer $Lama_Ijin
 * @property integer $Total_Ijin_Bulanan
 * @property string $Alasan_Ijin
 * @property string $Alamat_Ijin
 * @property integer $Masa_Kerja
 */
class Ijin extends CActiveRecord{
	/**
	 * @return string the associated database table name
	 */
	public function tableName(){
		return 'ijin';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NIK, Nama, Department, Jabatan, Tanggal_Awal, Tanggal_Akhir, Ijin_Bulanan, Lama_Ijin, Total_Ijin_Bulanan', 'required'),
			array('NIK, Ijin_Bulanan, Lama_Ijin, Total_Ijin_Bulanan, Masa_Kerja', 'numerical', 'integerOnly'=>true),
			array('Nama, Department, Jabatan', 'length', 'max'=>100),
			array('Alasan_Ijin, Alamat_Ijin', 'safe'),
			array(
				'Tanggal_Awal','compare','compareAttribute'=>'Tanggal_Akhir',
				'operator'=>'<','message'=>'Periode awal harus lebih kecil dari periode akhir'
			),
			array('Tanggal_Awal, Tanggal_Akhir', 'on_absensi'),
			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, NIK, Nama, Department, Jabatan, Tanggal_Awal, Tanggal_Akhir, Ijin_Bulanan, Lama_Ijin, Total_Ijin_Bulanan, Alasan_Ijin, Alamat_Ijin, Masa_Kerja', 'safe', 'on'=>'search'),
		);
	}

	public function on_absensi($attributes,$params){
		$absensis = TbAbsensi::model()->findAll(array(
			'condition' => 'NIK = :NIK and Tanggal between :awal and :akhir',
			'params' 	=> array('NIK'=>$this->NIK,'awal'=>$this->Tanggal_Awal,'akhir'=>$this->Tanggal_Akhir)
		));

		if(count($absensis)!=0) $this->addError('Tanggal_Akhir','data absensi pada periode ini sudah ada.');
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels(){
		return array(
			'Id' 					=> 'ID',
			'NIK' 					=> 'Nik',
			'Nama' 					=> 'Nama',
			'Jabatan' 				=> 'Jabatan',
			'Lama_Ijin' 			=> 'Lama Ijin',
			'Masa_Kerja' 			=> 'Masa Kerja',
			'Department' 			=> 'Department',
			'Alasan_Ijin' 			=> 'Alasan Ijin',
			'Alamat_Ijin' 			=> 'Alamat Ijin',
			'Ijin_Bulanan' 			=> 'Ijin Bulanan',
			'Tanggal_Awal' 			=> 'Tanggal Awal',
			'Tanggal_Akhir' 		=> 'Tanggal Akhir',
			'Total_Ijin_Bulanan' 	=> 'Total Ijin Bulanan',
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
	public function search(){
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('Id',$this->Id);
		$criteria->compare('NIK',$this->NIK);
		$criteria->compare('Lama_Ijin',$this->Lama_Ijin);
		$criteria->compare('Masa_Kerja',$this->Masa_Kerja);
		$criteria->compare('Ijin_Bulanan',$this->Ijin_Bulanan);
		$criteria->compare('Total_Ijin_Bulanan',$this->Total_Ijin_Bulanan);

		$criteria->compare('Nama',$this->Nama,true);
		$criteria->compare('Jabatan',$this->Jabatan,true);
		$criteria->compare('Department',$this->Department,true);
		$criteria->compare('Alamat_Ijin',$this->Alamat_Ijin,true);
		$criteria->compare('Alasan_Ijin',$this->Alasan_Ijin,true);
		$criteria->compare('Tanggal_Awal',$this->Tanggal_Awal,true);
		$criteria->compare('Tanggal_Akhir',$this->Tanggal_Akhir,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ijin the static model class
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	public function afterSave(){		
		$timespan = (strtotime($this->Tanggal_Akhir)-strtotime($this->Tanggal_Awal))/86400;

		$tanggal = $this->Tanggal_Awal;

		for($i=0;$i<=$timespan;$i++){ 
			$absensi 					= new TbAbsensi;
			$absensi->NIK 				= $this->NIK;
			$absensi->Tanggal 			= $tanggal;
			$absensi->Ketidakhadiran 	= 'ijin';
			$absensi->save();
			
			$tanggal = date('Y-m-d',strtotime($tanggal)+86400);
		}
	}
}
