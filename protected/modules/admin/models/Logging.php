<?php

/**
 * This is the model class for table "logging".
 *
 * The followings are the available columns in table 'logging':
 * @property integer $id
 * @property integer $user_id
 * @property string $username
 * @property string $request
 * @property string $param
 * @property string $type
 * @property string $controller
 * @property string $action
 * @property integer $time
 * @property string $date
 * @property string $ip
 */
class Logging extends RedActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'logging';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['user_id, username, request, type, controller, action, time, date, ip', 'required'],
            ['user_id, time', 'numerical', 'integerOnly' => true],
            ['username', 'length', 'max' => 20],
            ['request', 'length', 'max' => 255],
            ['type, date', 'length', 'max' => 10],
            ['controller, action', 'length', 'max' => 50],
            ['ip', 'length', 'max' => 15],
            ['param', 'safe'],
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            ['id, user_id, username, request, param, type, controller, action, time, date, ip', 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return [];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User',
            'username' => 'Username',
            'request' => 'Request',
            'param' => 'Param',
            'type' => 'Type',
            'controller' => 'Controller',
            'action' => 'Action',
            'time' => 'Time',
            'date' => 'Date',
            'ip' => 'Ip',
        ];
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('request', $this->request, true);
        $criteria->compare('param', $this->param, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('controller', $this->controller, true);
        $criteria->compare('action', $this->action, true);
        $criteria->compare('time', $this->time);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('ip', $this->ip, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Logging the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
