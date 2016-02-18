<?php

/**
 * This is the model class for table "tb_jam_kerja".
 *
 * The followings are the available columns in table 'tb_jam_kerja':
 * @property integer $id
 * @property string $name
 * @property string $awal
 * @property string $akhir
 */
class TbJamKerja extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_jam_kerja';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, awal, akhir', 'required'),
			array('name', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, awal, akhir', 'safe', 'on'=>'search'),
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
			'id' 	=> 'ID',
			'name' 	=> 'Nama',
			'awal' 	=> 'Jam Kerja Awal',
			'akhir' => 'Jam Kerja Akhir',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('awal',$this->awal,true);
		$criteria->compare('akhir',$this->akhir,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TbJamKerja the static model class
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	public function getValue(){		
		$awal 	= $this->awal;
		$akhir 	= $this->akhir;

		return date('H:i',strtotime($awal)).' - '.date('H:i',strtotime($akhir));
	}

	public function getDropdown_list_data(){
		$name 	= $this->name;		

		if($this->id==0) return '';
		else return $name.' ('.$this->value.')';
	}	
}
