<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        public $gropr;
	/**
	 * @return array action filters
	 */
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
            $Model=new User;
            
            return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                 'users' => array('*'),
                'actions' => array('index', 'admin', 'update','error','updateEditeble'),
                'expression' => function () use ($Model) {
            return User::model()->allowAdmin(array(1,2));
        },
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                 'users' => array('*'),
                'actions' => array('create', 'delete'),
                'expression' => function () use ($Model) {
            return User::model()->allowAdmin(array(1,2));
        },
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                 'users' => array('*'),
                'actions' => array('view','Test',),
                'expression' => function () use ($Model) {
            return User::model()->allowAdmin(array(3,1,2));
        },
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
        
        
        
        
        
        public function allowAdmin(){
       
     
           if(!isset(User::model()->find('name=:name', array(':name'=>Yii::app()->user->id))->groups))
           return(FALSE);
           
           elseif(User::model()->find('name=:name', array(':name'=>Yii::app()->user->id))->groups!=1)  
           return(FALSE);
       
             
           // return $example->uid === Yii::app()->user->id;
     return(true);   
    }
    
            public function allowSupervisor(){
       
     
           if(!isset(User::model()->find('name=:name', array(':name'=>Yii::app()->user->id))->groups))
           return(FALSE);
           
           elseif(User::model()->find('name=:name', array(':name'=>Yii::app()->user->id))->groups!=2)  
           return(FALSE);
       
             
           // return $example->uid === Yii::app()->user->id;
     return(true);   
    }
    
    

        
        
        
        public function actionTest()
	{
	$posts=  User::model()->with('clockr')->findAll();
        print_r($posts[4]);
	}
        
        public function actionUpdateEditeble(){
        if($_POST['name']=='naumen'){
            User::model()->updateByPk($_POST['pk'], array('naumen' => $_POST['value']));
            }
            
            }
        
        public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
        
        
        
	public function actionView($id)
	{
            
         //wiev table   
            $model=new Statistic('userSearch');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Statistic']))
			$model->attributes=$_GET['Statistic'];
                        $model->user=$_GET['id'];
	// grid table     
            
		$this->render('view',array(
			'model'=>$this->loadModel($_GET['id']),'test'=>$model
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->PassSave())
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

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->Save())
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
	public function actionIndex()
	{
	$this->redirect(array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
