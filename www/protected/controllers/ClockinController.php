<?php

class ClockinController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        public $time_in;
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
             $User = new User();
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','edittime','Clockout','statistic','Clockin','test'),
					                'expression' => function () use ($User) {
            return User::model()->allowAdmin(array(1,2,3));
        },
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
					                'expression' => function () use ($User) {
            return User::model()->allowAdmin(array(1,2));
        },
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
					                'expression' => function () use ($User) {
            return User::model()->allowAdmin(array(1,2));
        },
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

        
        
        public function actionTest() {
      $naucc=new Fireberd_cc();
      $naucc->query="b.login='oper05'";
      $naucc->datein='2016-03-01 00:00';
      $naucc->dateto='2016-03-02 00:00';
      $naucc->query();
      print_r($naucc->data);
      date('Y-m-d H:i',1456436316);   
       echo  strtotime(date('Y-m-d H:i',1456436316));
       
        }
        
        
        
        public function actionEditTime(){
           
        if (!preg_match("/^(?:[01][0-9]|2[0-3]):[0-5][0-9]$/", $_POST['value'])) {
            throw new CHttpException(404,'Is not a valid format. (format HH:MM)');
            return;
        }
   
         
        $time=explode(':',$_POST['value']);
        
         $second=($time[0]*60)*60;
         $second=(($time[1]*60)+$second);
        
         echo $second;
         Clockin::model()->updateByPk($_POST['pk'], array( 'time' =>$second,));
        
          
            
   

        }
        
        
        
        public function ActionClockout($id, $action) {
      
           
            if ($action == 'admin') {
            $time = Clockin::model()->findByPk($id);
            $this->time_in = $time->tin ;
            
            if($time->time!=0){
              $clock_out = (time() - $time->tin)+$time->time;         
            }  else {
              $clock_out = (time() - $time->tin);   
            }
                        
            
            Clockin::model()->updateByPk($id, array('tout' => time(), 'checkOut' => '1', 'time' => $clock_out, 'date' => date('Y-m-d')));
            $this->newStatistic($time->user,$id);
            $this->redirect(array('admin'));
        }


        if ($action == 'user')
        $time= Clockin::model()->find("user=".$id." and checkOut = 0");
        $this->time_in = $time->tin ;
        
         if($time->time!=0){
              $clock_out = (time() - $time->tin)+$time->time;         
            }  else {
              $clock_out = (time() - $time->tin);   
            }
        
        Clockin::model()->updateByPk($time->id, array('tout' => time(), 'checkOut' => '1', 'time' => $clock_out, 'date' => date('Y-m-d')));
        $this->newStatistic($time->user,$time->id);
        
        $this->redirect(array('user/view', 'id' => $id));
    }

    
    
    
    public function newStatistic($id,$clock_id) {
    $sipInfo=$this->sipStatSinhro($id,$this->time_in);   
      if(!is_array ($sipInfo)){
      $sipInfo['CNT_OUT']=0;
      $sipInfo['CAST_02']=0;
   //   exit();
     }
   //  print_r($sipInfo);     exit();
       if(!Statistic::model()->exists("user=".$id." and date='".date('Y-m-d')."'")){
     $statistic_dey=new Statistic();   
       
		$statistic_dey->user =$id;
	        $statistic_dey->dialed = $sipInfo['CNT_OUT'];
		$statistic_dey->t_cels = $sipInfo['CAST_02'];
		$statistic_dey->w_time = $clock_id;
		$statistic_dey->ftd = 0;
		$statistic_dey->date= date('Y-m-d');
      $statistic_dey->save();  
   
       }  else {
     $time= Statistic::model()->find("user=".$id." and date='".date('Y-m-d')."'");    
     Statistic::model()->updateByPk($time->id, array('dialed' => $time->dialed+$sipInfo['CNT_OUT'], 't_cels' => $time->t_cels+$sipInfo['CAST_02'],  'date' => date('Y-m-d')));                
       }
      
       }

       
       
       public function sipStatSinhro($user_id,$time_in) {
           $model_user=User::model()->findByPk($user_id);
           $naucc=new Fireberd_cc();
           
      $naucc->query="b.login='".$model_user->naumen."'";
      $naucc->datein=date('Y-m-d H:i',$time_in);
      $naucc->dateto=date('Y-m-d H:i');
      $naucc->query();
      return($naucc->data);

     // print_r($naucc->data);
     //  echo date('Y-m-d H:i',1456436316);    
           
       }




    public function ActionClockin($id,$action) {
        if(!Clockin::model()->exists("user=".$id." and date='".date('Y-m-d')."'")){
                    
         $model=new Clockin;
         $model->tin=  time();
         $model->tout=0;
         $model->checkOut=0;
         $model->time=0;
         $model->user=$id;
         $model->date=0;
         $model->save();
         }  else {
            
             
       $user = Clockin::model()->find("user=".$id." and date='".date('Y-m-d')."'");
       Clockin::model()->updateByPk($user->id, array('tin'=>time(),'tout'=>0,'checkOut'=>0,));
             
         } 
         
         
         
         
        if($action=='user') $this->redirect(array('user/view','id'=>$id));    
        }
        
        
        
        
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
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
		$model=new Clockin;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Clockin']))
		{
			$model->attributes=$_POST['Clockin'];
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

		if(isset($_POST['Clockin']))
		{
			$model->attributes=$_POST['Clockin'];
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
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Clockin');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
        
        
        public function actionStatistic()
	{
            $model=new Clockin(''); 
            if(isset($_POST['Datein'])){
                if(isset($_POST['Dateout'])){
                    
                 $model->datein=$_POST['Datein'];   
                 $model->dateout=$_POST['Dateout']; 
                    
                }
            }else{
                $date=new DateTime(date('y-m-d',time()));
                $date->modify("-1 months");
               $model->datein=$date->format('Y-m-d');
                $model->dateout=date('Y-m-d',time()); 
            }
		    
		$this->render('main',array(
			'model'=>$model,
		));
	}
        
        
        
        
	public function actionAdmin()
	{
		$model=new Clockin('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Clockin']))
			$model->attributes=$_GET['Clockin'];
                        $model->checkOut=0;
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Clockin the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Clockin::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Clockin $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='clockin-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
