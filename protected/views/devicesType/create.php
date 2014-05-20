<?php
/* @var $this DevicesTypeController */
/* @var $model DevicesType */

$this->breadcrumbs=array(
	'Devices Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
	array('label'=>'Создать', 'url'=>array('create')),
);
?>

<h1>Создание типа устройства</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>