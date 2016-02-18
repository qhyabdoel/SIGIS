<?php

/**
 * This is the model class for table "tb_ketentuan_pph".
 *
 * The followings are the available columns in table 'tb_ketentuan_pph':
 * @property integer $id
 * @property integer $batas_take_home_pay_1
 * @property integer $batas_take_home_pay_2
 * @property integer $persentase_tarif_1
 * @property integer $persentase_tarif_2
 * @property integer $persentase_tarif_3
 * @property integer $persentase_tarif_4
 */
class TbKetentuanPph extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_ketentuan_pph';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('batas_take_home_pay_1, batas_take_home_pay_2, persentase_tarif_1, 
				persentase_tarif_2, persentase_tarif_3, persentase_tarif_4', 'required'),
			array('batas_take_home_pay_1, batas_take_home_pay_2, persentase_tarif_1, 
				persentase_tarif_2, persentase_tarif_3, persentase_tarif_4', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, batas_take_home_pay_1, batas_take_home_pay_2, persentase_tarif_1, persentase_tarif_2, persentase_tarif_3, persentase_tarif_4', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'batas_take_home_pay_1' => 'Batas Take Home Pay 1',
			'batas_take_home_pay_2' => 'Batas Take Home Pay 2',
			'persentase_tarif_1' => 'Persentase Tarif 1',
			'persentase_tarif_2' => 'Persentase Tarif 2',
			'persentase_tarif_3' => 'Persentase Tarif 3',
			'persentase_tarif_4' => 'Persentase Tarif 4',
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
		$criteria->compare('batas_take_home_pay_1',$this->batas_take_home_pay_1);
		$criteria->compare('batas_take_home_pay_2',$this->batas_take_home_pay_2);
		$criteria->compare('persentase_tarif_1',$this->persentase_tarif_1);
		$criteria->compare('persentase_tarif_2',$this->persentase_tarif_2);
		$criteria->compare('persentase_tarif_3',$this->persentase_tarif_3);
		$criteria->compare('persentase_tarif_4',$this->persentase_tarif_4);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TbKetentuanPph the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}	
}
