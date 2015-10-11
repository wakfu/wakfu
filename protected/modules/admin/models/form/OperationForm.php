<?php

/**
 * File: OperationForm.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 15/5/8 16:37
 * Description: 操作表单
 */
class OperationForm extends CFormModel
{
    public $id;
    public $name;
    public $description;
    public $module;
    public $controller;
    public $action;
    public $status;
    public $sort;

    public function rules()
    {
        $labels = $this->attributeLabels();
        return [
            ['name', 'required', 'message' => '请输入' . $labels['name']],
            ['module', 'required', 'message' => '请输入' . $labels['module']],
            ['controller', 'required', 'message' => '请输入' . $labels['controller']],
            ['action', 'required', 'message' => '请输入' . $labels['action']],
            ['id, status, sort', 'numerical', 'integerOnly' => true],
            ['description', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '名称',
            'description' => '描述',
            'module' => '模块',
            'controller' => '控制器',
            'action' => '执行器',
            'status' => '不在菜单显示',
            'sort' => '显示权值'
        ];
    }

    public function save()
    {

        try {
            if ($this->id) {
                $model = Operation::model()->findByPk($this->id);
                if (empty($model)) throw new CDbException('参数出错', 1, []);
            } else {
                $model = new Operation();
            }

            $model->attributes = [
                'name' => $this->name,
                'description' => $this->description,
                'module' => $this->module,
                'controller' => $this->controller,
                'action' => $this->action,
                'status' => $this->status,
                'sort' => $this->sort,
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