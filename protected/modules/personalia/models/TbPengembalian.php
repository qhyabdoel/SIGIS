<?php

/**
 * This is the model class for table "tb_pengembalian".
 *
 * The followings are the available columns in table 'tb_pengembalian':
 * @property integer $id
 * @property integer $id_kasbon
 * @property integer $tahun
 * @property integer $bulan
 * @property integer $jumlah
 *
 * The followings are the available model relations:
 * @property TbKasbon $idKasbon
 */
class TbPengembalian extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_pengembalian';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_kasbon, tahun, bulan', 'required'),
			array('id_kasbon, tahun, bulan, jumlah', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_kasbon, tahun, bulan, jumlah', 'safe', 'on'=>'search'),
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
			'kasbon' => array(self::BELONGS_TO, 'TbKasbon', 'id_kasbon'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_kasbon' => 'Id Kasbon',
			'tahun' => 'Tahun',
			'bulan' => 'Bulan',
			'jumlah' => 'Jumlah',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('id_kasbon',$this->id_kasbon);
		$criteria->compare('tahun',$this->tahun);
		$criteria->compare('bulan',$this->bulan);
		$criteria->compare('jumlah',$this->jumlah);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TbPengembalian the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	// public function afterSave(){
		
	// }
}
