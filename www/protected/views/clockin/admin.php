<?php
/* @var $this ClockinController */
/* @var $model Clockin */

$this->breadcrumbs=array(
	
	'Manage',
);

$this->menu=array(
	 array('label'=>'Time Report', 'url'=>array('clockin/statistic')),
         array('label'=>'Manage User', 'url'=>array('user/admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#clockin-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage ClockTime</h1>

<p>

</p>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'clockin-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,      
	'columns'=>array(
		'clockin'=>array(
                'header'=>'Clock In',
                'value' =>'$data->userr->name', 
                ),	
                'tin'=>array(
                 'header'=>'Time in',   
                 'value'=>function ($data){
                 return(date('d   H:i:s',$data->tin));},),
                 'time'=>array(
                     'header'=>'ONLINE',
                 'value'=>function($data){ 
                     
                     
            
            $duration = time() - $data->tin;
            $hours = (int) ($duration / 60 / 60);
            $minutes = (int) ($duration / 60) - $hours * 60;
            $seconds = (int) $duration - $hours * 60 * 60 - $minutes * 60;
        
                         
            
            return ($hours.":".$minutes.":".$seconds);     
                     
                     
                     
                 },
                         ),

		array(
			'class'=>'CButtonColumn',
                     'template'=>'{out}',
                    'htmlOptions' => array('style'=>'width:100px;','align'=>'center'),
                  'buttons'=>array(  
                    'out' => array(     
            'label'=>'Clock Out', // text label of the button
            'url'=>"Yii::app()->createUrl('clockin/clockout',array('id'=>\$data->id,'action'=>'admin'))",
            'imageUrl'=>'/images/clouckuout1.gif',  // image URL of the button. If not set or false, a text link is used         
            'options' => array('class'=>'copy'), // HTML options for the button
        ),
                      ),
                     
		),
	),
));                                               
 ?>
