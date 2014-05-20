<?php
/* @var $this OrdersController */
/* @var $model Orders */
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
		<?php echo $form->label($model,'device_id'); ?>
		<?php echo $form->textField($model,'device_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'imei'); ?>
		<?php echo $form->textField($model,'imei'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_sale'); ?>
		<?php echo $form->textField($model,'date_sale'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_reciept'); ?>
		<?php echo $form->textField($model,'date_reciept'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'seller_id'); ?>
		<?php echo $form->textField($model,'seller_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'device_state_id'); ?>
		<?php echo $form->textField($model,'device_state_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'device_status_id'); ?>
		<?php echo $form->textField($model,'device_status_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_service'); ?>
		<?php echo $form->textField($model,'is_service',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_paid_repair'); ?>
		<?php echo $form->textField($model,'is_paid_repair',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_garanty_paid_repair'); ?>
		<?php echo $form->textField($model,'is_garanty_paid_repair',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_repeated_repair'); ?>
		<?php echo $form->textField($model,'is_repeated_repair',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_no_garanty'); ?>
		<?php echo $form->textField($model,'is_no_garanty',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'customer_id'); ?>
		<?php echo $form->textField($model,'customer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'claims'); ?>
		<?php echo $form->textArea($model,'claims',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'appearance'); ?>
		<?php echo $form->textArea($model,'appearance',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cost'); ?>
		<?php echo $form->textField($model,'cost'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->