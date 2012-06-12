<?php
return 
array(
array('label'=>'Home', 'url'=>array('/site/index'), 'items'=>array(
array('label'=>'Blog', 'url'=>array('/blog/post/index')),
array('label'=>'Hangman', 'url'=>array('/hangman/game/play')),
array('label'=>'Phonebook', 'url'=>array('/phonebook/site/index')),
)),
array('label'=>'Ajax / jQuery', 'items'=>array(
array('label'=>'Ajax request', 'url'=>array('/AjaxModule/ajax/ajaxRequest')),
)),
array('label'=>'Interface', 'items'=>array(
array('label'=>'Zii dialog', 'url'=>array('/UiModule/jui/ziiDialog')),
array('label'=>'Zii datePicker', 'url'=>array('/UiModule/jui/ziiDatePicker')),
array('label'=>'Zii autocomplete', 'url'=>array('/UiModule/jui/ziiAutocomplete')),
array('label'=>'Zii tabs', 'url'=>array('/UiModule/jui/ziiTab')),
array('label'=>'Tables and pagination', 'items'=>array(
array('label'=>'CGridView', 'url'=>array('/UiModule/dataview/gridView')),
)),
array('label'=>'Other', 'items'=>array(
array('label'=>'Breadcrumbs', 'url'=>array('/UiModule/ui_other/breadcrumbs')),
)),
)),
array('label'=>'i18n and l10n', 'items'=>array(
array('label'=>'Basic date and time', 'url'=>array('/InternationalizationModule/datetime/basic')),
array('label'=>'Advanced user input', 'url'=>array('/InternationalizationModule/datetime/userinput')),
)),
array('label'=>'RBAC', 'items'=>array(
array('label'=>'Contact Us', 'url'=>array('/site/contact')),
		
array('label'=>'Users', 'visible'=>!Yii::app()->user->isGuest, 'items'=>array(
array('label'=>'List Users', 'url'=>array('//rbac/user/auth/index')),
array('label'=>'Users Statistic', 'url'=>array('//rbac/user/statistic/index')),
array('label'=>'Manage Users', 'url'=>array('//rbac/user/user/admin')),
array('label'=>'Create User', 'url'=>array('//rbac/user/user/create')),
)),
array('label'=>'Roles / Access Control', 'visible'=>!Yii::app()->user->isGuest, 'items'=>array(
array('label'=>'Manage Roles', 'url'=>array('//rbac/role/role/admin')),
array('label'=>'Create Role', 'url'=>array('//rbac/role/role/create')),
array('label'=>'Manage Permissions', 'url'=>array('//rbac/role/permission/admin')),
array('label'=>'Grant Permissions', 'url'=>array('//rbac/role/permission/create')),
array('label'=>'Manage Actions', 'url'=>array('//rbac/role/action/admin')),
array('label'=>'Create Actions', 'url'=>array('//rbac/role/action/create')),
)),	
array('label'=>'Membership', 'visible'=>!Yii::app()->user->isGuest, 'items'=>array(
array('label'=>'Memberships', 'url'=>array('//rbac/membership/membership/admin')),
array('label'=>'Manage Payment Types', 'url'=>array('//rbac/membership/payment/admin')),
array('label'=>'Create New Payment Type', 'url'=>array('//rbac/membership/payment/create')),
)),	
array('label'=>'Profiles', 'visible'=>!Yii::app()->user->isGuest, 'items'=>array(
array('label'=>'Manage Users Profile', 'url'=>array('//rbac/profile/profile/admin')),
array('label'=>'Profile Visits', 'url'=>array('//rbac/profile/profile/visits')),
array('label'=>'Manage Profile Fields', 'url'=>array('//rbac/profile/fields/admin')),
array('label'=>'Create Profile Fields', 'url'=>array('//rbac/profile/fields/create')),
)),	
array('label'=>'Message', 'visible'=>!Yii::app()->user->isGuest, 'items'=>array(
array('label'=>'Admin Inbox', 'url'=>array('//rbac/message/message/index')),
array('label'=>'Sent Messages', 'url'=>array('//rbac/message/message/sent')),
array('label'=>'Write a message', 'url'=>array('//rbac/message/message/compose')),
)),
array('label'=>'Misc', 'visible'=>!Yii::app()->user->isGuest, 'items'=>array(
array('label'=>'Text Translations', 'url'=>array('//rbac/user/translation/admin')),
array('label'=>'Upload Avatar For Admin', 'url'=>array('//rbac/avatar/avatar/editAvatar')),
array('label'=>'Change Admin Password', 'url'=>array('//rbac/user/user/changePassword')),
)),
array('label'=>'Login', 'url'=>array('//rbac/user/user/login'), 'visible'=>Yii::app()->user->isGuest),
array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('//rbac/user/user/logout'), 'visible'=>!Yii::app()->user->isGuest),
)),
		
array('label'=>'Other', 'items'=>array(
//array('label'=>'Forcing file download', 'url'=>array('/site/page', 'view'=>'about')),
array('label'=>'About', 'url'=>array('/blog/site/page', 'view'=>'about')),
array('label'=>'Contact', 'url'=>array('/blog/site/contact')),
array('label'=>'Login', 'url'=>array('/blog/site/login'), 'visible'=>Yii::app()->user->isGuest),
array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/blog/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
)),
);