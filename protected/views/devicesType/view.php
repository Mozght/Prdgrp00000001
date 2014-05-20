<?php
/* @var $this DevicesTypeController */
/* @var $model DevicesType */

$this->breadcrumbs=array(
	'Devices Types'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
	array('label'=>'Создать', 'url'=>array('create')),
);
?>

<h1>Просмотр #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'pa',
	),
)); ?>
