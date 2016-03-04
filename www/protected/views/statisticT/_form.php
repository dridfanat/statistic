<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'statistic-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

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
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
