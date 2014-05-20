<?php
/* @var $this DevicesController */
/* @var $data Devices */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pa')); ?>:</b>
	<?php echo CHtml::encode($data->pa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('devices_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->devices_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('devices_brand_id')); ?>:</b>
	<?php echo CHtml::encode($data->devices_brand_id); ?>
	<br />


</div>