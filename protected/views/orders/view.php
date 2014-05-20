<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs=array(
	'Orders'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
	array('label'=>'Создать', 'url'=>array('create')),
);
?>
<?php $device = $model->Model->Brand->title.' '.$model->Model->title;?>
<h1>Просмотр заказа #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
                    'label'=>'Устройство',
                    'type'=>'raw',
                    'value'=>$device,
                ),
		'imei',
		'date_sale',
		'date_reciept',
		'Seller.title:text:Продавец',
		//'device_state_id',
		'Device_Status.title:text:Статус',
                array(
                    'name'=>'is_service',
                    'label'=>'Сервисное обслуживание',
                    'value'=>(($model->is_service==0)?"Нет":"Да"),
                ),
                array(
                    'name'=>'is_paid_repair',
                    'label'=>'Платный ремонт',
                    'value'=>(($model->is_paid_repair==0)?"Нет":"Да"),
                ),
                array(
                    'name'=>'is_garanty_paid_repair',
                    'label'=>'Гарантия на платный ремонт',
                    'value'=>(($model->is_garanty_paid_repair==0)?"Нет":"Да"),
                ),
                array(
                    'name'=>'is_repeated_repair',
                    'label'=>'Повторный ремонт',
                    'value'=>(($model->is_repeated_repair==0)?"Нет":"Да"),
                ),
                array(
                    'name'=>'is_no_garanty',
                    'label'=>'Без гарантии',
                    'value'=>(($model->is_no_garanty==0)?"Нет":"Да"),
                ),
		'customer_id',
		'claims',
		'appearance',
		'description',
		'cost',
		'User.title:text:Приемщик',
	),
)); ?>


<h2>История ремонта</h2>
<?php
 foreach ($model->History as $history) {
     echo $history->date;echo '<br />';
     echo $history->User->title; echo ' => '; echo $history->UserTo->title; echo '<br />';
     echo $history->description;echo '<br />';echo '<br />';
 }
?>