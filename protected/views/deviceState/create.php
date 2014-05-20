<?php
/* @var $this DeviceStateController */
/* @var $model DeviceState */

$this->breadcrumbs=array(
	'Device States'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DeviceState', 'url'=>array('index')),
	array('label'=>'Manage DeviceState', 'url'=>array('admin')),
);
?>

<h1>Create DeviceState</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>