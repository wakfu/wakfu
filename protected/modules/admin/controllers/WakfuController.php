<?php

/**
 * File: WakfuController.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 15/5/29 18:49
 * Description:
 */
class WakfuController extends Controller
{

    public function getActions()
    {
        return [
            'service', 'traffic', 'pac',
            'switch', 'reset', 'purchase',
            'statistics'
        ];
    }

    public function createSearchCriteria($data = [])
    {
        $condition = '';
        $params = [];
        if (!empty($data)) {
            $con = [];
            foreach ($data as $key => $value) {
                if (empty($value)) continue;
                $con[] = $key . '=:' . $key;
                $params[$key] = $value;
            }
            $condition = join(' AND ', $con);
        }
        return ['condition' => $condition, 'params' => $params];
    }

    public function getStatusDisplay($status)
    {
        $display = ['正常', '欠费', '禁用', '幸存'];
        return $display[$status];
    }
}