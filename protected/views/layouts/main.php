<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/css3.css" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jui/base/jquery-ui.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mb_mainmenu">
		<?php $this->widget('application.extensions.mbmenu.MbMenu',array(
			'items'=>include($_SERVER['DOCUMENT_ROOT']."/protected/config/menu.php"),
		)); ?>
	</div><!-- mb_mainmenu -->

	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->

	<div id="more_topic_info">
		<a id="more_topic_info_link"><span>More information about this topic</span></a>
	</div>

	<div id="top_right_box">
		<span>
			<?php echo CHtml::ajaxLink('Reset database', $this->createUrl('/site/resetDb'), array('beforeSend'=>'askDbResetConfirm', 'type'=>'POST')); ?>
		</span>
		&nbsp;|&nbsp;
		<div id="hide_source_toggle">
			<?php echo CHtml::ajaxLink('Hide source code', $this->createUrl('/site/toggleSource')); ?>
		</div>
	</div> <!-- hide_source_code, top_right_box -->

	<div id="content">
		<?php echo $content; ?>
		<?php if (isset(Yii::app()->sc)) { Yii::app()->sc->renderSourceBox(); } ?>
	</div><!-- content -->

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by the <a href="http://code.google.com/p/yiiplayground/">Yii Playground</a> team.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>