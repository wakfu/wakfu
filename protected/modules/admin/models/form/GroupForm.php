<?php

/**
 * File: GroupForm.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 15/5/9 00:15
 * Description:
 */
class GroupForm extends CFormModel
{
    public $id;
    public $name;
    public $description;
    public $status;

    public $module;
    public $controller;
    public $action;
    public $sort;

    public function rules()
    {
        $labels = $this->attributeLabels();
        return [
            ['name', 'required', 'message' => '请输入' . $labels['name']],
            ['id, status', 'numerical', 'integerOnly' => true],
            ['description, module, controller, action, sort', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '名称',
            'description' => '描述',
            'status' => '禁用',
        ];
    }

    public function save()
    {

        try {
            if ($this->id) {
                $model = Group::model()->findByPk($this->id);
                if (empty($model)) throw new CDbException('参数出错', 1, []);
            } else {
                $model = new Group();
            }

            $model->attributes = [
                'name' => $this->name,
                'description' => $this->description,
                'status' => $this->status
            ];

            if ($model->save() === false)
                throw new CDbException('更新用户出错', 2, $model->getErrors());

        } catch (CDbException $e) {
            $this->addErrors($e->errorInfo);
            return false;
        }

        return true;
    }
}