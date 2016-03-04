<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>20,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'naumen'); ?>
		<?php echo $form->textField($model,'naumen',array('size'=>20,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'naumen'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'desk'); ?>
		    <?php echo $form->dropDownList($model,'desk',User::model()->deskFilter()); ?>
		<?php echo $form->error($model,'desk'); ?>
	</div>

        
        <div class="row">
		<?php echo $form->labelEx($model,'groups'); ?>
		    <?php echo $form->dropDownList($model,'groups',User::model()->groupsFilter()); ?>
		<?php echo $form->error($model,'groups'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'placement'); ?>
		<?php echo $form->textField($model,'placement'); ?>
		<?php echo $form->error($model,'placement'); ?>
	</div>
        
       <div class="row">
		<?php echo $form->labelEx($model,'password'); ?>		
<?php echo $form->passwordField($model, 'password', array('class'=>'span3','maxlength'=>128,)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
        

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->