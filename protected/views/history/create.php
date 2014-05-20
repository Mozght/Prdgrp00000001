<?php
/* @var $this HistoryController */
/* @var $model History */

$this->breadcrumbs=array(
	'Histories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
);
?>

<h1>Создать</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'id'=>$id,'orders'=>$orders)); ?>