<?php
/* @var $this DeviceStateController */
/* @var $model DeviceState */

$this->breadcrumbs=array(
	'Device States'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DeviceState', 'url'=>array('index')),
	array('label'=>'Create DeviceState', 'url'=>array('create')),
	array('label'=>'View DeviceState', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DeviceState', 'url'=>array('admin')),
);
?>

<h1>Update DeviceState <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>