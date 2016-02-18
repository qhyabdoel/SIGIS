<?php

/**
 * This is the model class for table "tb_golongan".
 *
 * The followings are the available columns in table 'tb_golongan':
 * @property integer $ID
 * @property string $Nama_golongan
 * @property integer $Tahun_masa_kerja
 * @property integer $Bulan_masa_kerja
 *
 * The followings are the available model relations:
 * @property TbKetentuan[] $tbKetentuans
 */
class TbGolongan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_golongan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Nama_golongan', 'required'),
			array('Tahun_masa_kerja, Bulan_masa_kerja', 'numerical', 'integerOnly'=>true),
			array('Nama_golongan', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, Nama_golongan, Tahun_masa_kerja, Bulan_masa_kerja', 'safe', 'on'=>'search'),
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
			'tbKetentuans' => array(self::HAS_MANY, 'TbKetentuan', 'id_golongan'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' 				=> 'ID',
			'Nama_golongan' 	=> 'Nama Golongan',
			'Tahun_masa_kerja' 	=> 'Tahun Masa Kerja',
			'Bulan_masa_kerja' 	=> 'Bulan Masa Kerja',
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
		$criteria->compare('Nama_golongan',$this->Nama_golongan,true);
		$criteria->compare('Tahun_masa_kerja',$this->Tahun_masa_kerja);
		$criteria->compare('Bulan_masa_kerja',$this->Bulan_masa_kerja);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TbGolongan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
