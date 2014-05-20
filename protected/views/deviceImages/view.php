<?php
/* @var $this DeviceImagesController */
/* @var $model DeviceImages */

$this->breadcrumbs=array(
	'Device Images'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List DeviceImages', 'url'=>array('index')),
	array('label'=>'Create DeviceImages', 'url'=>array('create')),
	array('label'=>'Update DeviceImages', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DeviceImages', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DeviceImages', 'url'=>array('admin')),
);
?>

<h1>View DeviceImages #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'url',
		'pa',
	),
)); ?>
