<?php

$this->pageTitle=Yii::app()->name;

$url    = Yii::app()->createUrl('/site/login');
$url2   = Yii::app()->createUrl('/site/personalia');
$url3   = Yii::app()->createUrl('/konsumen/project');
$role   = '';

?>

<br><br>

<?php 
	if(Yii::app()->user->isGuest==1)
    {
        // echo "not loged";
        ?><a href="<?php echo $url; ?>" class="link-button">Login</a><br><br><?php
    }
    else{        
        $role = Yii::app()->user->roles;
    	// echo "loged";
        if($role=='admin' or $role=='superadmin'){
            ?>
            <a href="<?php echo $url2; ?>" class="link-button">Personalia</a><br><br>
            <a href="#" class="link-button">....</a>         
            <?php    
        }
        else{
            ?>        
            <a href="<?php echo $url3; ?>" class="link-button">Konsumen</a><br><br>
            <a href="#" class="link-button">....</a>         
            <?php
        }    	
    }    
?>
