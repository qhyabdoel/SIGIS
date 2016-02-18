<?php
 
return array(

    'attributes' => array(
        'enctype' => 'multipart/form-data',
    ),
 
    'elements' => array(
	
	'user_id' => array(
    'type'=>'dropdownlist',
    'items'=>CHtml::listData(User::model()->findAll(),'id','name'),
    'prompt'=>'Please select:',
),
	
        'image' => array(
            'type' => 'file',
        ),
		
	/*	
		        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),

*/
    ),
	
	
 
   'buttons' => array(
   

        'submit_suratsakit' => array(
            'type' => 'submit',
			'label' => 'upload surat sakit',

			
        ),


    ),
	
);

?>
