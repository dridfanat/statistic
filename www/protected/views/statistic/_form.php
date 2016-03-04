<?php
/* @var $this StatisticController */
/* @var $model Statistic */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'statistic-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user'); ?>
		<?php echo $form->textField($model,'user'); ?>
		<?php echo $form->error($model,'user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dialed'); ?>
		<?php echo $form->textField($model,'dialed',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'dialed'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'t_cels'); ?>
		<?php echo $form->textField($model,'t_cels',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'t_cels'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'w_time'); ?>
		<?php echo $form->textField($model,'w_time',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'w_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ftd'); ?>
		<?php echo $form->textField($model,'ftd'); ?>
		<?php echo $form->error($model,'ftd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->