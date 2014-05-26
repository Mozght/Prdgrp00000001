<?php
/* @var $this OrdersController */
/* @var $data Orders */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('device_id')); ?>:</b>
	<?php echo CHtml::encode($data->device_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('imei')); ?>:</b>
	<?php echo CHtml::encode($data->imei); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_sale')); ?>:</b>
	<?php echo CHtml::encode($data->date_sale); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_reciept')); ?>:</b>
	<?php echo CHtml::encode($data->date_reciept); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('date_modify')); ?>:</b>
	<?php echo CHtml::encode($data->date_modify); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('date_release')); ?>:</b>
	<?php echo CHtml::encode($data->date_release); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seller_id')); ?>:</b>
	<?php echo CHtml::encode($data->seller_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('device_state_id')); ?>:</b>
	<?php echo CHtml::encode($data->device_state_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('device_status_id')); ?>:</b>
	<?php echo CHtml::encode($data->device_status_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_service')); ?>:</b>
	<?php echo CHtml::encode($data->is_service); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_paid_repair')); ?>:</b>
	<?php echo CHtml::encode($data->is_paid_repair); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_garanty_paid_repair')); ?>:</b>
	<?php echo CHtml::encode($data->is_garanty_paid_repair); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_repeated_repair')); ?>:</b>
	<?php echo CHtml::encode($data->is_repeated_repair); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_no_garanty')); ?>:</b>
	<?php echo CHtml::encode($data->is_no_garanty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_id')); ?>:</b>
	<?php echo CHtml::encode($data->customer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('claims')); ?>:</b>
	<?php echo CHtml::encode($data->claims); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('appearance')); ?>:</b>
	<?php echo CHtml::encode($data->appearance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cost')); ?>:</b>
	<?php echo CHtml::encode($data->cost); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	*/ ?>

</div>