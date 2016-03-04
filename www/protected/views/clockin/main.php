

<?php

$this->breadcrumbs=array(
	'Manage'=>array('clockin/admin'),
	'Time',
);

$this->menu=array(
         array('label'=>'Manage ClockTime', 'url'=>array('clockin/admin')),

);

echo CHtml::beginForm('');
?>
<div class="row">
<?php echo CHtml::activeLabel($model,'Date In'); ?>    
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    
    'name'=>'Datein',
    'value' =>$model->datein,
    // additional javascript options for the date picker plugin
   'options'=>array(  
                                        'showAnim'=>'fold',  
                                        'dateFormat'=>'yy-mm-dd',  
                                        'changeMonth' => 'true',  
                                        'changeYear'=>'true', 
    ),
     
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
));
?>
</div>

<div class="row">
    <?php echo CHtml::activeLabel($model,'Date Out'); ?>   
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'Dateout',
    'value' =>$model->dateout,
    // additional javascript options for the date picker plugin
    'options'=>array(  
                                        'showAnim'=>'fold',  
                                        'dateFormat'=>'yy-mm-dd',  
                                        'changeMonth' => 'true',  
                                        'changeYear'=>'true', 
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
));

?>
</div>

<div class="row submit">
<?php echo CHtml::submitButton('SELECT'); ?>
</div>


<?php echo CHtml::endForm(); ?>






<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'clockin-grid',
	'dataProvider'=>$model->test(),
	//'filter'=>$model,
	'columns'=>array(
                'name',
                'timer'=>array(
                'header'=>'Total Time',    
                'value'=>function($data){
                     
                     
            
            $duration = $data['timer'];
            $hours = (int) ($duration / 60 / 60);
            $minutes = (int) ($duration / 60) - $hours * 60;
            $seconds = (int) $duration - $hours * 60 * 60 - $minutes * 60;
            if (1==mb_strlen($hours)) $hours='0'.$hours ; 
            if (1==mb_strlen($minutes)) $minutes='0'.$minutes ;
            if (1==mb_strlen($seconds)) $seconds='0'.$seconds ;

                         
            
            return ($hours.":".$minutes.":".$seconds);     
                     
                     
                     
                 },   
                ),
                'desk'
                ),
    ));
                    
	

        
            ?>
