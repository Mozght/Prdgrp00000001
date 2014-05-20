<?php
/* @var $this DevicesBrandController */
/* @var $model DevicesBrand */

$this->breadcrumbs=array(
	'Devices Brands'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
	array('label'=>'Создать', 'url'=>array('create')),
);
?>

<h1>Создать</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>