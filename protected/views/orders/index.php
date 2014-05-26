<?php
/* @var $this OrdersController */
/* @var $model Orders */
$this->breadcrumbs = array(
    'Orders' => array('index'),
    'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#orders-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php //echo CHtml::link('Поиск', '#', array('class' => 'search-button')); ?>
<!--<div class="search-form" style="display:none">
    <?php/*
    $this->renderPartial('_search', array(
        'model' => $model,
    ));*/
    ?>
</div>-->
<?php if ($count > 0 ) {?>
<div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Внимание!</strong> В ремонте находятся <strong><?php echo $count;?></strong> заказов, не выданных в 14 дневный срок.
</div>
<?php } ?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'orders-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'rowCssClassExpression' => '
        ( $row%2 ? $this->rowCssClass[1] : $this->rowCssClass[0] ) .
        ( $data->device_status_id == 1 ? " c_st_1" : null ) .
        ( $data->device_status_id == 2 ? " c_st_2" : null ) .
        ( $data->device_status_id == 3 ? " c_st_3" : null ) .
        ( $data->device_status_id == 4 ? " c_st_4" : null ) .
        ( $data->device_status_id == 5 ? " c_st_5" : null ) .
        ( $data->device_status_id == 6 ? " c_st_6" : null ) .
        ( $data->device_status_id == 7 ? " c_st_7" : null ) .
        ( strtotime($data->date_sale."+13 days") > time()-(60*60*24) ? " c_st_8" : null ) .
        ( strtotime($data->date_reciept."+13 days") < time()-(60*60*24) ? " c_st_9" : null ) .
        ( $data->pa ? null : " deleted" )
    ',
    'columns' => array(
        array(
            'name' => 'id',
            'header'=>'#',
            'htmlOptions' => array('width' => '30px', 'style' => "font-weight:bold;text-align:center;"),
        ),
        array(
            'name' => 'Model.Brand',
            'header'=>'Брэнд',
            'value' => '$data->Model->Brand->title',
            //'sortable' => true,
        ),
        array(
            'name' => 'Model',
            'value' => '$data->Model->title',
            'sortable' => true,
        ),
        'imei',
        array(
            'name' => 'device_status_id',
            'type'=>'raw',
            'value' => '"<div class=\"clearfix mt5\"><div class=\"st c_st_1\"></div><div class=\"st c_st_2\"></div><div class=\"st c_st_3\"></div><div class=\"st c_st_4\"></div><div class=\"st c_st_5\"></div><div class=\"st c_st_6\"></div><div class=\"st c_st_7\"></div><div class=\"st c_st_8\"></div></div"',
            'filter' => DeviceStatus::all(),
            'sortable' => false,
        ),
        array(
            'name' => 'date_release',
            'value' => '($data->device_status_id!=7)?"":Yii::app()->dateFormatter->format(\'dd.MM.yyyy HH:mm:ss\', strtotime($data->date_release))',
        ),
        array(
            'name' => 'Customer',
            'value' => '$data->Customer->title',
            'sortable' => true,
        ),
        'cost',
        array(
            'name'=>'claims',
            'filterHtmlOptions'=>array('style'=>'width: 15%;'),
        ),
        array(
            'name'=>'result',
            'filterHtmlOptions'=>array('style'=>'width: 15%;'),
        ),
        array(
            'name'=>'description',
            'filterHtmlOptions'=>array('style'=>'width: 10%;'),
        ),
        array(
            'name' => 'date_reciept',
            'value' => 'Yii::app()->dateFormatter->format(\'dd.MM.yyyy HH:mm:ss\', strtotime($data->date_reciept))',
        ),
        array(
            'name' => 'UserTo',
            'value' => '(empty($data->UserTo->id))?"Нет":$data->UserTo->title',
        ),
        
        array(
            'class' => 'CButtonColumn',
            'template'=>'{redirect} {view} {pdf} {update} {delete}',
            'buttons' => array(
                            'redirect' => array(
                                'imageUrl'=>'/images/redirect.png',
                                'url' => 'Yii::app()->createUrl("history/create&id=$data->id")',
                                'visible'=> '(empty($data->UserTo->id)||Yii::app()->user->id === $data->UserTo->id)?true:false',
                            ),
                            'pdf' => array(
                                'imageUrl'=>'/images/pdf.png',
                                'url' => '(is_file(Yii::app()->basepath."/../upload/order-$data->id.pdf"))?"/upload/order-$data->id.pdf":Yii::app()->createUrl("orders/createPDF&id=$data->id")',                                
                            ),
             ),
        ),
    ),
));
?>

<h4>Легенда:</h4>
<div class="legend statuses">
    <div class="st c_st_1"> </div> - Принят в ремонт
    <div class="st c_st_2"> </div> - В ремонте
    <div class="st c_st_3"> </div> - Готов к выдаче
    <div class="st c_st_7"> </div> - Выдан
    <div class="st c_st_4"> </div> - На тестировании
    <div class="st c_st_5"> </div> - Перенаправлен на ремонт<br/>
    <div class="st c_st_6"> </div> - Перенаправлен на тестирование
    <div class="st c_st_8"> </div> - Дата продажи меньше 14 дней
    <div class="st c_st_9"> </div> - Телефон находится в ремонте более 14 дней
</div>
