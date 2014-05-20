<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>
        <?php
        $admin_menu = array('label' => 'Администрирование', 'url' => array('/'),
            'items' => array(
                array('label' => 'Аксессуары', 'url' => array('/DeviceAccessories/')),
                array('label' => 'Клиенты', 'url' => array('/Customers/')),
                array('label' => 'Продавцы', 'url' => array('/Seller/')),
                array('label' => 'Пользователи', 'url' => array('/Users/')),
                array('label' => 'История', 'url' => array('/History/')),
                array('label' => 'Состояние', 'url' => array('/DeviceCondition/')),
                array('label' => 'Статусы', 'url' => array('/DeviceStatus/')),
                //array('label' => 'Статус ремонта', 'url'=>array('/DeviceState/')),
                array('label' => 'Устройства', 'url' => array('#'),
                    'items' => array(
                        array('label' => 'Тип', 'url' => array('/DevicesType/')),
                        array('label' => 'Брэнд', 'url' => array('/DevicesBrand/')),
                        array('label' => 'Устройство', 'url' => array('/Devices/')),
                    )),
            ),
        );
        ?>
        <div class="container" id="page">

            <div id="header" class="clearfix">
                <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
                <div class="pull-right">
<?php
if (!Yii::app()->user->isGuest) {

    echo Yii::app()->user->title;
    echo ' - ';
    echo CHtml::link('Изменить', array('users/update', 'id' => Yii::app()->user->id));
}
?></div>

            </div><!-- header -->
            <div id="mainmenu">
                    <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array('label' => 'Главная', 'url' => array('/')),
                            array('label' => 'Заказы',
                                'items' => array(
                                    array('label' => 'Просмотр', 'url' => array('/Orders')),
                                    array('label' => 'Оформить', 'url' => array('/Orders/create')),
                                )),
                            $admin_menu,
                            array('label' => 'Выйти (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                        ),
                    ));
                    ?>
            </div><!-- mainmenu -->
                <?php if (isset($this->breadcrumbs)): ?>
                    <?php
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links' => $this->breadcrumbs,
                    ));
                    ?><!-- breadcrumbs -->
            <?php endif ?>

            <?php echo $content; ?>

            <div class="clear"></div>

            <div id="footer">
                Copyright &copy; <?php echo date('Y'); ?>.<br/>
                All Rights Reserved.<br/>
            </div><!-- footer -->

        </div><!-- page -->
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/bootstrap.min.js', CClientScript::POS_END); ?>
        <script>
            $(document).ready(function() {
                $('#Orders_Accessories_Checkbox input').one("click",function() {
                    $(this).after('<input type="text" name="Orders[Accessories][Title][]"/>');
                });                               
            });
        </script>
    </body>
</html>
