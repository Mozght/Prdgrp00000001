<?php
class OrdersController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view', 'update', 'AutoCompleteImei', 'Createpdf', 'OrderView','GetBarcode'),
                'users' => array('@'),
                'roles' => array('acceptor'),
            ),
             array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view','update'),
                'users' => array('@'),
                'roles' => array('engineer'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('delete', 'create'),
                'users' => array('@'),
                'roles' => array('acceptor')
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionAutoCompleteImei() {
        $term = Yii::app()->getRequest()->getParam('term');
        if (Yii::app()->request->isAjaxRequest && $term) {
            $criteria = new CDbCriteria;
            $criteria->addSearchCondition('imei', $term);
            $orders = Orders::model()->findAll($criteria);
            $result = array();
            foreach ($orders as $order) {
                $result[] = array(
                    'value' => $order['imei'],
                );
            }
            echo CJSON::encode($result);
            Yii::app()->end();
        }
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $orders = new Orders;
        $customers = new Customers;
        $images = new Images;
        if (isset($_POST['Orders']) && isset($_POST['Customers'])) {
            $orders->attributes = $_POST['Orders'];
            $customers->attributes = $_POST['Customers'];
            $acc_ids = $_POST['Orders']['Accessories']['Checkbox'];
            $acc_title = $_POST['Orders']['Accessories']['Title'];
            $customers = new Customers;
            $acc = DeviceAccessories::model()->findAllByPk($acc_ids);
            $orders->Accessories = $acc;
            if (empty($orders->device_id)) {
                $device = new Devices;
                $device->title = $_POST['device_model'];
                $device->devices_brand_id = $_POST['devices_brand_id'];
                $device->devices_type_id = $_POST['devices_type_id'];
                $device->pa = 1;
                if($device->save()){                            
                  $orders->device_id = $device->id ;
                }
            }
            if (empty($orders->seller_id)) {
                $seller = new Seller;
                $seller->attributes = $_POST['Seller'];
                $seller->pa = 1;
                $seller->description = 'Проверить';
                if (!empty($seller->title)) {
                    if($seller->save()){                            
                      $orders->seller_id = $seller->id ;
                    }                
                }
            }
            if (empty($orders->customer_id)) {
                if ($customers->save()) {
                    $orders->customer_id = $customers->primaryKey;
                }
            }

            if ($orders->save()) {                
                if (isset($_FILES['images'])) {
                    $images = CUploadedFile::getInstancesByName('images');
                    if (isset($images) && count($images) > 0) {
                        foreach ($images as $image => $pic) {
                            if ($pic->saveAs(Yii::getPathOfAlias('webroot') . '/upload/img/' . $pic->name)) {
                                $img_add = new Images();
                                $img_add->url = $pic->name;
                                $img_add->order_id = $orders->id;
                                $img_add->title = $pic->name;
                                $img_add->pa = 1;
                                $img_add->save(); // DONE
                            } else {
                                echo 'Не удается закачать файл!';
                            }
                        }
                    }
                }
                
                $this->redirect(array('index'));                
            }
                
        }

        $this->render('create', array(
            'orders' => $orders,
            'customers'=>$customers,
        ));
    }

    public function actionUpdate($id) {
        $orders = $this->loadModel($id);
        $customers = Customers::model()->findByPk($orders->customer_id);
        $device = Devices::model()->findByPk($orders->device_id);
        $accessories = DeviceAccessories::model()->findAll();
        $seleceted_accessories = OrdersAccessories::model()->findAllByAttributes(array('order_id'=>$id));
        if (isset($_POST['Orders'])) {
            $orders->attributes = $_POST['Orders'];
            if (Yii::app()->user->role !== 'engineer') {
                $customers->attributes = $_POST['Customers'];
                $acc_ids = $_POST['Orders']['selectedaccessories'];
                $acc = DeviceAccessories::model()->findAllByPk($acc_ids);
                $orders->Accessories = $acc;
            }
            if (empty($orders->customer_id)&& Yii::app()->user->role !== 'engineer') {
                if ($customers->save()) {
                    $orders->customer_id = $customers->primaryKey;
                }
            }
            if ($orders->save())
                if (isset($_FILES['images'])) {
                    $images = CUploadedFile::getInstancesByName('images');
                    if (isset($images) && count($images) > 0) {
                        foreach ($images as $image => $pic) {
                            if ($pic->saveAs(Yii::getPathOfAlias('webroot') . '/upload/img/' . $pic->name)) {
                                $img_add = new Images();
                                $img_add->url = $pic->name;
                                $img_add->order_id = $orders->id;
                                $img_add->title = $pic->name;
                                $img_add->pa = 1;
                                $img_add->save(); // DONE
                            } else {
                                echo 'Не удается закачать файл!';
                            }
                        }
                    }
                }
                $this->redirect(array('index'));
        }

        $this->render('update', array(
            'orders' => $orders,
            'customers' => $customers,
            'device' => $device,
            'accessories' => $accessories,
            'sel_acc'=>$seleceted_accessories,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            $id = Yii::app()->getRequest()->getParam('id');
            $model = $this->loadModel($id);
            $model->pa = 0;
            $model->save();
        } else {
            throw new CHttpException(400, 'Не могу удалить, обратитесь к Администратору');
        }

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $model = new Orders('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Orders']))
            $model->attributes = $_GET['Orders'];
        $criteria = new CDbCriteria;
        $criteria->addcondition('TO_DAYS(t.date_reciept) + 13 < TO_DAYS(NOW())');
        $count = Orders::model()->count($criteria);
        $this->render('index', array(
            'model' => $model,
            'count' => $count,
        ));
    }

    public function actionOrderView($id,$pdf) {
        $order = Orders::model()->with('History')->findByPk($id);
        $acc = OrdersAccessories::model()->with('Title')->findAllByAttributes(array('order_id'=>$id)); 
        return $this->renderPartial('order', array('order' => $order, 'pdf'=>$pdf, 'acc' => $acc),true);  
    }
    
    public function actionGetBarcode($id) {
        return $this->renderPartial('barcode', array('code' => $id),false);  
    }

    public function actionCreatepdf($id) {
        $pdf = new pdfCreator(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        spl_autoload_register(array('YiiBase', 'autoload'));
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Pradagroup');       
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(10, 3 , 10,5);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 
        
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('dejavusans', '', 8, '', true);
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->AddPage();
        $html = $this->actionOrderView($id,$pdf);
        $pdf->writeHTML($html);    
        $pdf->Output('order-'.$id, 'I');
        $pdf->Output(Yii::app()->basePath.'/../upload/order-'.$id.'.pdf', 'F');
    }

    public function loadModel($id) {
        $model = Orders::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'orders-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
