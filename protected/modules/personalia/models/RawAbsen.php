<?php

/**
 * This is the model class for table "raw_absen".
 *
 * The followings are the available columns in table 'raw_absen':
 * @property string $hardware_id
 * @property string $pin
 * @property string $date
 * @property string $time
 * @property string $verified
 * @property string $status
 * @property string $workcode
 * @property string $status_absen
 */
class RawAbsen extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'raw_absen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pin, date, time, verified, status, workcode, status_absen', 'required'),
			array('hardware_id, pin, verified, status, workcode, status_absen', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('hardware_id, pin, date, time, verified, status, workcode, status_absen', 'safe', 'on'=>'search'),
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
			'hardware_id' => 'Hardware',
			'pin' => 'Pin',
			'date' => 'Date',
			'time' => 'Time',
			'verified' => 'Verified',
			'status' => 'Status',
			'workcode' => 'Workcode',
			'status_absen' => 'Status Absen',
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

		$criteria->compare('hardware_id',$this->hardware_id,true);
		$criteria->compare('pin',$this->pin,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('verified',$this->verified,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('workcode',$this->workcode,true);
		$criteria->compare('status_absen',$this->status_absen,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RawAbsen the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
