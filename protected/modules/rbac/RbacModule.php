<?php

class RbacModule extends CWebModule {

	public function init() {
		$this->setImport(array(
		'rbac.modules.user.models.*',
		'rbac.modules.user.components.*',
		));
		Yii::app()->setModules($this->modules);
	}
}
