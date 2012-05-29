<ul>
	<li><?php echo CHtml::link('Create New Post',array('blog/post/create')); ?></li>
	<li><?php echo CHtml::link('Manage Posts',array('blog/post/admin')); ?></li>
	<li><?php echo CHtml::link('Approve Comments',array('blog/comment/index')) . ' (' . Comment::model()->pendingCommentCount . ')'; ?></li>
	<li><?php echo CHtml::link('Logout',array('site/logout')); ?></li>
</ul>