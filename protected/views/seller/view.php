<?php
/* @var $this SellerController */
/* @var $model Seller */

$this->breadcrumbs=array(
	'Sellers'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
	array('label'=>'Создать', 'url'=>array('create')),
);
?>

<h1>Просмотреть продавца #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
	),
)); ?>
