<?php

/**
 * This is the model class for table "tb_ketentuan".
 *
 * The followings are the available columns in table 'tb_ketentuan':
 * @property integer $id
 * @property integer $id_golongan
 * @property integer $kode_jabatan
 * @property integer $kode_department
 * @property integer $makan_transport
 * @property integer $premi_hadir
 * @property integer $bonus_hadir
 * @property integer $lembur
 * @property integer $lembur_luarkota
 * @property integer $keterlambatan
 * @property integer $kasbon
 * @property integer $kesehatan
 *
 * The followings are the available model relations:
 * @property TbJabatan $kodeJabatan
 * @property TbDepartmen $kodeDepartment
 * @property TbGolongan $idGolongan
 */
class TbKetentuan extends CActiveRecord{
	/**
	 * @return string the associated database table name
	 */
	public function tableName(){
		return 'tb_ketentuan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(			
			array('id_golongan, kode_jabatan, kode_department, makan_transport, premi_hadir, bonus_hadir, 
				lembur, lembur_luarkota, keterlambatan, kasbon, kesehatan, Masa_Kerja', 'required'),			
			array('id, id_golongan, kode_jabatan, kode_department, makan_transport, premi_hadir, bonus_hadir, 
				lembur, lembur_luarkota, keterlambatan, kasbon, kesehatan', 'numerical', 'integerOnly'=>true),
			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.			
			array('id, id_golongan, kode_jabatan, kode_department, makan_transport, premi_hadir, bonus_hadir, 
				lembur, lembur_luarkota, keterlambatan, kasbon, kesehatan, Masa_Kerja', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'departemen' 	=> array(self::BELONGS_TO, 'TbDepartmen', 'kode_department'),
			'jabatan' 		=> array(self::BELONGS_TO, 'TbJabatan', 'kode_jabatan'),			
		);
	}

	public function getGolongan(){
		$result 				= new TbGolongan;
		$result->Nama_golongan 	= '';

		$golongan = TbGolongan::model()->findByPK($this->id_golongan);

		if(count($golongan)!=0) $result = $golongan;

		return $result;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels(){
		return array(
			'id' 				=> 'ID',
			'kasbon' 			=> 'Kasbon',
			'lembur' 			=> 'Lembur',
			'kesehatan' 		=> 'Kesehatan',
			'premi_hadir' 		=> 'Premi Hadir',
			'bonus_hadir' 		=> 'Bonus Hadir',
			'id_golongan' 		=> 'Golongan',
			'kode_jabatan' 		=> 'Jabatan',
			'keterlambatan' 	=> 'Keterlambatan',
			'kode_department' 	=> 'Department',
			'makan_transport' 	=> 'Makan Transport',
			'lembur_luarkota' 	=> 'Lembur Luarkota',
			'Masa_Kerja'		=> 'Masa Kerja'
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
	public function search(){
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_golongan',$this->id_golongan);
		$criteria->compare('kode_jabatan',$this->kode_jabatan);
		$criteria->compare('kode_department',$this->kode_department);
		$criteria->compare('makan_transport',$this->makan_transport);
		$criteria->compare('premi_hadir',$this->premi_hadir);
		$criteria->compare('bonus_hadir',$this->bonus_hadir);
		$criteria->compare('lembur',$this->lembur);
		$criteria->compare('lembur_luarkota',$this->lembur_luarkota);
		$criteria->compare('keterlambatan',$this->keterlambatan);
		$criteria->compare('kasbon',$this->kasbon);
		$criteria->compare('kesehatan',$this->kesehatan);
		$criteria->compare('Masa_Kerja',$this->Masa_Kerja);

		return new CActiveDataProvider($this, array('criteria'=>$criteria));
	}

	public function setConvertion($data){
		$this->makan_transport 	= $this->convert($data['makan_transport']);
		$this->premi_hadir 		= $this->convert($data['premi_hadir']);
		$this->bonus_hadir 		= $this->convert($data['bonus_hadir']);
		$this->lembur 			= $this->convert($data['lembur']);
		$this->lembur_luarkota 	= $this->convert($data['lembur_luarkota']);
		$this->keterlambatan 	= $this->convert($data['keterlambatan']);
		$this->kasbon 			= $this->convert($data['kasbon']);
		$this->kesehatan 		= $this->convert($data['kesehatan']);
	}

	public function convert($data){
		$data = str_replace('.', '', $data);
		// $data = explode('.', $data);
		// $data = $data[0];

		return $data;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TbKetentuan the static model class
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}	
}
