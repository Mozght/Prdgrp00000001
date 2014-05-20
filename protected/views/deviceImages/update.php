<?php
/* @var $this DeviceImagesController */
/* @var $model DeviceImages */

$this->breadcrumbs=array(
	'Device Images'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DeviceImages', 'url'=>array('index')),
	array('label'=>'Create DeviceImages', 'url'=>array('create')),
	array('label'=>'View DeviceImages', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DeviceImages', 'url'=>array('admin')),
);
?>

<h1>Update DeviceImages <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>