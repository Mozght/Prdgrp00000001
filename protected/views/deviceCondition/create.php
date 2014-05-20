<?php
/* @var $this DeviceConditionController */
/* @var $model DeviceCondition */

$this->breadcrumbs=array(
	'Device Conditions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
	array('label'=>'Создать', 'url'=>array('create')),
);
?>

<h1>Создать состоение</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>