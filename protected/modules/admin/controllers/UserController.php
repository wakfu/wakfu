<?php

/**
 * file:UserController.php
 * author:Toruneko@outlook.com
 * date:2014-7-19
 * desc:用户中心
 */
class UserController extends Controller
{

    public function getActions()
    {
        return ['account', 'register', 'edit'];
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
}
