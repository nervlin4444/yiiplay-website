<?php $this->breadcrumbs =array('Phonebook'=>array('site/index'), 'Demo',); ?>
<h1>Phone Book Demo</h1>
<p>
This demo shows how to use Yii to implement a Web service used by an Adobe Flex 3.0 client.
</p>

<p>
In order to see this demo, the PHP SOAP extension must be enabled and your browser should have
installed Adobe Flash Player version 9 or above.
</p>

<div>
<?php echo CHtml::link('View WSDL for this Web service',array('phonebook')); ?>
</div>

<div>
<?php if(extension_loaded('soap')): ?>
<?php $this->widget('CFlexWidget',array(
	'baseUrl'=>Yii::app()->baseUrl.'/flex/bin',
	'name'=>'phonebook',
	'width'=>'800',
	'height'=>'300',
	'align'=>'left',
	'flashVars'=>array(
		'wsdl'=>$this->createUrl('phonebook'),
	))); ?>
<?php else: ?>
Sorry, the PHP SOAP extension is not enabled on your Web server.
<?php endif; ?>
</div>