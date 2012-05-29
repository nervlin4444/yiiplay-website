<?php
Yii::setPathOfAlias('RegistrationModule' , dirname(__FILE__));

class RegistrationModule extends CWebModule {
	// why enableRegistration ? - in case you only want a recovery ! 
	public $layout = 'rbac.modules.user.views.layouts.yum';
	public $enableRegistration = true;
	public $enableRecovery = true;

	public $registrationUrl = array('//rbac/registration/registration/registration');
	public $activationUrl = array('//rbac/registration/registration/activation');
	public $recoveryUrl = array('//rbac/registration/registration/recovery');

	public $activationSuccessView = '/registration/activation_success';
	public $activationFailureView = '/registration/activation_failure';

	// Whether to confirm the activation of an user by email
	public $enableActivationConfirmation = true; 

	public $registrationEmail='register@website.com';
	public $recoveryEmail='restore@website.com';

	public $registrationView = '/registration/registration';
	public $changePasswordView = 
		'rbac.modules.user.views.user.changepassword';
	public $recoverPasswordView = 
		'rbac.modules.registration.views.registration.recovery';

	/**
	 * Whether to use captcha in registration process
	 * @var boolean
	 */
	public $enableCaptcha = true;

	public $loginAfterSuccessfulActivation = false;

	public $controllerMap=array(
			'registration'=>array(
				'class'=>'RegistrationModule.controllers.YumRegistrationController'),
			);

}
