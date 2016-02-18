<?php

/**
 * This is the model class for table "cuti_sementara".
 *
 * The followings are the available columns in table 'cuti_sementara':
 * @property integer $Id
 * @property integer $NIK
 * @property string $Nama
 * @property string $Departmen
 * @property string $Jabatan
 * @property string $Tanggal_Awal
 * @property string $Tanggal_Akhir
 * @property integer $Total_Cuti
 * @property integer $Cuti_Terpakai
 * @property integer $Sisa_Cuti
 * @property string $Alasan_Cuti
 * @property string $Alamat_Cuti
 * @property integer $Masa_Kerja
 * @property string $Status
 */
class CutiSementara extends CActiveRecord
{
	public $final 		= 0;	

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cuti_sementara';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NIK, Nama, Departmen, Jabatan, Tanggal_Awal, Tanggal_Akhir, Total_Cuti, Cuti_Terpakai, Sisa_Cuti', 'required'),
			array('NIK, Total_Cuti, Cuti_Terpakai, Sisa_Cuti, Masa_Kerja', 'numerical', 'integerOnly'=>true),
			array('Nama, Departmen, Jabatan', 'length', 'max'=>100),
			array('Status', 'length', 'max'=>9),
			array('Alasan_Cuti, Alamat_Cuti', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, NIK, Nama, Departmen, Jabatan, Tanggal_Awal, Tanggal_Akhir, Total_Cuti, Cuti_Terpakai, Sisa_Cuti, Alasan_Cuti, Alamat_Cuti, Masa_Kerja, Status', 'safe', 'on'=>'search'),
			array('Tanggal_Awal, Tanggal_Akhir', 'on_absensi'),
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
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'NIK' => 'Nik',
			'Nama' => 'Nama',
			'Departmen' => 'Departmen',
			'Jabatan' => 'Jabatan',
			'Tanggal_Awal' => 'Tanggal Awal',
			'Tanggal_Akhir' => 'Tanggal Akhir',
			'Total_Cuti' => 'Total Cuti',
			'Cuti_Terpakai' => 'Cuti Terpakai',
			'Sisa_Cuti' => 'Sisa Cuti',
			'Alasan_Cuti' => 'Alasan Cuti',
			'Alamat_Cuti' => 'Alamat Cuti',
			'Masa_Kerja' => 'Masa Kerja',
			'Status' => 'Status',
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

		$criteria->compare('Id',$this->Id);
		$criteria->compare('NIK',$this->NIK);
		$criteria->compare('Nama',$this->Nama,true);
		$criteria->compare('Departmen',$this->Departmen,true);
		$criteria->compare('Jabatan',$this->Jabatan,true);
		$criteria->compare('Tanggal_Awal',$this->Tanggal_Awal,true);
		$criteria->compare('Tanggal_Akhir',$this->Tanggal_Akhir,true);
		$criteria->compare('Total_Cuti',$this->Total_Cuti);
		$criteria->compare('Cuti_Terpakai',$this->Cuti_Terpakai);
		$criteria->compare('Sisa_Cuti',$this->Sisa_Cuti);
		$criteria->compare('Alasan_Cuti',$this->Alasan_Cuti,true);
		$criteria->compare('Alamat_Cuti',$this->Alamat_Cuti,true);
		$criteria->compare('Masa_Kerja',$this->Masa_Kerja);
		$criteria->compare('Status',$this->Status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CutiSementara the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}	

	public function afterSave(){
		// $cuti = Cuti::model()->findByAttributes(array('NIK'=>$this->NIK));
		// echo "string";

		// if(count($cuti)==0)
		$cuti = new Cuti;		

		if($this->Status=='disetujui'){
			$cuti->attributes = $this->attributes;
			$cuti->save();
			$this->final = 1;
		}
		elseif($this->Status=='ditolak'){
			$this->delete();
		}		
	}	

	// public function getSisa_cuti(){
	// 	TbKaryawan::model()->find(array('order'=>''))
	// }
}
