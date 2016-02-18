<?php

/**
 * This is the model class for table "unit".
 *
 * The followings are the available columns in table 'unit':
 * @property integer $id
 * @property string $kode
 * @property integer $project_id
 * @property integer $cluster_id
 * @property integer $type_id
 * @property string $jalan
 * @property string $nomor
 * @property integer $lb
 * @property integer $lt
 * @property integer $lb2
 * @property integer $lt2
 * @property integer $lt_bpn
 * @property string $status
 * @property string $kavling_area
 * @property string $kavling_image
 *
 * The followings are the available model relations:
 * @property Price[] $prices
 * @property Transaction[] $transactions
 * @property Cluster $cluster
 * @property Project $project
 * @property Type $type
 */
class Unit extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'unit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('project_id, cluster_id, type_id, lb, lt, lb2, lt2, lt_bpn', 'numerical', 'integerOnly'=>true),
			array('kode, jalan, nomor, kavling_area, kavling_image', 'length', 'max'=>255),
			array('status', 'length', 'max'=>9),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kode, project_id, cluster_id, type_id, jalan, nomor, lb, lt, lb2, lt2, lt_bpn, status, kavling_area, kavling_image', 'safe', 'on'=>'search'),
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
			'prices' => array(self::HAS_MANY, 'Price', 'unit_id'),
			'transactions' => array(self::HAS_MANY, 'Transaction', 'kavling_id'),
			'cluster' => array(self::BELONGS_TO, 'Cluster', 'cluster_id'),
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
			'type' => array(self::BELONGS_TO, 'Type', 'type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kode' => 'Kode',
			'project_id' => 'Project',
			'cluster_id' => 'Cluster',
			'type_id' => 'Type',
			'jalan' => 'Jalan',
			'nomor' => 'Nomor',
			'lb' => 'Lb',
			'lt' => 'Lt',
			'lb2' => 'Lb2',
			'lt2' => 'Lt2',
			'lt_bpn' => 'Lt Bpn',
			'status' => 'Status',
			'kavling_area' => 'Kavling Area',
			'kavling_image' => 'Kavling Image',
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
		$criteria->compare('kode',$this->kode,true);
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('cluster_id',$this->cluster_id);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('jalan',$this->jalan,true);
		$criteria->compare('nomor',$this->nomor,true);
		$criteria->compare('lb',$this->lb);
		$criteria->compare('lt',$this->lt);
		$criteria->compare('lb2',$this->lb2);
		$criteria->compare('lt2',$this->lt2);
		$criteria->compare('lt_bpn',$this->lt_bpn);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('kavling_area',$this->kavling_area,true);
		$criteria->compare('kavling_image',$this->kavling_image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Unit the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
