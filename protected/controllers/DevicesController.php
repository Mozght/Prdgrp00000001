<?php

class DevicesController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
                'actions' => array('index', 'view','create', 'update','FindBrands', 'FindModels'),
                'users' => array('@'),
                'roles' => array('acceptor'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'FindBrands', 'FindModels'),
                'users' => array('@'),
                'roles' => array('acceptor'),
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
        $model = new Devices;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Devices'])) {
            $model->attributes = $_POST['Devices'];
            if ($model->save())
                $this->redirect(array('index', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Devices'])) {
            $model->attributes = $_POST['Devices'];
            if ($model->save())
                $this->redirect(array('index', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new Devices('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Devices']))
            $model->attributes = $_GET['Devices'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionFindBrands() {
        $query = array('devices_type_id'=>(int) $_POST['devices_type_id']);
        $criteria = new CDbCriteria(array('order'=>'Brand.title','group'=>'Brand.title'));
        $data = Devices::model()->with('Brand')->findAllbyAttributes($query, $criteria);        
        $data = CHtml::listData($data, 'devices_brand_id', 'Brand.title');
        $x = 0;
        foreach ($data as $value => $name) {
            if ($x==0) echo CHtml::tag('option', array('value' => 0), 'Выбрать Брэнд', true);    
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
            $x++;
        }
    }
    
    public function actionFindModels() {
        $query = array('devices_brand_id'=> (int) $_POST['devices_brand_id'], 'devices_type_id'=> (int) $_POST['devices_type_id']);
        $criteria = new CDbCriteria(array('order'=>'title'));
        $data = Devices::model()->findAllbyAttributes($query, $criteria);        
        $data = CHtml::listData($data, 'id', 'title');
        $x = 0;
        foreach ($data as $value => $name) {
            if ($x==0) echo CHtml::tag('option', array('value' => 0), 'Выбрать Модель', true);    
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
            $x++;
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Devices the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Devices::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Devices $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'devices-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
