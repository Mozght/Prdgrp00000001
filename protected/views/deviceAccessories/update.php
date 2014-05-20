<?php
/* @var $this DeviceAccessoriesController */
/* @var $model DeviceAccessories */

$this->breadcrumbs=array(
	'Device Accessories'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
	array('label'=>'Создать', 'url'=>array('create')),
);
?>

<h1>Исправить аксессуар <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>