<?php

/**
 * This is the model class for table "cluster".
 *
 * The followings are the available columns in table 'cluster':
 * @property integer $id
 * @property integer $project_id
 * @property string $cluster_name
 * @property string $cluster_area
 * @property string $cluster_image
 *
 * The followings are the available model relations:
 * @property Project $project
 * @property Unit[] $units
 */
class Cluster extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cluster';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('project_id', 'numerical', 'integerOnly'=>true),
			array('cluster_name, cluster_area, cluster_image', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, project_id, cluster_name, cluster_area, cluster_image', 'safe', 'on'=>'search'),
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
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
			'units' => array(self::HAS_MANY, 'Unit', 'cluster_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'project_id' => 'Project',
			'cluster_name' => 'Cluster Name',
			'cluster_area' => 'Cluster Area',
			'cluster_image' => 'Cluster Image',
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
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('cluster_name',$this->cluster_name,true);
		$criteria->compare('cluster_area',$this->cluster_area,true);
		$criteria->compare('cluster_image',$this->cluster_image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cluster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
