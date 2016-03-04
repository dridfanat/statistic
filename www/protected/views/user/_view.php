<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('naumen')); ?>:</b>
	<?php echo CHtml::encode($data->naumen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desk')); ?>:</b>
	<?php echo CHtml::encode($data->desk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('groups')); ?>:</b>
	<?php echo CHtml::encode($data->groups); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('placement')); ?>:</b>
	<?php echo CHtml::encode($data->placement); ?>
	<br />


</div>