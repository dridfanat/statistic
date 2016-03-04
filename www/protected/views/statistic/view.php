<?php
/* @var $this StatisticController */
/* @var $model Statistic */

$this->breadcrumbs=array(
	'Statistics'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Statistic', 'url'=>array('index')),
	array('label'=>'Create Statistic', 'url'=>array('create')),
	array('label'=>'Update Statistic', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Statistic', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Statistic', 'url'=>array('admin')),
);
?>

<h1>View Statistic #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user',
		'dialed',
		't_cels',
		'w_time',
		'ftd',
		'date',
	),
)); ?>
