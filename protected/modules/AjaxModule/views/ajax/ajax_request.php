<?php $this->breadcrumbs =array('XMLHttpRequest'=>array('ajax/index'), 'Ajax request'=>'http://www.yiiframework.com/doc/api/CHtml#ajax-detail',); ?>


<a name="ajaxLink"></a>
<div class="example_title">Ajax request using ajaxLink</div>

<div class="demo_box">
<?php
Yii::app()->sc->setStart(__LINE__);

echo CHtml::ajaxLink(
	'Test request',          // the link body (it will NOT be HTML-encoded.)
	array('ajax/reqTest01'), // the URL for the AJAX request. If empty, it is assumed to be the current URL.
	array(
		'update'=>'#req_res'
	)
);
?>

<div id="req_res">...</div>

<?php
Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
Yii::app()->sc->collect('php', Yii::app()->sc->getFunctionFromFile(
		'public function actionReqTest01',
		'protected/modules/AjaxModule/controllers/AjaxController.php'
	), false, true);
?>
</div><!-- demo box -->
<?php Yii::app()->sc->renderSourceBox(); ?>


<a name="ajaxButton"></a>
<div class="example_title">Ajax request using ajaxButton</div>

<div class="demo_box">
<?php Yii::app()->sc->setStart(__LINE__); ?>

<div class="form">
<?php echo CHtml::beginForm(); ?>

<div class="row">
<?php echo CHtml::label('Some text', 'some_text'); ?>
<?php echo CHtml::textField('some_text', date('H:i:s')); ?>
</div>

<?php
echo CHtml::ajaxSubmitButton(
	'Submit request',
	array('ajax/reqTest03'),
	array(
		'update'=>'#req_res02',
	),
	array(
		'type'=>'submit',
	)
);
?>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->

<div id="req_res02">...</div>

<?php
Yii::app()->sc->collect('php', Yii::app()->sc->getSourceToLine(__LINE__, __FILE__));
Yii::app()->sc->collect('php', Yii::app()->sc->getFunctionFromFile(
		'public function actionReqTest03',
		'protected/modules/AjaxModule/controllers/AjaxController.php'
	), false, true);
?>
</div><!-- demo box -->


<?php $this->widget('RightMenu', array('items'=>$this->getExampleSubMenu('ajax_request'))); ?>

<?php $this->widget('MoreInfoBox', array(
	'references'=>array(
		'http://www.yiiframework.com/doc/api/CHtml#ajax-detail'=>'CHtml: ajax',
		'http://www.yiiframework.com/doc/api/CHtml#ajaxLink-detail'=>'ajaxLink',
		'http://www.yiiframework.com/doc/api/CHtml#ajaxButton-detail'=>'ajaxButton',
		'http://www.yiiframework.com/doc/api/CHtml#ajaxSubmitButton-detail'=>'ajaxSubmitButton',
	),
	'see_also'=>array($this->createUrl('/UiModule/jui/ziiAutocomplete')=>'Autocomplete with Ajax example'),
	//'external_links'=>array(),
)); ?>