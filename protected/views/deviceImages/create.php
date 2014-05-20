<?php
/* @var $this DeviceImagesController */
/* @var $model DeviceImages */

$this->breadcrumbs=array(
	'Device Images'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DeviceImages', 'url'=>array('index')),
	array('label'=>'Manage DeviceImages', 'url'=>array('admin')),
);
?>

<h1>Create DeviceImages</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>