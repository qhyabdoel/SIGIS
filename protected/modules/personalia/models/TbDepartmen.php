<?php

/**
 * This is the model class for table "tb_departmen".
 *
 * The followings are the available columns in table 'tb_departmen':
 * @property integer $Kode_Department
 * @property string $Nama_Department
 *
 * The followings are the available model relations:
 * @property TbKaryawan[] $tbKaryawans
 * @property TbKetentuan[] $tbKetentuans
 */
class TbDepartmen extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_departmen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Nama_Department', 'required'),
			array('Nama_Department', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Kode_Department, Nama_Department', 'safe', 'on'=>'search'),
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
			'tbKaryawans' => array(self::HAS_MANY, 'TbKaryawan', 'Kode_Departement'),
			'tbKetentuans' => array(self::HAS_MANY, 'TbKetentuan', 'kode_department'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Kode_Department' => 'Kode Department',
			'Nama_Department' => 'Nama Department',
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

		$criteria->compare('Kode_Department',$this->Kode_Department);
		$criteria->compare('Nama_Department',$this->Nama_Department,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TbDepartmen the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
