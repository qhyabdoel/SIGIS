<?php

/**
 * This is the model class for table "sakit_sementara".
 *
 * The followings are the available columns in table 'sakit_sementara':
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
 * @property string $Status
 */
class SakitSementara extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sakit_sementara';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NIK, Nama, Departmen, Jabatan, Tanggal_Awal, Tanggal_Akhir', 'required'),
			array('NIK, Masa_Kerja', 'numerical', 'integerOnly'=>true),
			array('Nama, Departmen, Jabatan, Surat_Dokter', 'length', 'max'=>100),
			array('Status', 'length', 'max'=>9),
			array('Alasan', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Id, NIK, Nama, Departmen, Jabatan, Tanggal_Awal, Tanggal_Akhir, Surat_Dokter, Alasan, Masa_Kerja, Status', 'safe', 'on'=>'search'),
		);
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
			'Surat_Dokter' => 'Surat Dokter',
			'Alasan' => 'Alasan',
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
		$criteria->compare('Surat_Dokter',$this->Surat_Dokter,true);
		$criteria->compare('Alasan',$this->Alasan,true);
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
	 * @return SakitSementara the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
