<?php

Yii::import('zii.widgets.CPortlet');

class YumAdminMenu extends CPortlet {
	public function init() {
		$this->title = sprintf('%s <br /> %s: %s',
				Yum::t('Usermenu'),
				Yum::t('Logged in as'),
				Yii::app()->user->data()->username);
		$this->contentCssClass = 'menucontent';
		return parent::init();
	}

	public function run() {
		$this->widget('YumMenu', array(
					'items' => $this->getMenuItems()
					));

		parent::run();
	}

	public function getMenuItems() {
		return array(
				array('label'=>'Users', 'items' => array(
						array('label'=> 'Statistics', 'url'=>array('//rbac/user/statistics/index')),
						array('label' => 'Administration', 'url' => array('//rbac/user/user/admin')),
						array('label' => 'Create new user', 'url' => array('//rbac/user/user/create')),
						array('label' => 'Generate Demo Data', 'url' => array('//rbac/user/user/generateData'), 'visible' => Yum::module()->debug),
						)
					),
				array('label'=>'Roles / Access control', 'active' => Yii::app()->controller->id == 'role' || Yii::app()->controller->id == 'permission' || Yii::app()->controller->id == 'action', 'visible' => Yum::hasModule('role'), 'items' => array(
						array('label' => 'Roles', 'url' => array('//rbac/role/role/admin')),
						array('label' => 'Create new role', 'url' => array('//rbac/role/role/create')),
						array('label' => 'Permissions', 'url' => array('//rbac/role/permission/admin')),
						array('label' => 'Grant permission', 'url' => array('//rbac/role/permission/create')),
						array('label' => 'Actions', 'url' => array('//rbac/role/action/admin')),
						array('label' => 'Create new action', 'url' => array('//rbac/role/action/create')),
						)
					),
				array('label'=>'Membership', 'visible' => Yum::hasModule('membership'), 'items' => array(
						array('label' => 'Ordered memberships', 'url' => array('//rbac/membership/membership/admin')),
						array('label' => 'Payment types', 'url' => array('//rbac/membership/payment/admin')),
						array('label' => 'Create new payment type', 'url' => array('//rbac/membership/payment/create')),
						)
					),
				array('label'=>'Profiles',
						'visible' => Yum::hasModule('profile'),
						'items' => array(
							array('label' => 'Manage profiles', 'url' => array('//rbac/profile/profile/admin')),
							array('label' => 'Show profile visits', 'url' => array('//rbac/profile/profile/visits')),
							array('label' => 'Manage profile fields', 'url' => array('//rbac/profile/fields/admin')),
							array('label' => 'Create profile field', 'url' => array('//rbac/profile/fields/create')),
							)
						),
				array('label' => 'Messages',
						'visible' => Yum::hasModule('message'),
						'items' => array (
							array('label' => 'Admin inbox', 'url' => array('//rbac/message/message/index')),
							array('label' => 'Sent messages', 'url' => array('//rbac/message/message/sent')),
							array('label' => 'Write a message', 'url' => array('//rbac/message/message/compose')),
							),
						),
				array('label' => 'Text translations', 'url' => array('//rbac/user/translation/admin')),
				array('label' => 'Misc', 'items' => array(
							array('label' => 'Upload avatar for admin', 'url' => array('//rbac/avatar/avatar/editAvatar'),
								'visible' => Yum::hasModule('avatar')),
							array('label' => 'Change admin Password', 'url' => array('//rbac/user/user/changePassword')),
							array('label' => 'Logout', 'url' => array('//rbac/user/user/logout')),
							)
						),
				);

	}
}
?>






