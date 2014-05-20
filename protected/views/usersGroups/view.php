<?php
/* @var $this UsersGroupsController */
/* @var $model UsersGroup */

$this->breadcrumbs=array(
	'Users Groups'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List UsersGroup', 'url'=>array('index')),
	array('label'=>'Create UsersGroup', 'url'=>array('create')),
	array('label'=>'Update UsersGroup', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UsersGroup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UsersGroup', 'url'=>array('admin')),
);
?>

<h1>View UsersGroup #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
	),
)); ?>
