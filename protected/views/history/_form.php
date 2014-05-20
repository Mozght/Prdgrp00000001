<?php
/* @var $this HistoryController */
/* @var $model History */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'history-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->hiddenField($model,'order_id',array('value'=>$id)); ?>
		<?php echo $form->error($model,'order_id'); ?>
	</div>
        
        <div class="row">
            <?php echo $form->labelEx($orders, 'device_status_id'); ?>
            <?php echo $form->dropDownList($orders,'device_status_id', DeviceStatus::all()); ?> 
            <?php echo $form->error($orders, 'device_status_id'); ?>
        </div>

	<div class="row">
		<?php echo $form->labelEx($model,'to_user_id'); ?>
		<?php echo $form->dropDownList($model,'to_user_id', Users::all()); ?>
		<?php echo $form->error($model,'to_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->