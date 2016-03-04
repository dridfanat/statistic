<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	
	'Manage',
);

$this->menu=array(
	array('label'=>'Create User', 'url'=>array('create')),
        array('label'=>'Manage ClockTime', 'url'=>array('clockin/admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");




?>

<h1>Manage Users</h1>





<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
                array( 
            'class' => 'editable.EditableColumn',
            'name' => 'naumen',
            'editable' => array(
                'type'      => 'text',
                'url'       => $this->createUrl('user/updateEditeble'),
                'placement' => 'left',
            )
          ),
             array(
            'name'=>'desk',
            'filter'=>User::model()->deskFilter(),           
            'value'=>'$data->deskr->name',
            //'value'=>  'Desk::model()->findByPk($this->id)',     
                 ),
            
            array(
            'name'=>'groups',
            'filter'=>User::model()->groupsFilter(),
            'value'=>'$data->groupr->name',    
                ),
	    
            'placement',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
