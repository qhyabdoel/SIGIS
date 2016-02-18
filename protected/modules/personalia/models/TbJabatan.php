<?php

/**
 * This is the model class for table "tb_jabatan".
 *
 * The followings are the available columns in table 'tb_jabatan':
 * @property integer $Kode_Jabatan
 * @property string $Nama_Jabatan
 *
 * The followings are the available model relations:
 * @property TbKaryawan[] $tbKaryawans
 * @property TbKetentuan[] $tbKetentuans
 */
class TbJabatan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_jabatan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Nama_Jabatan', 'required'),
			array('Nama_Jabatan', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Kode_Jabatan, Nama_Jabatan', 'safe', 'on'=>'search'),
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
			'tbKaryawans' => array(self::HAS_MANY, 'TbKaryawan', 'Kode_Jabatan'),
			'tbKetentuans' => array(self::HAS_MANY, 'TbKetentuan', 'kode_jabatan'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Kode_Jabatan' => 'Kode Jabatan',
			'Nama_Jabatan' => 'Nama Jabatan',
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

		$criteria->compare('Kode_Jabatan',$this->Kode_Jabatan);
		$criteria->compare('Nama_Jabatan',$this->Nama_Jabatan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TbJabatan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
