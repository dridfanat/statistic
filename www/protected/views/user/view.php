<?php
/* @var $this UserController */
/* @var $model User */
Yii::app()->clientScript->registerCssFile( Yii::app()->request->baseUrl . '/css/style1.css');
Yii::app()->clientScript->registerCssFile( Yii::app()->request->baseUrl . '/css/timer.css');



//info styel
Yii::app()->clientScript->registerCss('cs1','#detal
{
    width: 70%;
    min-height: 150px;
   
    float: left;
    padding: 10px 0px 0px 0px;
}');

//map styel
Yii::app()->clientScript->registerCss('cs2','#location
{
    width: 30%;
    min-height: 150px;

    margin-left: 70%;
    
    padding: 5px 10px 15px 20px;
    
    
}');


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('statistic-grid', {
		data: $(this).serialize()
	});
	return false;
});
");


//Yii::app()->clientScript->registerScript('text',
//        'var theElement = document.getElementById("text_svg");
//	theElement.innerHTML = "<text x=\'0\' y=\'15\'>This is Scalable Vector Graphic (SVG) Text</text>" ;'
//        );








if(isset($model->placement)) $CssLocation=$model->placement; else $CssLocation=FALSE;

Yii::app()->clientScript->registerCss('test1','#svg_'.$CssLocation.'
{
 -webkit-animation: svg_'.$CssLocation.' 2s linear infinite; animation: svg_'.$CssLocation.' 2s linear infinite;   
}');

Yii::app()->clientScript->registerCss('test2','@-webkit-keyframes svg_'.$CssLocation.'
{
 0% { fill: rgb(128, 0, 0); } 
 50% { fill: rgb(183, 65, 14); } 
 100% { fill: rgb(128, 0, 0); }
       
}');

Yii::app()->clientScript->registerCss('test3','@keyframes svg_'.$CssLocation.'
{
 0% { fill: rgb(128, 0, 0); } 
 50% { fill: rgb(183, 65, 14); } 
 100% { fill: rgb(128, 0, 0); } 
}');

?>

<?php
Yii::app()->clientScript->registerCss('title','#title
{
    width: 40%;
    min-height: 150px;
   
    float: left;
    padding: 10px 0px 0px 0px;
}');


Yii::app()->clientScript->registerCss('button-clock','#button-clock
{
    width:50px; 
   

    margin-left: 40%;
    
    padding: 5px 10px 15px 20px;
    
    
}');
?>




<!-- TIMER -->









<?php
if(Clockin::model()->exists("user=".$model->id." and checkOut='0'")){
$clock=Clockin::model()->find("user=".$model->id." and checkOut='0'");
  $clockin=true;
$duration = time()-$clock->tin;
$hours = (int)($duration/60/60);
$minutes = (int)($duration/60)-$hours*60;
$seconds = (int)$duration-$hours*60*60-$minutes*60;
  }
  else $clockin=false;
?>







<div id="title"><h1>User Page <?php echo $model->name; ?> </h1>
  <?php
if($clockin==TRUE)
echo '<div class="test" id="seconds">0</div>
<script Language="JavaScript">
var hours = '.$hours.';
var min = '.$minutes.';
var sec = '.$seconds.';
function display() {
sec+=1;
if (sec>=60)
{
min+=1;
sec=0;
}
if (min>=60)
{
hours+=1;
min=0;
}
if (hours>=24)
hours=0;


if (sec<10)
sec2display = "0"+sec;
else
sec2display = sec;


if (min<10)
min2display = "0"+min;
else
min2display = min;

if (hours<10)
hour2display = "0"+hours;
else
hour2display = hours;

document.getElementById("seconds").innerHTML = hour2display+":"+min2display+":"+sec2display;
setTimeout("display();", 1000);
}

display();
</script>
' ?>   
</div>
<br>
    <?php
if($clockin==true)
echo CHtml::link('<img src="images/clouckuout2.gif" alt="" />', array('clockin/clockout', 'id'=>$model->id ,'action'=>'user'));    
    else 
  echo CHtml::link('<img src="images/clouckin.gif" alt="" />', array('clockin/clockin', 'id'=>$model->id ,'action'=>'user'));  
?> 
<br>
 <br>
  




   <br>
      <br>
      
      <div id='detal'>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
            'type' => array('condensed', 'striped', 'bordered'),
    'htmlOptions' => array('style'=>'text-align: left'),
	'attributes'=>array(
		'name',
		'naumen',
                array('name'=>'desk',
                    'value'=>$model->deskr->name,   
                    ),
                   
		'placement'=>array(
                 'name'=>'placement',
                 'value'=>$model->placement,   
                ),
            
                 'game ftd'=>array(
                 'name'=>'Ftd rank',
                 'type'=>'raw',    
                 'value'=>Game::ftdrender($model->id),   
                ),
            
                 'Game'=>array(
                 'name'=>'Game',
                 'type'=>'raw',    
                 'value'=>Game::blackrender($model->id),   
                ),
            
	),
)); ?>
 </div>        
                  
      <div id='location'>  
             
   <?php $this->renderPartial('_deskmap', array('model'=>$model)); ?>               
    </div>               
            

      
      <div class="search-form" style="display:none">
      <?php $this->renderPartial('_deskmap', array('model'=>$model)); ?>
      </div>

      
       
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$test->UserSearch(),
	'filter'=>$test,
        'afterAjaxUpdate' => 'reinstallDatePicker',
       
	'columns'=>array(
		
        'dialed'=>array('name'=>'dialed','value'=>'$data->dialed','htmlOptions'=>array('width'=>'40px'),), 
        't_cels'=>array('name'=>'t_cels','value'=>'Utils::mkConvert($data->t_cels)','htmlOptions'=>array('width'=>'40px'),),
        'w_time'=>array('name'=>'w_time','value'=>'Utils::mkConvert($data->clockr->time)','htmlOptions'=>array('width'=>'40px'),),
        'ftd'=>array('name'=>'ftd','value'=>'$data->ftd','htmlOptions'=>array('width'=>'40px'),),   
            array(
            'header'=>'Activity',
            'filter'=>User::model()->deskFilter(),           
            'value'=>function ($data) {$time= explode(':', Utils::mkConvert($data->t_cels));   return(($time[0]*60+$time[1]+$data->dialed+45));},
                    'htmlOptions'=>array('width'=>'40px'),),
            
            array(
            'header'=>'Efficiency',
            'filter'=>User::model()->deskFilter(),           
            'value'=>function ($data) {
                                return Utils::efficiencyUser($data);},
            'htmlOptions'=>array('width'=>'40px'),),        
               
               
           
            'date'=>array('name'=>'date',
             'htmlOptions'=>array('width'=>'50px'),
             'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(  
                                'model'=>$test,   
                                'attribute'=>'date',  
                                'language'=>'en',             
                                'htmlOptions' => array(
                    'id' => 'datepicker_for_due_date',
         
                ),
                                'options'=>array(  
                                        'showAnim'=>'fold',  
                                        'dateFormat'=>'yy-mm-dd',  
                                        'changeMonth' => 'true',  
                                        'changeYear'=>'true',  
                                          
                                ),  
            ),true),
                )
            ,
	),


    ));
        
Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
    $('#datepicker_for_due_date').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['en'],{'dateFormat':'yy-mm-dd'},{'size':'5'}));
}
");
?>
 
      

<div id='stable'>  
                  <?php  echo CHtml::image(Yii::app()->request->baseUrl.'/images/game1.png','', array('align'=>'texttop'));
                  ?> 
  
                 </div>



  <div id='rules' >
                  <?php  echo CHtml::image(Yii::app()->request->baseUrl.'/images/game2.png','', array('align'=>'texttop'));
                  ?> 
  
  </div>      
      
      
   


      
      
      <?php
      //stat table
Yii::app()->clientScript->registerCss('cs3','#stable
{
    width: 70%;
    min-height: 150px;
    float: left;
    padding: 12px 0px 0px 0px;
}');

//rules
Yii::app()->clientScript->registerCss('cs4','#rules
{
    width: 30%;
    min-height: 150px;
    margin-left: 70%;
    padding: 0px 0px 0px 0px;
    
    
}'); ?>
