<?php
/* @var $this DeviceAccessoriesController */
/* @var $model DeviceAccessories */

$this->breadcrumbs=array(
	'Device Accessories'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
	array('label'=>'Создать', 'url'=>array('create')),
);
?>

<h1>Просмотр аксессуара #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'pa',
	),
)); ?>
