<?php
$this->breadcrumbs=array(
	'Comments'=>array('index'),
	'Update Comment #'.$model->id,
);
?>
<?php $this->breadcrumbs =array('Blog'=>array('blog/comment/index'), 'Update Comment #'.$model->id,); ?>

<h1>Update Comment #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>