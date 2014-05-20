<?php
/* @var $this SellerController */
/* @var $model Seller */

$this->breadcrumbs=array(
	'Sellers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
	array('label'=>'Создать', 'url'=>array('create')),
);
?>

<h1>Создать продавца</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>