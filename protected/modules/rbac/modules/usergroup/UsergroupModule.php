<?php
Yii::setPathOfAlias('UsergroupModule' , dirname(__FILE__));

class UsergroupModule extends CWebModule {
	public $controllerMap=array(
			'groups'=>array(
				'class'=>'UsergroupModule.controllers.YumUsergroupController'),
			);

	public function init() {
		$this->setImport(array(
					'rbac.modules.user.controllers.*',
					'rbac.modules.user.models.*',
					'rbac.modules.usergroup.controllers.*',
					'rbac.modules.usergroup.models.*',
					));
	}


}
