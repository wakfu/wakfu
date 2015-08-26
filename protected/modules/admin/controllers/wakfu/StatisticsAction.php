<?php
/**
 * File: StatisticsAction.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 15/8/13 21:56
 * Description: 
 */
class StatisticsAction extends RedAction{

    public function run(){
        $operationType = $this->request->getQuery('operationType','load');
        if(method_exists($this, $operationType)){
            call_user_func(array($this, $operationType));
        }else{
            $this->load();
        }
    }

    public function load(){
        $this->render('statistics');
    }

    public function traffic(){
        $traffic = Service::model()->sum('traffic');
        $serv1 = Service::model()->findByPk(1);
        $serv2 = Service::model()->findByPk(2);
        $traffic -= ($serv1->traffic + $serv2->traffic);
        $used = Service::model()->sum('left');
        $left = $traffic - $used;

        $this->response(200,'success', array(
            array('name' => '收益', 'value' => array(
                '总额' => round($traffic / 100 / 1024 * 0.8, 2),
                '销售' => round($used / 100 / 1024 * 0.8, 2),
                '库存' => round($left / 100 / 1024 * 0.8, 2)
            )),
            array('name' => '已使用', 'value' => $used / 100),
            array('name' => '未使用', 'value' => $left / 100)
        ));
    }
}