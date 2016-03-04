<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user')); ?>:</b>
	<?php echo CHtml::encode($data->user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dialed')); ?>:</b>
	<?php echo CHtml::encode($data->dialed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('t_cels')); ?>:</b>
	<?php echo CHtml::encode($data->t_cels); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('w_time')); ?>:</b>
	<?php echo CHtml::encode($data->w_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ftd')); ?>:</b>
	<?php echo CHtml::encode($data->ftd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />


</div>