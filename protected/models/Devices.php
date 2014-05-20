<?php
/**
 * This is the model class for table "devices".
 *
 * The followings are the available columns in table 'devices':
 * @property integer $id
 * @property string $title
 * @property integer $pa
 * @property integer $devices_type_id
 * @property integer $devices_brand_id
 */
class Devices extends CActiveRecord
{   
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{devices}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('title','unique','message'=>'Такой телефон уже уществует'), 
			array('devices_type_id, devices_brand_id', 'required'),
			array('pa, devices_type_id, devices_brand_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, pa, devices_type_id, devices_brand_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'Brand' => array(self::BELONGS_TO, 'DevicesBrand', 'devices_brand_id'),
                    'Type' => array(self::BELONGS_TO, 'DevicesType', 'devices_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'pa' => 'Pa',
			'devices_type_id' => 'Devices Type',
			'devices_brand_id' => 'Devices Brand',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('pa',$this->pa);
                $criteria->with = array('Brand');
                $criteria->compare('Brand.title', $this->Brand, true);
		$criteria->compare('devices_type_id',$this->devices_type_id);
		$criteria->compare('devices_brand_id',$this->devices_brand_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Devices the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public static function allBrandsOfTypes($type) { 
            $obj=self::model()->findAllbyAttributes(array('devices_type_id'=>$type));
            return $obj;  
        }
        
        public static function allModelsOfTypesNBrands($type,$brand) {
            $obj=self::model()->findAllbyAttributes(array('devices_type_id'=>$type,'devices_brand_id'=>$brand));
            return $obj;  
        }
        
}
