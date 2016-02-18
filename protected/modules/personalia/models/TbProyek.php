<?php

/**
 * This is the model class for table "tb_proyek".
 *
 * The followings are the available columns in table 'tb_proyek':
 * @property integer $ID
 * @property string $Nama_proyek
 * @property integer $Gaji_proyek
 *
 * The followings are the available model relations:
 * @property TbPenggajian[] $tbPenggajians
 * @property TbPenggajian[] $tbPenggajians1
 */
class TbProyek extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_proyek';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Nama_proyek, Gaji_proyek', 'required'),
			array('Gaji_proyek', 'numerical', 'integerOnly'=>true),
			array('Nama_proyek', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, Nama_proyek, Gaji_proyek', 'safe', 'on'=>'search'),
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
			'tbPenggajians' => array(self::HAS_MANY, 'TbPenggajian', 'Nama_proyek'),
			'tbPenggajians1' => array(self::HAS_MANY, 'TbPenggajian', 'Gaji_proyek'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Nama_proyek' => 'Nama Proyek',
			'Gaji_proyek' => 'Gaji Proyek',
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('Nama_proyek',$this->Nama_proyek,true);
		$criteria->compare('Gaji_proyek',$this->Gaji_proyek);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TbProyek the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
