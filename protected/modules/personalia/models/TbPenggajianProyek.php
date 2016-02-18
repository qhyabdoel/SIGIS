<?php

/**
 * This is the model class for table "tb_penggajian_proyek".
 *
 * The followings are the available columns in table 'tb_penggajian_proyek':
 * @property integer $id
 * @property string $awal
 * @property string $akhir
 * @property string $proyek
 * @property integer $NIK
 * @property integer $gaji_pokok
 * @property integer $tunjangan_jabatan
 * @property integer $pendapatan_intern
 */
class TbPenggajianProyek extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_penggajian_proyek';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
					
			array('id, NIK, gaji_pokok, tunjangan_jabatan, pendapatan_intern', 'numerical', 'integerOnly'=>true),
			array('proyek', 'length', 'max'=>10),
			array('awal, akhir', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, awal, akhir, proyek, NIK, gaji_pokok, tunjangan_jabatan, pendapatan_intern', 'safe', 'on'=>'search'),
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
			'awal' => 'Awal',
			'akhir' => 'Akhir',
			'proyek' => 'Proyek',
			'NIK' => 'Nik',
			'gaji_pokok' => 'Gaji Pokok',
			'tunjangan_jabatan' => 'Tunjangan Jabatan',
			'pendapatan_intern' => 'Pendapatan Intern',
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
		$criteria->compare('awal',$this->awal,true);
		$criteria->compare('akhir',$this->akhir,true);
		$criteria->compare('proyek',$this->proyek,true);
		$criteria->compare('NIK',$this->NIK);
		$criteria->compare('gaji_pokok',$this->gaji_pokok);
		$criteria->compare('tunjangan_jabatan',$this->tunjangan_jabatan);
		$criteria->compare('pendapatan_intern',$this->pendapatan_intern);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TbPenggajianProyek the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function afterSave(){
		$penggajian = TbPenggajianProyek::model()->find(
			array(
				'condition'=>'NIK = :NIK and proyek = :proyek and id <> :id',
				'params'=>array(':NIK'=>$this->NIK,':proyek'=>$this->proyek,':id'=>$this->id),
			),
			array(
				'condition'=>'awal <= :akhir or akhir >= :awal',
				'params'=>array(':awal'=>$this->awal,':akhir'=>$this->akhir),
			)
		);

		if(count($penggajian)!=0) $penggajian->delete();
	}
}