<?php
/* @var $this DeviceStateController */
/* @var $model DeviceState */

$this->breadcrumbs=array(
	'Device States'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List DeviceState', 'url'=>array('index')),
	array('label'=>'Create DeviceState', 'url'=>array('create')),
	array('label'=>'Update DeviceState', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DeviceState', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DeviceState', 'url'=>array('admin')),
);
?>

<h1>View DeviceState #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'pa',
	),
)); ?>
