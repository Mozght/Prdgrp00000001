<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $group_id
 * @property string $title
 * @property string $email
 * @property string $phone
 * @property string $description
 * @property integer $pa
 */
class Users extends CActiveRecord
{
        const ROLE_ADM = 'admin';
        const ROLE_ENG = 'engineer';
        const ROLE_ACC = 'acceptor';
        const ROLE_GUE = 'guest';

	public function tableName()
	{
		return '{{users}}';
	}

	public function rules()
	{
		return array(
			array('pa', 'numerical', 'integerOnly'=>true),
			array('username, phone', 'length', 'max'=>45),
			array('group_id, password', 'length', 'max'=>256),
			array('email', 'length', 'max'=>128),
			array('title, description', 'safe'),
			array('id, username, password, group_id, title, email, phone, description, pa', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
                    
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'group_id' => 'Group',
			'title' => 'Title',
			'email' => 'Email',
			'phone' => 'Phone',
			'description' => 'Description',
			'pa' => 'Pa',
		);
	}

	public function search()
	{

		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('pa',$this->pa);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
        }
        
        public static function all() {
            $users = CHtml::listData(self::model()->findAll(),'id','title');
            foreach ($users as $index => $data) {
                if ($index == Yii::app()->user->id) {
                    unset($users[$index]);
                }
            }
            return $users;
        }
}
