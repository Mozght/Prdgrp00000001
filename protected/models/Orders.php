<?php

class Orders extends CActiveRecord {

    public $selectedaccessories = array();

    public function setSelectedAccessories() {
        foreach ($this->Accessories as $accessory) {
            array_push($this->selectedaccessories, $accessory->id);
        }
    }

    public function tableName() {
        return '{{orders}}';
    }

    public function rules() {
        return array(
            array('device_id,imei,claims,appearance,seller_id', 'required'),
            array('result', 'default'),
            array('pa,device_id, imei, seller_id, device_state_id, device_status_id, customer_id, cost, user_id', 'numerical', 'integerOnly' => true),
            array('is_service, is_paid_repair, is_garanty_paid_repair, is_repeated_repair, is_no_garanty', 'length', 'max' => 1),
            array('id, claims,date_sale, date_reciept,date_modify,date_release, seller_id, appearance, description, User, Customer, Model, Status, Accessories, pa', 'safe'),
            array('id, device_id, imei, date_sale, date_reciept, seller_id, device_state_id, device_status_id, is_service, is_paid_repair, is_garanty_paid_repair, is_repeated_repair, is_no_garanty, customer_id, claims, appearance, description, cost, user_id', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'Model' => array(self::BELONGS_TO, 'Devices', 'device_id'),
            'Customer' => array(self::BELONGS_TO, 'Customers', 'customer_id'),
            'User' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'UserTo' => array(self::BELONGS_TO, 'Users', 'to_user_id'),
            'Seller' => array(self::BELONGS_TO, 'Seller', 'seller_id'),
            'History' => array(self::HAS_MANY, 'History', 'order_id'),
            'Images' => array(self::HAS_MANY, 'Images', 'order_id'),
            'Device_Status' => array(self::BELONGS_TO, 'DeviceStatus', 'device_status_id'),
            'Accessories' => array(self::MANY_MANY, 'DeviceAccessories', 'pr_orders_accessories(order_id, accessory_id)'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'Номер заказа',
            'result' => 'Вып. работы',
            'device_id' => 'Устройство',
            'imei' => 'Imei',
            'date_sale' => 'Дата продажи',
            'date_reciept' => 'Дата приемки',
            'date_modify' => 'Дата изменения',
            'date_release' => 'Дата выдачи',
            'seller_id' => 'Продавец',
            'device_state_id' => 'Device State',
            'device_status_id' => 'Статус',
            'is_service' => 'Сервисное обслуживание (n1 сервисной карты)',
            'is_paid_repair' => 'Платный  ремонт',
            'is_garanty_paid_repair' => 'Гарантия на платный ремонт',
            'is_repeated_repair' => 'Повторный ремонт',
            'is_no_garanty' => 'Без гарантии',
            'customer_id' => 'Клиент',
            'claims' => 'Жалобы',
            'appearance' => 'Внешний вид',
            'description' => 'Примечание',
            'cost' => 'Стоимость',
            'user_id' => 'Приемщик',
            'Customer' => 'Клиент',
            'User' => 'Пользователь',
            'Model' => 'Модель',
            'UserTo' => 'Переправлен к'
        );
    }

    public function search() {
        $criteria = new CDbCriteria;
        $criteria->compare('t.id', $this->id);
        $criteria->compare('device_id', $this->device_id);
        $criteria->compare('imei', $this->imei);
        $criteria->compare('seller_id', $this->seller_id);
        $criteria->compare('device_state_id', $this->device_state_id);
        $criteria->compare('device_status_id', $this->device_status_id);
        $criteria->compare('is_service', $this->is_service, true);
        $criteria->compare('is_paid_repair', $this->is_paid_repair, true);
        $criteria->compare('is_garanty_paid_repair', $this->is_garanty_paid_repair, true);
        $criteria->compare('is_repeated_repair', $this->is_repeated_repair, true);
        $criteria->compare('is_no_garanty', $this->is_no_garanty, true);
        $criteria->compare('customer_id', $this->customer_id);
        $criteria->compare('claims', $this->claims, true);
        $criteria->compare('appearance', $this->appearance, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('cost', $this->cost);
        if (Yii::app()->user->role != 'admin') {
            $criteria->compare('t.pa', 1);
        }
        //if(!empty($this->date_sale))
        //$criteria->compare('DATE_FORMAT(t.date_sale, "%Y-%m-%d")', Yii::app()->dateFormatter->format('yyyy-MM-dd', strtotime($this->date_sale)));
        //if(!empty($this->date_reciept))
        //$criteria->compare('DATE_FORMAT(t.date_reciept, "%Y-%m-%d %H:%i:%S")', Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss', strtotime($this->date_reciept)));
        $criteria->with = array('User', 'Customer', 'Model');
        $criteria->compare('User.title', $this->User, true);
        $criteria->compare('Customer.title', $this->Customer, true);
        $criteria->compare('Model.title', $this->Model, true);
        //$criteria->compare('t.date_reciept',date("yyyy-MM-dd HH:mm:ss",strtotime($this->date_reciept),true));
        $criteria->order = 't.id DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('attributes' => array(
                    'User' => array(
                        'asc' => $expr = 'User.title',
                        'desc' => $expr . ' DESC',
                    ),
                    'Customer' => array(
                        'asc' => $expr = 'Customer.title',
                        'desc' => $expr . ' DESC',
                    ),
                    'Model' => array(
                        'asc' => $expr = 'Model.title',
                        'desc' => $expr . ' DESC',
                    ),
                    'id' => array(
                        'asc' => $expr = 't.id',
                        'desc' => $expr . ' DESC',
                    ),
                )),
        ));
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            $this->date_sale = date('Y-m-d', strtotime($this->date_sale));
            if ($this->isNewRecord) {
                $this->device_status_id = 1;
                $this->date_reciept = date('Y-m-d G:i:s');
                $this->date_modify = date('Y-m-d G:i:s');                
                $this->pa = 1;
                $this->user_id = Yii::app()->user->id;
            }
            else {
                $this->date_modify = date('Y-m-d G:i:s');
                if ($this->device_status_id == 7) $this->date_release = date('Y-m-d G:i:s');
            }
            return true;
        } else {
            return false;
        }
    }

    protected function afterSave() {
        $acc_ids = $_POST['Orders']['Accessories']['Checkbox'];
        $acc_title = $_POST['Orders']['Accessories']['Title'];
        if (!$this->isNewRecord) {
            OrdersAccessories::model()->deleteAll('order_id =' . $this->id);
        }
        foreach ($acc_ids as $k => $a_id) {
            //echo $k.' - '.$a_id. ' - ' .  $this->id . ' - '.$acc_title[$k].'<br/>'; 
            $acc = new OrdersAccessories;
            $acc->order_id = $this->id;
            $acc->accessory_id = $a_id;
            $acc->title = $acc_title[$k];
            $acc->save();
        }                
        
        return true;
    }

    protected function afterFind() {
        parent::afterFind();
    }

    public function behaviors() {
        return array('EAdvancedArBehavior' => array(
                'class' => 'application.extensions.EAdvancedArBehavior'));
    }

}
