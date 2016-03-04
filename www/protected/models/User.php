<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $name
 * @property string $naumen
 * @property integer $desk
 * @property integer $groups
 * @property integer $placement
 */
class User extends CActiveRecord
{
    
    public $user_id;
    public $statistic;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, naumen, desk, groups, placement', 'required'),
                        array('statistic,', 'length', 'max'=>50,'allowEmpty'=>true,),
			array('desk, groups', 'numerical', 'integerOnly'=>true),
			array('name, naumen ,groups, placement, password', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, naumen, desk, groups, placement, statistic', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'groupr'   => array(self::HAS_ONE, 'Groups', array('id'=>'groups')),
                    'deskr'   => array(self::HAS_ONE, 'Desk', array('id'=>'desk'),),

                    'statisticr'   => array(self::BELONGS_TO, 'Statistic', array('id'=>'user'),),
                 //   'statisticr'   => array(self::HAS_MANY, 'Statistic', array('user'=>'id'),),
              //      'clockr'   => array(self::HAS_ONE, 'Clockin', array('clockr.w_time'=>'id'),),
                    'clockr'=>array(self::HAS_ONE,'Clockin','w_time','through'=>'statisticr'),
          );      
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Nik Name',
			'naumen' => 'Operator',
			'desk' => 'Desk',
			'groups' => 'Group',
			'placement' => 'Location',
                        'password' => 'Password',
                        'statistic'=>'statistic',
                        'activity'=>'Activity',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('naumen',$this->naumen,true);
		$criteria->compare('desk',$this->desk);
		$criteria->compare('groups',$this->groups);
		$criteria->compare('placement',$this->placement);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));

     
    
        }
        
        
        
public function statsearch()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
              //  exit();
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('naumen',$this->naumen,true);
		$criteria->compare('placement',$this->placement);
                $criteria->compare('desk',$this->desk);
               // $criteria->with = 'statisticr';
             //   $criteria->compare('date',$this->statistic);
                
               
                
		return( new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		)));
               
        }
        public function groupsFilter() {
        $users = Groups::model()->findAll();
        foreach ($users as  $value) {
            $group[$value->permision] = $value->name;
        }
        return(array_reverse($group,true));
    }

    
    
            public function deskFilter() {
        $users = Desk::model()->findAll();
        foreach ($users as  $value) {
            $desk[$value->id] = $value->name;
        }

        return($desk);
    }
    
    
    /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
       
            //$this->password = md5($this->password);
		return parent::model($className);
	}

        
        public function  PassSave(){
           $this->password=  md5($this->password);
           return($this->save());
        }
       
        
        
        public function allowAdmin($rules) {

        foreach ($rules as $value) {

       if(!Yii::app()->user->id)
                      return FALSE; 
            
            if ($value ==  User::model()->find('name=:name', array(':name' => Yii::app()->user->id))->groups)
                 return(TRUE);
        }
    
        
 
        return(FALSE);
    }

}
