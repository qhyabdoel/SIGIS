<?php

/**
 * This is the model class for table "tb_absensi".
 *
 * The followings are the available columns in table 'tb_absensi':
 * @property integer $Id_Absen
 * @property integer $NIK
 * @property string $Tanggal
 * @property string $Jam_Masuk
 * @property string $Jam_Keluar
 * @property string $Total_Jam_Kerja
 */
class TbAbsensi extends CActiveRecord{
	/**
	 * @return string the associated database table name
	 */
	public function tableName(){
		return 'tb_absensi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NIK, Tanggal', 'required'),
			array('NIK', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id_Absen, NIK, Tanggal, Jam_Masuk, Jam_Keluar, Total_Jam_Kerja', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array('nik_absen'=>array(self::BELONGS_TO,'NikAbsen','NIK'));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels(){
		return array(
			'NIK' 				=> 'Nik',
			'Tanggal' 			=> 'Tanggal',
			'Id_Absen' 			=> 'Id Absen',
			'Jam_Masuk' 		=> 'Jam Masuk',
			'Jam_Keluar' 		=> 'Jam Keluar',
			'Total_Jam_Kerja' 	=> 'Total Jam Kerja',
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

		$criteria->compare('NIK',$this->NIK);
		$criteria->compare('Id_Absen',$this->Id_Absen);
		
		$criteria->compare('Tanggal',$this->Tanggal,true);
		$criteria->compare('Jam_Masuk',$this->Jam_Masuk,true);
		$criteria->compare('Jam_Keluar',$this->Jam_Keluar,true);
		$criteria->compare('Total_Jam_Kerja',$this->Total_Jam_Kerja,true);

		return new CActiveDataProvider($this, array('criteria'=>$criteria));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TbAbsensi the static model class
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}	

	public function getLembur_mentah($akhir_jam_kerja){
		$jam_keluar 		= strtotime($this->Jam_Keluar);
		$akhir_jam_kerja 	= strtotime($akhir_jam_kerja);
		$result 			= $jam_keluar-$akhir_jam_kerja;		

		if($this->Jam_Keluar=='') $result = '';

		return $result;	
	}

	public function getLembur($akhir_jam_kerja){		
		$lembur 			= $this->getLembur_mentah($akhir_jam_kerja);
		$lembur_jam			= floor($lembur/3600);
		$lembur_menit 		= floor(($lembur/3600-$lembur_jam)*60);
		$result 			= $lembur_jam." jam ".$lembur_menit." menit";

		if($lembur=='') $result = '';

		return $result;
	}	
}
