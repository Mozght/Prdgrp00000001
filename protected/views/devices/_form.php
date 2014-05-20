<?php
/* @var $this DevicesController */
/* @var $model Devices */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'devices-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


        
        <div class="row">
		<?php echo $form->labelEx($model,'devices_type_id'); ?>
		<?php echo $form->dropDownList($model,'devices_type_id', DevicesType::all()); ?>
		<?php echo $form->error($model,'devices_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'devices_brand_id'); ?>
		<?php echo $form->dropDownList($model,'devices_brand_id', DevicesBrand::all()); ?>
		<?php echo $form->error($model,'devices_brand_id'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'pa'); ?>
		<?php echo $form->dropDownList($model,'pa',array(1=>'Виден',0=>"Скрыт")); ?>
		<?php echo $form->error($model,'pa'); ?>
	</div>
        
        

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->