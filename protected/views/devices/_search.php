<?php
/* @var $this DevicesController */
/* @var $model Devices */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pa'); ?>
		<?php echo $form->textField($model,'pa'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'devices_type_id'); ?>
		<?php echo $form->textField($model,'devices_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'devices_brand_id'); ?>
		<?php echo $form->textField($model,'devices_brand_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->