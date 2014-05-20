<?php
/* @var $this DeviceAccessoriesController */
/* @var $model DeviceAccessories */

$this->breadcrumbs=array(
	'Device Accessories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
	array('label'=>'Создать', 'url'=>array('create')),
);
?>

<h1>Добавить аксессуар</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>