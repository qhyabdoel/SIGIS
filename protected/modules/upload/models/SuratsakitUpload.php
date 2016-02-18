<?php

class SuratsakitUpload extends CFormModel
{
    public $image;
	public $user_id;
		public $expiration_date;

    public function rules()
    {
        return array(
           array('image', 'file', 'allowEmpty' => false, 'safe'=>true,'types' => 'jpg, jpeg, gif, png','maxSize'=>1024 * 1024 * 1, 'tooLarge'=>'File has to be smaller than 1MB'),
		   		   //array('expiration_date','date','format'=>array('yyyy-mm-dd',)),
		 //  array('doc', 'file', 'allowEmpty' => false, 'safe'=>true,'types' => 'doc'),
		 	array('user_id', 'length', 'max'=>20),
        );
    }


	}
	
	?>