<?php
$this->breadcrumbs=array(
	'Comments',
);
?>
<?php $this->breadcrumbs =array('Blog'=>array('blog/comment/index'), 'Comments',); ?>

<h1>Comments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
