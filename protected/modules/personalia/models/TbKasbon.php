<?php

/**
 * This is the model class for table "tb_kasbon".
 *
 * The followings are the available columns in table 'tb_kasbon':
 * @property integer $id
 * @property integer $NIK
 * @property integer $pengajuan_kasbon
 * @property integer $besar_potongan
 * @property string $keterangan
 * @property string $proyek
 */
class TbKasbon extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_kasbon';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NIK, pengajuan_kasbon, besar_potongan, proyek', 'required'),
			array('NIK, pengajuan_kasbon, besar_potongan', 'numerical', 'integerOnly'=>true),
			array('keterangan', 'length', 'max'=>300),
			array('proyek', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, NIK, pengajuan_kasbon, besar_potongan, keterangan, proyek', 'safe', 'on'=>'search'),
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
			'pengembalians' => array(self::HAS_MANY, 'TbPengembalian', 'id_kasbon'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'NIK' => 'Nik',
			'pengajuan_kasbon' => 'Pengajuan Kasbon',
			'besar_potongan' => 'Besar Potongan',
			'keterangan' => 'Keterangan',
			'proyek' => 'Proyek',
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
		$criteria->compare('NIK',$this->NIK);
		$criteria->compare('pengajuan_kasbon',$this->pengajuan_kasbon);
		$criteria->compare('besar_potongan',$this->besar_potongan);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('proyek',$this->proyek,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TbKasbon the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function afterSave(){		
		for($i=1;$i<=12;$i++){ 
			$pengembalian 				= new TbPengembalian;
			$pengembalian->id_kasbon 	= $this->id;
			$pengembalian->tahun 		= date('Y');
			$pengembalian->bulan 		= $i;
			$pengembalian->save();
		}					
	}

	public function save_pengembalian($jumlahs){
		$pengembalians 	= TbPengembalian::model()->findAllByAttributes(array('id_kasbon'=>$this->id));
		$index 			= 1;

		foreach($pengembalians as $pengembalian){
			$pengembalian->jumlah = $jumlahs[$index];
			$pengembalian->save();
			$index++;
		}
	}

	public function getTotal_pengembalian(){
		$total = 0;

		foreach ($this->pengembalians as $pengembalian){
			$total = $total+$pengembalian->jumlah;
		}

		return $total;
	}
}
