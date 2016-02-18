<?php

/**
 * This is the model class for table "sakit".
 *
 * The followings are the available columns in table 'sakit':
 * @property integer $Id
 * @property integer $NIK
 * @property string $Nama
 * @property string $Departmen
 * @property string $Jabatan
 * @property string $Tanggal_Awal
 * @property string $Tanggal_Akhir
 * @property string $Surat_Dokter
 * @property string $Alasan
 * @property integer $Masa_Kerja
 */
class Sakit extends CActiveRecord{
	/**
	 * @return string the associated database table name
	 */
	public function tableName(){
		return 'sakit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NIK, Nama, Departmen, Jabatan, Tanggal_Awal, Tanggal_Akhir', 'required'),
			array('NIK, Masa_Kerja', 'numerical', 'integerOnly'=>true),
			array('Nama, Departmen, Jabatan, Surat_Dokter', 'length', 'max'=>100),
			array('Alasan', 'safe'),
			array(
				'Tanggal_Awal','compare','compareAttribute'=>'Tanggal_Akhir',
				'operator'=>'<','message'=>'Periode awal harus lebih kecil dari periode akhir'
			),
			array('Tanggal_Awal, Tanggal_Akhir', 'on_absensi'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, NIK, Nama, Departmen, Jabatan, Tanggal_Awal, Tanggal_Akhir, Surat_Dokter, Alasan, Masa_Kerja', 'safe', 'on'=>'search'),
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
			'Id' 			=> 'ID',
			'NIK' 			=> 'Nik',
			'Nama' 			=> 'Nama',
			'Alasan' 		=> 'Alasan',
			'Jabatan' 		=> 'Jabatan',
			'Departmen' 	=> 'Departmen',
			'Masa_Kerja' 	=> 'Masa Kerja',
			'Tanggal_Awal' 	=> 'Tanggal Awal',
			'Surat_Dokter' 	=> 'Surat Dokter',
			'Tanggal_Akhir' => 'Tanggal Akhir',
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
		$criteria->compare('Masa_Kerja',$this->Masa_Kerja);
		
		$criteria->compare('Nama',$this->Nama,true);
		$criteria->compare('Alasan',$this->Alasan,true);
		$criteria->compare('Jabatan',$this->Jabatan,true);
		$criteria->compare('Departmen',$this->Departmen,true);
		$criteria->compare('Tanggal_Awal',$this->Tanggal_Awal,true);
		$criteria->compare('Surat_Dokter',$this->Surat_Dokter,true);
		$criteria->compare('Tanggal_Akhir',$this->Tanggal_Akhir,true);

		return new CActiveDataProvider($this, array('criteria' => $criteria));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Sakit the static model class
	 */
	public static function model($className=__CLASS__)	{
		return parent::model($className);
	}

	public function afterSave(){		
		$timespan = (strtotime($this->Tanggal_Akhir)-strtotime($this->Tanggal_Awal))/86400;

		$tanggal = $this->Tanggal_Awal;

		for($i=0;$i<=$timespan;$i++){ 
			$absensi 					= new TbAbsensi;
			$absensi->NIK 				= $this->NIK;
			$absensi->Tanggal 			= $tanggal;
			$absensi->Ketidakhadiran 	= 'sakit';
			$absensi->save();
			
			$tanggal = date('Y-m-d',strtotime($tanggal)+86400);
		}
	}
}