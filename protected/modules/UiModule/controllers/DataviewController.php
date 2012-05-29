<?php

/**
 * DataViewController: used for GridView and pagination examples
 */

class DataviewController extends Controller
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
	
	public function actionGridView() {
		$model =new User('search');
		if(isset($_GET['User']))
			$model->attributes =$_GET['User'];

		$params =array(
			'model'=>$model,
		);

		
		if(!isset($_GET['ajax'])) $this->render('grid_view', $params);
		else  $this->renderPartial('grid_view', $params);
	}

}