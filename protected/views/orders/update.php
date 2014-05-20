<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs=array(
	'Orders'=>array('index'),
	$orders->id=>array('view','id'=>$orders->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
	array('label'=>'Создать', 'url'=>array('create')),
);
?>

<h1>Обновить заказ <?php echo $orders->id; ?></h1>

<?php $this->renderPartial('_form', array('orders'=>$orders,'customers' => $customers, 'device'=>$device)); ?>