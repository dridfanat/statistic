<?php
/* @var $this StatisticController */
/* @var $model Statistic */

$this->breadcrumbs=array(
	'Statistics'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Statistic', 'url'=>array('index')),
	array('label'=>'Create Statistic', 'url'=>array('create')),
	array('label'=>'View Statistic', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Statistic', 'url'=>array('admin')),
);
?>

<h1>Update Statistic <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>