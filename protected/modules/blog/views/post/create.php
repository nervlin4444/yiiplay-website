<?php
$this->breadcrumbs=array(
	'Create Post',
);
?>
<?php $this->breadcrumbs =array('Blog'=>array('blog/post/index'), 'Create Post',); ?>

<h1>Create Post</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>