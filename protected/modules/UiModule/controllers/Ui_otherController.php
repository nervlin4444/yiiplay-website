<?php

class Ui_otherController extends Controller
{

	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
	}


	public function actionIndex() {		
		$this->render('index');
	}
	
	public function actionBreadcrumbs() {
		$this->render('breadcrumbs');
	}
	

}