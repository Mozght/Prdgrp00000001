<?php
/* @var $this UsersGroupsController */
/* @var $model UsersGroup */

$this->breadcrumbs=array(
	'Users Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UsersGroup', 'url'=>array('index')),
	array('label'=>'Manage UsersGroup', 'url'=>array('admin')),
);
?>

<h1>Create UsersGroup</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>