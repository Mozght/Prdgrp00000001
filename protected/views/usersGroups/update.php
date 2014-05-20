<?php
/* @var $this UsersGroupsController */
/* @var $model UsersGroup */

$this->breadcrumbs=array(
	'Users Groups'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UsersGroup', 'url'=>array('index')),
	array('label'=>'Create UsersGroup', 'url'=>array('create')),
	array('label'=>'View UsersGroup', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UsersGroup', 'url'=>array('admin')),
);
?>

<h1>Update UsersGroup <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>