<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/modal.css">	

	<!-- css tambahan -->	
	<style type="text/css">
		
		.button-link{
		    padding: 10px 15px;
		    background: #BCBCBC;
		    color: #111111;		    
		    width:25%;
			margin-left:0;
			margin-right:0;			
			display:block;
			text-align:center;
		}

		.title{
			color: #ffffff;
			text-align: center;
			font-size: 17px;
			font-weight: bold;
		}

		p{white-space: pre;}

		/*.alert-box {
		    color:#555;
		    border-radius:10px;
		    font-family:Tahoma,Geneva,Arial,sans-serif;font-size:11px;
		    padding:10px 10px 10px 36px;
		    margin:10px;
		}*/

		.alert-box span{
		    font-weight:bold;
		    text-transform:uppercase;
		}

		.error{
		    background:#ffecec url('images/error.png') no-repeat 10px 50%;
		    border:1px solid #f5aca6;
		}
		.success{
		    background:#e9ffd9 url('images/success.png') no-repeat 10px 50%;
		    border:1px solid #a6ca8a;
		}
		.warning{
		    background:#fff8c4 url('images/warning.png') no-repeat 10px 50%;
		    border:1px solid #f2c779;
		}
		.notice{
		    background:#e3f7fc url('images/notice.png') no-repeat 10px 50%;
		    border:1px solid #8ed9f6;
		}
		.float_right{
			float: right;			
		}
		.block-grey{
			background-color: #F5F6CE;
			padding: 10px;	
		}
		.top-align{
			vertical-align: top;
		}
		.litle-font{
			font-size: 11px;
		}
		.overflow-scroll{
			height: 200px;
			width: 650px;			
			overflow-y: scroll;
		}
		.overflow-scroll-x{			
			width: 100%;	
			overflow-x: scroll;
		}
		.red-text{
			color: #DF013A;
		}
		h4{
			font-weight: bold;
		}
		.input_error{
			background: #FEE;
			border-color: #C00;
		}
		.table-center{
			margin: auto;			
		}
		.table-center td{
			text-align: center;
		}		

	</style>

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/button.css">
	<!-- This button was generated using CSSButtonGenerator.com -->

	<!-- css tambahan -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/table.css">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		
		<?php if(isset($this->state))
		{
			$state = $this->state;
		}else
		{
			$state = 'Error';	
		}

		$this->widget('zii.widgets.CMenu',array(
			
			'encodeLabel' 	=> false,
			'items' 		=> array(								
				array(

					'label' 		=> 'Login', 
					'url' 			=> array('/site/login'), 
					'visible' 		=> Yii::app()->user->isGuest,
					'itemOptions'	=> array('class'=>'float_right'),
				),				
				array(

					'label' 		=> 'Logout ('.Yii::app()->user->name.')', 
					'url' 			=> array('/site/logout'), 
					'visible' 		=> !Yii::app()->user->isGuest,
					'itemOptions'	=> array('class'=>'float_right'),
				),				
				array('label'=>'<div class="title">'.$state.'</div>',)
			),
		)); ?>

	</div><!-- mainmenu -->
	
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif ?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Gamantha.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
