<?php

/**
 * This is the model class for table "pendapatan_manual".
 *
 * The followings are the available columns in table 'pendapatan_manual':
 * @property integer $Nik
 * @property string $Nama
 * @property integer $Kehadiran_Maks
 * @property integer $Kehadiran_Kary
 * @property integer $Jumlah_Lembur
 * @property integer $Jumlah_Keterlambatan
 * @property integer $Jumlah_DLK
 */
class PendapatanManual extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pendapatan_manual';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Nik, Nama, Kehadiran_Maks, Kehadiran_Kary, Jumlah_Lembur, Jumlah_Keterlambatan, Jumlah_DLK', 'required'),
			array('Nik, Kehadiran_Maks, Kehadiran_Kary, Jumlah_Lembur, Jumlah_Keterlambatan, Jumlah_DLK', 'numerical', 'integerOnly'=>true),
			array('Nama', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Nik, Nama, Kehadiran_Maks, Kehadiran_Kary, Jumlah_Lembur, Jumlah_Keterlambatan, Jumlah_DLK', 'safe', 'on'=>'search'),
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
			'Nik' => 'Nik',
			'Nama' => 'Nama',
			'Kehadiran_Maks' => 'Kehadiran Maks',
			'Kehadiran_Kary' => 'Kehadiran Kary',
			'Jumlah_Lembur' => 'Jumlah Lembur',
			'Jumlah_Keterlambatan' => 'Jumlah Keterlambatan',
			'Jumlah_DLK' => 'Jumlah Dlk',
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

		$criteria->compare('Nik',$this->Nik);
		$criteria->compare('Nama',$this->Nama,true);
		$criteria->compare('Kehadiran_Maks',$this->Kehadiran_Maks);
		$criteria->compare('Kehadiran_Kary',$this->Kehadiran_Kary);
		$criteria->compare('Jumlah_Lembur',$this->Jumlah_Lembur);
		$criteria->compare('Jumlah_Keterlambatan',$this->Jumlah_Keterlambatan);
		$criteria->compare('Jumlah_DLK',$this->Jumlah_DLK);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PendapatanManual the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
