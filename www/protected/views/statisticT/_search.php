<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'user',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'dialed',array('class'=>'span5','maxlength'=>15)); ?>

	<?php echo $form->textFieldRow($model,'t_cels',array('class'=>'span5','maxlength'=>15)); ?>

	<?php echo $form->textFieldRow($model,'w_time',array('class'=>'span5','maxlength'=>15)); ?>

	<?php echo $form->textFieldRow($model,'ftd',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'date',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
