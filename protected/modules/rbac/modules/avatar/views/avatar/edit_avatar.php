<div class="form">
<?php
$this->title = Yum::t('Upload avatar');

$this->breadcrumbs = array(
		Yum::t('Profile') => array('//rbac/profile/profile/view'),
		Yum::t('Upload avatar'));

if($model->avatar) {
	echo '<h2>';
	echo Yum::t('Your Avatar image');
	echo '</h2>';
	echo $model->getAvatar();
}
else
	echo Yum::t('You do not have set an avatar image yet');

	echo '<br />';

if(Yum::module('avatar')->avatarMaxWidth != 0)
	echo '<p>' . Yum::t('The image should have at least 50px and a maximum of 200px in width and height. Supported filetypes are .jpg, .gif and .png') . '</p>';

	echo CHtml::errorSummary($model);
	echo CHtml::beginForm(array(
				'//rbac/avatar/avatar/editAvatar'), 'POST', array(
	'enctype' => 'multipart/form-data'));
	echo '<div class="row">';
	echo CHtml::activeLabelEx($model, 'avatar');
	echo CHtml::activeFileField($model, 'avatar');
	echo CHtml::error($model, 'avatar');
	echo '</div>';
	if(Yum::module('avatar')->enableGravatar) 
	echo CHtml::Button(Yum::t('Use my Gravatar'), array(
				'submit' => array(
					'//rbac/avatar/avatar/enableGravatar')));

	echo CHtml::Button(Yum::t('Remove Avatar'), array(
				'submit' => array(
					'//rbac/avatar/avatar/removeAvatar')));
	echo CHtml::submitButton(Yum::t('Upload Avatar'));
	echo CHtml::endForm();

?>
</div>
