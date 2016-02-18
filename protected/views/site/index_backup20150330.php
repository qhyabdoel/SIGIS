<?php

$this->pageTitle=Yii::app()->name;

$url    = Yii::app()->createUrl('/site/login');
$url2   = Yii::app()->createUrl('/site/personalia');

?>

<br><br>

<?php 
	if(Yii::app()->user->isGuest==1)
    {
        // echo "not loged";
        ?><a href="<?php echo $url; ?>" class="link-button">Login</a><br><br><?php
    }
    else{
    	// echo "loged";
    	?>
        <a href="<?php echo $url2; ?>" class="link-button">Personalia</a><br><br>
		<a href="#" class="link-button">....</a>
		<?php
    }    
?>
