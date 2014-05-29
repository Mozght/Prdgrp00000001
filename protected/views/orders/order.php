<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <style>
            ul,li {list-style:none;padding:0; margin:0;}
            div {margin:0;}
            body {text-indent:0;margin:0;padding:0;}
        </style>
    </head>
    <body>
        <table>
            <tr>
                <td style="height:530px;">
                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                        <tbody>
                            <tr>
                                <td width="15%"><img src="/images/logo.png" width="40px" /><br />
                                    <img src="/images/logotype.png" width="40px"/>
                                </td>
                                <td width="70%" colspan="2">
                                    <table>
                                        <tr><td style="line-height: 10em;font-size:7px;"><strong>Общество с ограниченной ответственностью «Прадагрупп»</strong></td></tr>
                                        <tr><td style="line-height: 10em;font-size:7px;"><strong>Адрес:</strong> Минск, ул. Сурганова, д.2, пом.71</td></tr>
                                        <tr><td style="line-height: 10em;font-size:7px;"><strong>Справка</strong> по тел.: ( 029 ) 678 57 30, ( 029 ) 755 55 65,  (025) 722 28 08</td></tr>
                                        <tr><td style="line-height: 10em;font-size:7px;"><strong>График работы:</strong> пн-пт 9.00-19.00, суб 10.00 - 17.00</td></tr>
                                        <tr><td style="line-height: 10em;font-size:7px;"><strong>Skype: </strong> pradagroup.by <strong>факс:</strong> (017) 292 78 21</td></tr>
                                    </table>
                                </td>
                                <td width="15%">                        
                                    <?php
                                    $pdf->write1DBarcode($order->id, 'C128B', 160, 5.5, 30, 7, 5, $style);
                                    echo '<div style="line-height:25px;"><strong>' . Yii::app()->dateFormatter->format("d.MM.y", $order->date_reciept) . '</strong></div>';
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h1 style="clear: both; text-align: center;line-height:5em;">ЗАКАЗ № <?php echo $order->id; ?></h1>
                    <div align="center"><strong style="font-size: 8px; line-height: 0em;">на оказание услуг/выполнение работ по ремонту оконечного абонентского устройства (ОАУ)</strong></div>
                    <table style="line-height:0em;">
                        <tr>
                            <td >
                                <h4 style="line-height: 8em;">Заказчик</h4>  
                                <div style="line-height: 6em;">ФИО: <strong><?php echo $order->Customer->title; ?></strong></div>
                                <div style="line-height: 6em;">Адрес: <strong><?php echo $order->Customer->address; ?></strong></div>
                                <div style="line-height: 6em;">Телефон: <strong>+<?php echo $order->Customer->area .' '. $order->Customer->code .' '. $order->Customer->phone; ?></strong></div>
                            </td>
                            <td>
                                <h4 style="line-height: 8em;">Оконечное абонентское устройство</h4>           
                                <div style="line-height: 6em;">Производитель: <strong><?php echo $order->Model->Type->title; ?> <?php echo $order->Model->Brand->title; ?> </strong></div>
                                <div style="line-height: 6em;">Тип: <strong><?php echo $order->Model->title; ?></strong></div>
                                <div style="line-height: 6em;">IMEI:&nbsp;<strong><?php echo $order->imei; ?></strong></div>
                            </td>
                        </tr>
                    </table>
                    <div style="border-bottom:1px solid #999;line-height:8em;height:0"></div>
                    <table border="0" cellpadding="0" cellspacing="0" style="line-height:20em;">
                        <tbody>
                            <tr>
                                <td width="33.33333%">Сервисное обслуживание: <strong><?php
                                        if ($order->is_service == 1) {
                                            echo 'Да';
                                        } else {
                                            echo 'Нет';
                                        }
                                        ?></strong></td>
                                <td width="33.33333%">Платный ремонт: <strong><?php
                                        if ($order->is_paid_repair == 1) {
                                            echo 'Да';
                                        } else {
                                            echo 'Нет';
                                        }
                                        ?></strong></td>
                                <td width="33.33333%">Гарантия на платный ремонт: <strong><?php
                                        if ($order->is_garanty_paid_repair == 1) {
                                            echo 'Да';
                                        } else {
                                            echo 'Нет';
                                        }
                                        ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <p><strong>Принято c аксессуарами:</strong> 
                        <?php
                        $i = 1;
                        foreach ($acc as $a) {
                            if ($i==0) echo ', '; 
                            echo $a->Title->title;
                            echo ' - ';
                            echo $a->title;
                            $i=0;
                        }
                        ?> 
                    </p>
                    <p><strong>Неисправности, заявленные Заказчиком:</strong> <?php echo $order->claims; ?></p>
                    <p><strong>Визуальная диагностика в присутствии Заказчика: </strong> <?php echo $order->appearance; ?> </p>
                    <p style="border-bottom:1px solid #999;"><strong>Разборка ОАУ в соответствии  с ремонтной документацией производителя при приеме не производилась</strong>
                    </p>
                    <div style="line-height:10em;"></div>
                    <table>
                        <tr>
                            <td width="70%">Устройство в ремонт сдал(а), с заполненным согласен(на)&quot;</td>
                            <td width="30%">
                                ____________ ( подпись заказчика )</td>
                        </tr>
                    </table>
                    <p><strong>Примерная калькуляция:</strong>&nbsp;&nbsp; Всего: <?php if (!empty($order->cost)) echo '<strong> ' . $order->cost . '</strong> рублей'; ?> </p>
                    <p style="line-height:10em;"><strong>Диагностические работы оплачиваются во всех случаях, независимо от результатов диагностики и желания Заказчика продолжить ремонт или отказаться от него.</strong></p> 
                    <table>
                        <tr>
                            <td width="70%" style="line-height:15em;">С примерной калькуляцией и оплатой диагностики согласен (на)</td>
                            <td width="30%">
                                ____________ ( подпись заказчика )</td>
                        </tr>
                    </table>

                    <p><strong>Срок</strong> <strong>исполнения</strong><strong> 14 </strong><strong>дней</strong><strong>. &nbsp;</strong>В случае отсутствия запчастей срок исполнения работ может быть продлен до 30 дней.&nbsp; Ремонт телефона, выполненный в течение гарантийного срока эксплуатации, влечет за собой невозможность последующего гарантийного ремонта в сервисных центрах изготовителей либо его официальных представителей.</p>

                    <table style="line-height:15em;">
                        <tr>
                            <td width="70%">ОАУ принял: <strong> <?php echo $order->User->title; ?></strong></td>
                            <td width="30%">____________ ( подпись приемщика )</td>
                        </tr>
                    </table>
                    <table border="1" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <th height="30px" style="width:40%"><p style="text-indent:2em;line-height:15em;">Результат осмотра:</p></th>
                        <th colspan="4" style="width:60%;"><p style="text-indent:2em;line-height:15em;">Инженер:</p></th>
            </tr>
            <tr>
                <td style="width:40%"><p style="text-indent:2em;line-height:10em;">Наименование работ</p></td>
                <td style="width:15%;"><p style="text-indent:2em;line-height:10em;text-align: center">Стоимость работ</p></td>
                <td colspan = "2" style="width:30%;"><p style="text-indent:2em;line-height:10em;text-align: center">Замененная деталь</p></td>
                <td style="width:15%;"><p style="text-indent:2em;line-height:10em;text-align: center">Стоимость детали</p></td>
            </tr>
            <tr>
                <td><p style="text-indent:2em;line-height:15em;">&nbsp;</p></td>
                <td><p style="text-indent:2em;line-height:15em;">&nbsp;</p></td>
                <td colspan = "2"><p style="text-indent:2em;line-height:15em;">&nbsp;</p></td>
                <td><p style="text-indent:2em;line-height:15em;">&nbsp;</p></td>
            </tr>
            <tr>
                <td><p style="text-indent:2em;line-height:15em;">&nbsp;</p></td>
                <td><p style="text-indent:2em;line-height:15em;">&nbsp;</p></td>
                <td colspan = "2"><p style="text-indent:2em;line-height:15em;">&nbsp;</p></td>
                <td><p style="text-indent:2em;line-height:15em;">&nbsp;</p></td>
            </tr>
            <tr>
                <td><p style="text-indent:2em;line-height:15em;">&nbsp;</p></td>
                <td><p style="text-indent:2em;line-height:15em;">&nbsp;</p></td>
                <td colspan = "2"><p style="text-indent:2em;line-height:15em;">&nbsp;</p></td>
                <td><p style="text-indent:2em;line-height:15em;">&nbsp;</p></td>
            </tr>
            <tr>
                <td colspan="2" style=""><p style="text-indent:2em;line-height:25em;">Инженер</p></td>
                <td colspa="2"></td>
                <td ><p style="text-indent:2em;line-height:25em;">ВСЕГО:</p></td>
                <td><p style="text-indent:2em;line-height:15em;">&nbsp;</p></td>
            </tr>
        </tbody>
    </table>
    <p style="line-height:15em;"><strong>Оборудование мной получено и проверено. </strong>
        <br/>
        <strong>Претензий не имею </strong>  _______________________ (подпись заказчика) 
        _______________________________ (ФИО)
        _________________ (дата)  
    </p>  
    
</td>
</tr>
</table>
<p style="border-top:1px dashed #999;line-height:16em;"></p>
<table>
    <tr>
        <td width="15%">
            <img src="/images/logo.png" width="30px"/><br/>
            <img src="/images/logotype.png" width="35px" />
        </td>
        <td width="70%">
            <h2 style="text-align: center;line-height:3.6em;"><strong>ОТРЫВНОЙ ЛИСТОК К ЗАКАЗУ № <?php echo $order->id; ?></strong></h2>
            <p style="text-align: center;"><strong style="line-height: 1.8em;">Оконечное абонентское устройство</strong></p>
        </td>
        <td width="15%">
            <?php $pdf->write1DBarcode($order->id, 'C128B', 160, 205, 30, 7, 5, $style); ?>
            <?php echo '<div style="line-height:20em;"><strong>' . Yii::app()->dateFormatter->format("d.MM.y", $order->date_reciept) . '</strong></div>'; ?>
        </td>
    </tr>
</table>
<table>
    <tr>
        <td>
            <div style="line-height: 4em;">Производитель: <strong><?php echo $order->Model->Type->title; ?> <?php echo $order->Model->Brand->title; ?> </strong></div>    
        </td>
        <td>
            <div style="line-height: 4em;">Тип: <strong><?php echo $order->Model->title; ?></strong></div>
        </td>
        <td>
            <div style="line-height: 4em;">IMEI: <strong><?php echo $order->imei; ?></strong></div>
        </td>
    </tr>
</table>
<br/><br/>
<table border="0" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td width="33.33333%">Сервисное обслуживание: <strong><?php
                    if ($order->is_service == 1) {
                        echo 'Да';
                    } else {
                        echo 'Нет';
                    }
                    ?></strong></td>
            <td width="33.33333%">Платный ремонт: <strong><?php
                    if ($order->is_paid_repair == 1) {
                        echo 'Да';
                    } else {
                        echo 'Нет';
                    }
                    ?></strong></td>
            <td width="33.33333%">Гарантия на платный ремонт: <strong><?php
                    if ($order->is_garanty_paid_repair == 1) {
                        echo 'Да';
                    } else {
                        echo 'Нет';
                    }
                    ?></strong></td>
        </tr>
    </tbody>
</table>
<p><strong>Принято c аксессуарами:</strong> 
    <?php
                        $i = 1;
                        foreach ($acc as $a) {
                            if ($i==0) echo ', '; 
                            echo $a->Title->title;
                            echo ' - ';
                            echo $a->title;
                            $i=0;
                        }
                        ?> 
</p>
<p><strong>Неисправности, заявленные Заказчиком</strong>:&nbsp;<?php echo $order->claims; ?></p>
<p ><strong style="line-height:14em;">Результат разборки ОАУ в соответствии с эксплуатационной документацией, поставляемой вместе с ОАУ, и
        визуальной диагностики в присутствии Заказчика : _________________________________________ (подпись заказчика)
    </strong>
</p>
<p style="font-size:9px"><strong>Срок исполнения 14 дней. </strong> В случае отсутствия запчастей срок исполнения работ может быть продлен до 30 дней.&nbsp; Ремонт телефона, выполненный в течение гарантийного срока эксплуатации, влечет за собой невозможность последующего гарантийного ремонта в сервисных центрах изготовителей либо его официальных представителей.</p>
<p>ОАУ принял: <strong><?php echo $order->User->title; ?></strong> <strong>________________________(подпись)</strong></p>
<p style="line-height:10em;"><strong>ООО &laquo;Прадагрупп&raquo;</strong><br/>
    <strong>Адрес</strong>: Минск, ул. Сурганова, д.2, пом.71 <strong>Справка по тел.:  ( 029 ) 678 57 30, ( 029 ) 755 55 65,&nbsp; (025) 722 28 08&nbsp;</strong><br/>
    График работы: пн-пт 9.00-19.00, суб 10.00 - 17.00 <strong>Skype</strong>: pradagroup.by &nbsp;&nbsp;&nbsp;факс: (017) 292 78 21</p>