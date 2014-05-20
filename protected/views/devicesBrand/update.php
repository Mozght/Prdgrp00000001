<?php
/* @var $this DevicesBrandController */
/* @var $model DevicesBrand */

$this->breadcrumbs=array(
	'Devices Brands'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
	array('label'=>'Создать', 'url'=>array('create')),
);
?>

<h1>Обновить устройство <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>