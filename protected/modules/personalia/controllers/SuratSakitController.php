<?php

class SuratSakitController extends Controller {
    public $layout="column1";
     
    const URLUPLOAD="/../images/";
     
    function actionCreate(){
        $model=new SuratSakit;
         
        if(isset($_POST['SuratSakit'])){
            $cekFile=$model->image=  CUploadedFile::getInstance($model, 'image');
             
            if(empty($cekFile)){
                $model->attributes=$_POST['SuratSakit'];
                $model->save();
            }else{
                $model->attributes=$_POST['SuratSakit'];
                $model->image=  CUploadedFile::getInstance($model, 'image');
                 
                if($model->save()){
                    // $model->image->saveAs(Yii::app()->basePath.self::URLUPLOAD.$model->image.'');

                    echo $cekFile;
                     
                    // $this->redirect(array('SuratSakit/'));
                }
            }
        }

        $this->render('create',array('model'=>$model));
    }
     
    function actionIndex(){
        $model=new SuratSakit;
        $data=$model->findAll();
         
        $this->render('index',array('data'=>$data));
    }

    function actionShow($id){
        $model = SuratSakit::model()->findByAttributes(array('image'=>$id));

        if(count($model)==0) $model = SuratSakit::model()->find(array('condition'=>'image is null'));

        echo CHtml::image(Yii::app()->request->baseUrl.'/images/'.$model->image.'','');
    }
}