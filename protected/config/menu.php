<?php
return 
array(
array('label'=>'Home', 'url'=>array('/site/index'),
					'items'=>array(
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
array('label'=>'Authorization and authentication', 'items'=>array(
array('label'=>'Yii\'s RBAC', 'url'=>array('/site/page', 'view'=>'about')),
array('label'=>'SRBAC extension', 'url'=>array('/site/page', 'view'=>'about')),
array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
)),
array('label'=>'Rbac', 'items'=>array(
array('label'=>'Auth', 'url'=>array('//rbac/user/auth')),
array('label'=>'CSV', 'url'=>array('//rbac/user/csv')),
array('label'=>'Intall', 'url'=>array('//rbac/user/install')),
array('label'=>'Rest', 'url'=>array('//rbac/user/rest')),
array('label'=>'Statistic', 'url'=>array('//rbac/user/statistic')),
array('label'=>'Text', 'url'=>array('//rbac/user/text')),
array('label'=>'Translate', 'url'=>array('//rbac/user/translate')),
array('label'=>'User', 'url'=>array('//rbac/user/user')),
		
)),
array('label'=>'Other', 'items'=>array(
//array('label'=>'Forcing file download', 'url'=>array('/site/page', 'view'=>'about')),
array('label'=>'About', 'url'=>array('/blog/site/page', 'view'=>'about')),
array('label'=>'Contact', 'url'=>array('/blog/site/contact')),
array('label'=>'Login', 'url'=>array('/blog/site/login'), 'visible'=>Yii::app()->user->isGuest),
array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/blog/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
)),
);