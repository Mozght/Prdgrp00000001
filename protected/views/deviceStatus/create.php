<?php
/* @var $this DeviceStatusController */
/* @var $model DeviceStatus */

$this->breadcrumbs=array(
	'Device Statuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
	array('label'=>'Создать', 'url'=>array('create')),
);
?>

<h1>Создание статуса</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>