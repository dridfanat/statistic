

<?php
/* @var $this StatisticController */
/* @var $model Statistic */





$this->menu=array(
	array('label'=>'Manage User', 'url'=>array('user/admin')),
        array('label'=>'Manege ClockTime', 'url'=>array('clockin/admin')),
        
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#statistic-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Statistics Report</h1>



<?php echo CHtml::link('  ','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">

</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'afterAjaxUpdate' => 'reinstallDatePicker',
       
	'columns'=>array(
		'userr.name'=>array('name'=>'user','value'=>'$data->userr->name',),
            
                 array(
            'name'=>'desk',                     
            'filter'=>User::model()->deskFilter(),           
            'value'=>'$data->deskr->name',),
            'dialed'=>array('header'=>'Count Calls','name'=>'dialed','value'=>'$data->dialed','filter'=>'',),
            't_cels'=>array('header'=>'Summ Calls Time','name'=>'t_cels','value'=>'Utils::mkConvert($data->t_cels)','filter'=>'',),
          
                       array( 
            'class' => 'editable.EditableColumn',
            'header'=>'Working Time',               
            'name' => 'clockr.time',
            'value'=>function ($data) { return Utils::mkConvert($data->clockr->time);},            
            'editable' => array(
                'type'      => 'time',
                'url'       => $this->createUrl('clockin/edittime'),
                'placement' => 'left',
              
            )
          ),
                       array( 
            'class' => 'editable.EditableColumn',
            'name' => 'ftd',
                           'filter'=>'',
            'editable' => array(
                'type'      => 'text',
                'url'       => $this->createUrl('statistic/updateFtd'),
                'placement' => 'left',
            )
          ),
            
            array(
            'header'=>'Activity',
            'filter'=>User::model()->deskFilter(),           
            'value'=>function ($data) 
                {
    $time= explode(':', Utils::mkConvert($data->t_cels)); 
    return($time[0]*60+$time[1]+$data->dialed+45);},),
            
            array(
            'header'=>'Efficiency',
            'filter'=>  User::model()->deskFilter(),           
            'value'=>function ($data) { return Utils::efficiencyUser($data);},),        
            
            'date'=>array('name'=>'date',
             'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(  
                                'model'=>$model,   
                                'attribute'=>'date',  
                                'language'=>'en',             
                                'htmlOptions' => array(
                    'id' => 'datepicker_for_due_date',
                    'size' => '5',
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
          
      
            
            
            
            
		/*
		'date',
		*/
		
	),


    ));

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
    $('#datepicker_for_due_date').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['en'],{'dateFormat':'yy-mm-dd'}));
}
");


?>
  
