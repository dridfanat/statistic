<?php

/**
 * This is the model class for table "statistic".
 *
 * The followings are the available columns in table 'statistic':
 * @property integer $id
 * @property integer $user
 * @property string $dialed
 * @property string $t_cels
 * @property string $w_time
 * @property integer $ftd
 * @property string $date
 */
class Statistic extends CActiveRecord
{
    
    public $desk;
   // public $user;
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'statistic';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user, dialed, t_cels, w_time, ftd, date', 'required'),
			array('user, ftd ', 'numerical', 'integerOnly'=>true),
			array('dialed, t_cels', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user, dialed, t_cels,  ftd, date', 'safe', 'on'=>'search'),
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
                    
               'userr'   => array(self::BELONGS_TO, 'User', array('user'=>'id'),),     
               'clockr'   => array(self::HAS_ONE, 'Clockin', array('id'=>'w_time'),),
               'deskr'=>array(self::HAS_ONE,'Desk',array('desk'=>'id'),'through'=>'userr'),    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'dialed' => 'Dialed Count',
			't_cels' => 'Summ Cels Time',
			'w_time' => 'WTime',
			'ftd' => 'Ftd',
			'date' => 'Date',
                        'desk'=>'Desk',
                        'user'=>'User',
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
		//$criteria->compare('user',$this->user);
		$criteria->compare('dialed',$this->dialed,true);
		$criteria->compare('t_cels',$this->t_cels,true);
		$criteria->compare('w_time',$this->w_time,true);
		$criteria->compare('ftd',$this->ftd);
		$criteria->compare('date',$this->date,true);
                //$criteria->compare('deskr.desk',$this->desk,true);

                $criteria->with = 'userr';
                $criteria->compare('desk',$this->desk,true);
                $criteria->compare('name',$this->user,true);
                
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array('pageSize'  => '25',),
		));
	}

        	public function UserSearch()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

            
            
		$criteria=new CDbCriteria;

                
		$criteria->compare('id',$this->id);
		$criteria->compare('user',$this->user);
		$criteria->compare('dialed',$this->dialed,true);
		$criteria->compare('t_cels',$this->t_cels,true);
		$criteria->compare('w_time',$this->w_time,true);
		$criteria->compare('ftd',$this->ftd);
		$criteria->compare('date',$this->date,true);
                //$criteria->compare('deskr.desk',$this->desk,true);

//                $criteria->with = 'userr';
//                $criteria->compare('desk',$this->desk,true);
//                $criteria->compare('name',$this->user,true);
//                
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        public function sumary()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user',$this->user);
		$criteria->compare('dialed',$this->dialed,true);
		$criteria->compare('t_cels',$this->t_cels,true);
		$criteria->compare('w_time',$this->w_time,true);
		$criteria->compare('ftd',$this->ftd);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        
        
        
        public function efficiency() { 
            
           $time= explode(':', Utils::mkConvert($this->t_cels));  
           if ($this->t_cels==0&&$time[1]==0)    return 0;          
           $timew= explode(':', Utils::mkConvert($this->clockr->time));   
           if ($timew[0]==0&&$timew[1]==0)    return 0;
           return(substr(
            
                   ($time[0]*60+$time[1]+$this->dialed+45+($this->ftd*60))/($timew[0]*60+$timew[1]),0,4 ) );
        }
        
        
       

        



        /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Statistic the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
