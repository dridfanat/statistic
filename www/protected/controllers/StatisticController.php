<?php

class StatisticController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	
        
        

function parentDesk() {
  
   // if(!Yii::app()->user->id)
           
            if('1'==User::model()->find('name=:name', array(':name' => Yii::app()->user->id))->groups) 
               return 'admin';
               
            return User::model()->find('name=:name', array(':name' => Yii::app()->user->id))->desk;
                
       
            
}
        
        
        
        
        
        public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
          $User = new User();
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','updateFtd','test'),
	                'expression' => function () use ($User) {
            return User::model()->allowAdmin(array(1,2));
        },
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
	                'expression' => function () use ($User) {
            return User::model()->allowAdmin(array(1,2));
        },
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('main','delete'),
	                'expression' => function () use ($User) {
            return User::model()->allowAdmin(array(1,2));
        },
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
        
        
        public function actionTest() {
  
        Game::blackrender('3');
        
        
            
        }
        
        
        
        public function actionUpdateftd() {
          if(isset($_POST['name'])&&$_POST['scenario'] == 'update') {
          Statistic::model()->updateByPk($_POST['pk'], array('ftd' => $_POST['value']));
          $this->redirect(array('statistic/index'));
          }
        }
        
        
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Statistic;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Statistic']))
		{
			$model->attributes=$_POST['Statistic'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Statistic']))
		{
			$model->attributes=$_POST['Statistic'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */


	/**
	 * Manages all models.
	 */
	public function actionIndex(){
            
           
            
            
                $model=new Statistic('search');       
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Statistic'])){
                    
                $model->attributes=$_GET['Statistic'];
                $model->desk=$_GET['Statistic']['desk'];
                
                }
                else $model->date=date("Y-m-d");  
   
               if ($this->parentDesk()!='admin'){
                 $model->desk=$this->parentDesk();   
                } 
                
                
                
                
		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Statistic the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Statistic::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Statistic $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='statistic-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
