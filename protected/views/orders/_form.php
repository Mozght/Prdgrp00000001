<?php
/* @var $this OrdersController */
/* @var $orders Orders */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'orders-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Поля <span class="required">*</span> обязательные к заполнению.</p>

    <?php echo $form->errorSummary($orders); ?>
    
    <?php
    
        if(!$orders->isNewRecord){           
            $dropBrand = CHtml::listData(Devices::allBrandsOfTypes($device->Type->id), 'Brand.id', 'Brand.title');
            $dropModel = CHtml::listData(Devices::allModelsOfTypesNBrands($device->Type->id,$device->Brand->id), 'id', 'title');
            $deviceType = $device->Type;
            $deviceBrand = $device->Brand;
            $deviceid = $device->id;
        }
        else {
            $dropBrand = array();
            $dropModel = array();
            $deviceType = '';
            $deviceBrand = '';
            $deviceid = '';
            
        }
    
    ?>
    
    <?php if (Yii::app()->user->role === 'admin' && !$orders->isNewRecord) {
        echo $form->dropDownList($orders,'pa', array('1'=>'Виден','0'=>'Удален'));
    }
    ?>
    <?php
    if(!$orders->isNewRecord){?>
        <div class="form_row">
            <?php echo $form->labelEx($orders, 'device_status_id'); ?>
            <?php echo $form->dropDownList($orders,'device_status_id', DeviceStatus::all()); ?> 
            <?php echo $form->error($orders, 'device_status_id'); ?>
        </div> 
    <?php
    }    
    ?>
    
    <?php if (Yii::app()->user->role === 'engineer') {
        echo $device->Type->title.' '.$device->Brand->title.' '.$device->title;
    }
    else {
    ?>
    <div class="form_row">
        <?php echo $form->labelEx($orders, 'device_id'); ?>
        <?php echo $form->hiddenField($orders, 'device_id'); ?>
        <?php echo $form->error($orders, 'device_id'); ?>
    </div>
    <div class="form_row">
        <?php
        echo CHtml::dropDownList('devices_type_id', $deviceType , CHtml::listData(DevicesType::allinArray(), 'id', 'title') , array(
            'empty' => 'Выбрать устройство',
            'ajax' => array(
                'type' => 'POST', //request type
                'url' => CController::createUrl('Devices/FindBrands'), //url to call.
                //Style: CController::createUrl('currentController/methodToCall')
                'update' => '#devices_brand_id',
            //'data'=>'js:javascript statement' 
            //leave out the data key to pass all form values through
        )));

        //empty since it will be filled by the other dropdown
        echo CHtml::dropDownList('devices_brand_id', $deviceBrand , $dropBrand , array(
            'empty' => 'Выбрать Брэнд',
            'ajax' => array(
                'type' => 'POST', //request type
                'url' => CController::createUrl('Devices/FindModels'), //url to call.
                //Style: CController::createUrl('currentController/methodToCall')
                'update' => '#device_model', //selector to update
                'devices_type_id' => 'js:this.value',
            //'data'=>'js:javascript statement' 
            //leave out the data key to pass all form values through
            ))
        );
        echo CHtml::dropDownList('device_model', $deviceid, $dropModel, array(
            'empty' => 'Выбрать Модель',
            'onchange' => "{
                        $('#Orders_device_id').val($('#device_model option:selected').val());
                        return false;
                      }"
        ));
        ?>
        <?php echo CHtml::link('<span class="glyphicon glyphicon-plus-sign"></span>', 'javascript:;', array('onclick'=>'add_model_field($(this)); return false;')); ?>
        <script>
            function add_model_field(obj) {
                    if(!confirm("Вы уверены ?")){
                        return false;
                     }
                    else {                        
                        $('#Orders_device_id').val(0);
                        obj.parent().append('<input name="device_model" id="device_model_title" type="text" />');
                        $('#device_model').remove();
                        obj.remove();
                    }
            }; 
        </script>
    </div>
    <?php }?>
    
    <?php if (Yii::app()->user->role !== 'engineer') {?>
    

    <div class="form_row">
        <?php echo $form->labelEx($orders, 'imei'); ?>
         <?php
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'model'=>$orders, // модель
            'attribute'=>'imei', // атрибут модели
            // "источник" данных для выборки
            // может быть url, который возвращает JSON, массив
            // или функция JS('js: alert("Hello!");')
            'source' =>Yii::app()->createUrl('Orders/AutoCompleteImei'),
            'options'=>array(
                // минимальное кол-во символов, после которого начнется поиск
                'minLength'=>'10',
                'showAnim'=>'fold',
                // обработчик события, выбор пункта из списка
                'select' =>'js: function(event, ui) {
                    // действие по умолчанию, значение текстового поля
                    // устанавливается в значение выбранного пункта
                    this.value = ui.item.value;
                    $("#imei_yes").removeClass("hidden");
                    $("#imei_no").addClass("hidden");
                    return false;
                }',
            ),
            'htmlOptions' => array(
                'maxlength'=>15,
            ),
            ));
        ?>
        <?php echo CHtml::link('есть', array('#'),array('id'=>'imei_yes','class'=>'hidden')); ?>
        <?php echo CHtml::link('нет', array('#'),array('id'=>'imei_no','class'=>'')); ?>
        <?php echo $form->error($orders, 'imei'); ?>
    </div>

    <div class="form_row">
        <?php echo $form->labelEx($orders, 'date_sale'); ?>
        <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $orders,
                'attribute' => 'date_sale',
                'language' => 'ru',
                'options' => array(
                    'dateFormat' => 'dd-mm-yy',     
                    'showButtonPanel' => false,      // show button panel
                ),
                'htmlOptions' => array(
                    'size' => '12',         // textField size
                    'maxlength' => '12',    // textField maxlength
                ),
            ));
            ?>
        <?php echo $form->error($orders, 'date_sale'); ?>
    </div>

    <div class="form_row">
        <?php echo $form->labelEx($orders, 'seller_id'); ?>
        <?php echo $form->dropDownList($orders,'seller_id', Seller::all(),array('empty'=>'Продавец')); ?> 
        <?php echo CHtml::link('<span class="glyphicon glyphicon-plus-sign"></span>', 'javascript:;', array('onclick'=>'add_seller_field($(this)); return false;')); ?>
        <?php echo $form->error($orders, 'seller_id'); ?>
    </div>
    <script>
            function add_seller_field(obj) {
                    if(!confirm("Вы уверены ?")){
                        return false;
                     }
                    else {
                        obj.parent().append('<input name="Seller[title]" id="seller_title" type="text" />');
                        $('#Orders_seller_id').remove();
                        obj.remove();
                    }
                }; 
    </script>
    <div class="form_row clearfix">
        <?php echo $form->labelEx($orders, 'is_service'); ?>
        <?php echo $form->checkBox($orders,'is_service', array('value'=>1, 'uncheckValue'=>0)); ?>
        <?php echo $form->error($orders, 'is_service'); ?>
    </div>

    <div class="form_row clearfix">
        <?php echo $form->labelEx($orders, 'is_paid_repair'); ?>
        <?php echo $form->checkBox($orders,'is_paid_repair', array('value'=>1, 'uncheckValue'=>0)); ?>
        <?php echo $form->error($orders, 'is_paid_repair'); ?>
    </div>

    <div class="form_row clearfix">
        <?php echo $form->labelEx($orders, 'is_garanty_paid_repair'); ?>
        <?php echo $form->checkBox($orders,'is_garanty_paid_repair', array('value'=>1, 'uncheckValue'=>0)); ?>
        <?php echo $form->error($orders, 'is_garanty_paid_repair'); ?>
    </div>

    <div class="form_row clearfix">
        <?php echo $form->labelEx($orders, 'is_repeated_repair'); ?>
        <?php echo $form->checkBox($orders,'is_repeated_repair', array('value'=>1, 'uncheckValue'=>0)); ?>
        <?php echo $form->error($orders, 'is_repeated_repair'); ?>
    </div>

    <div class="form_row clearfix">
        <?php echo $form->labelEx($orders, 'is_no_garanty'); ?>
        <?php echo $form->checkBox($orders,'is_no_garanty', array('value'=>1, 'uncheckValue'=>0)); ?>
        <?php echo $form->error($orders, 'is_no_garanty'); ?>
    </div>

    <div class="form_row">
        <?php echo $form->hiddenField($orders, 'customer_id'); ?>
        <?php echo $form->error($orders, 'customer_id'); ?>
    </div>

    <div class="form_row">
        <?php echo $form->labelEx($orders, 'claims'); ?>
        <?php echo $form->textArea($orders, 'claims', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($orders, 'claims'); ?>
    </div>
    <hr />
    <h3>Клиент</h3>
    <div class="form_row">
        <?php echo $form->labelEx($customers, 'title'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'model'=>$customers, // модель
            'attribute'=>'title', // атрибут модели
            // "источник" данных для выборки
            // может быть url, который возвращает JSON, массив
            // или функция JS('js: alert("Hello!");')
            'source' =>Yii::app()->createUrl('Customers/AutoCompleteTitle'),
            'options'=>array(
                // минимальное кол-во символов, после которого начнется поиск
                'minLength'=>'4',
                'showAnim'=>'fold',
                // обработчик события, выбор пункта из списка
                'select' =>'js: function(event, ui) {
                    this.value = ui.item.value;
                    $("#Customers_address").val(ui.item.address);
                    $("#Customers_phone").val(ui.item.phone);
                    $("#Customers_description").val(ui.item.description);
                    $("#Orders_customer_id").val(ui.item.id);
                    return false;
                }',
            ),
            'htmlOptions' => array(
                'maxlength'=>50,
            ),
            ));
        ?>
        <?php echo $form->error($customers, 'title'); ?>
    </div>
    <div class="form_row">
        <?php echo $form->labelEx($customers, 'address'); ?>
        <?php echo $form->textField($customers, 'address'); ?>
        <?php echo $form->error($customers, 'address'); ?>
    </div>
    <div class="form_row">
        <?php echo $form->labelEx($customers, 'phone'); ?>
        <?php echo $form->textField($customers, 'phone'); ?>
        <?php echo $form->error($customers, 'phone'); ?>
    </div>
    <div class="form_row">
        <?php echo $form->labelEx($customers, 'description'); ?>
        <?php echo $form->textField($customers, 'description'); ?>
        <?php echo $form->error($customers, 'description'); ?>
    </div>
    <?php echo $form->hiddenField($customers, 'pa',array('value'=> 1)); ?>
    <hr />
    <div class="form_row">
        <?php echo $form->labelEx($orders, 'appearance'); ?>
        <?php echo $form->textArea($orders, 'appearance', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($orders, 'appearance'); ?>
    </div>
    <?php }?>
    <div class="form_row">
        <?php echo $form->labelEx($orders, 'description'); ?>
        <?php echo $form->textArea($orders, 'description', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($orders, 'description'); ?>
    </div>
    <?php if (Yii::app()->user->role === 'engineer') {?>
     <div class="form_row">
        <?php echo $form->labelEx($orders, 'result'); ?>
        <?php echo $form->textArea($orders, 'result', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($orders, 'result'); ?>
    </div>   
    <?php }?>
    <?php if (Yii::app()->user->role !== 'engineer') {?>
    <hr />
    <h3>Аксессуары</h3>
    <div class="form_row checkboxes">
		<?php 
                if($orders->IsNewRecord) {
                    echo $form->checkBoxList($orders, 'Accessories[Checkbox]', DeviceAccessories::all(),array('key'=>'accessory_id','multiple'=>'multiple','template'=>'<div class="checkbox_row">{label} {input}</div>')); 
                }
                else {            
                    $orders->setSelectedAccessories();//устанавливаю массив выбраных категорий
                    echo $form->checkBoxList($orders, 'selectedaccessories', DeviceAccessories::all(),array('template'=>'<div class="checkbox_row">{label} {input}</div>')); 
                }              
                ?>
    </div>
    <hr />  
    <div class="form_row">
        <?php echo $form->labelEx($orders, 'cost'); ?>
        <?php echo $form->textField($orders, 'cost'); ?>
        <?php echo $form->error($orders, 'cost'); ?>
    </div>
    <?php }?>
    <div class="form_row buttons">
        <?php echo CHtml::submitButton($orders->isNewRecord ? 'Создать' : 'Сохранить'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->