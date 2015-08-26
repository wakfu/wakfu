<?php
use \net\toruneko\wakfu\interfaces\WakfuServiceClient;
/**
 * File: WakfuService.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 15/6/3 11:40
 * Description: 
 */
class WakfuService{

    public function open($ip, $port){
        $client = new WakfuServiceClient(null);
        try{
            Yii::app()->thrift->build($client);
            return $client->open($ip, $port);
        }catch (Exception $e){
            Yii::log($e->getMessage(),CLogger::LEVEL_ERROR);
            return false;
        }
    }

    public function close($ip, $port){
        $client = new WakfuServiceClient(null);
        try{
            Yii::app()->thrift->build($client);
            return $client->close($ip, $port);
        }catch (Exception $e){
            Yii::log($e->getMessage(),CLogger::LEVEL_ERROR);
            return false;
        }
    }

    public function view($ip, $port){
        $client = new WakfuServiceClient(null);
        try{
            Yii::app()->thrift->build($client);
            return $client->view($ip, $port);
        }catch (Exception $e){
            Yii::log($e->getMessage(),CLogger::LEVEL_ERROR);
            return -1;
        }
    }

    public function pac($server, $port, $rules){
        $client = new WakfuServiceClient(null);
        try{
            Yii::app()->thrift->build($client);
            return $client->pac($server, $port, $rules);
        }catch (Exception $e){
            Yii::log($e->getMessage(),CLogger::LEVEL_ERROR);
            return null;
        }
    }

    public function savePort($port){
        $except = Setting::model()->get('wakfu','except');
        $except[] = $port;
        return Setting::model()->set('wakfu','except', $except);
    }

    public function getRandomPort(){
        $except = Setting::model()->get('wakfu','except');
        $port = Setting::model()->get('wakfu','port');
        $list = range($port[0], $port[1]);
        $diffList = array_diff($list, $except);
        shuffle($diffList);
        return array_pop($diffList);
    }

    public function getRandomIp(){
        $server = Setting::model()->get('wakfu','ip');
        shuffle($server);
        return array_pop($server);
    }

    public function getServerByIp($ip){
        $server = Setting::model()->get('wakfu','server');
        if(isset($server[$ip])){
            return $server[$ip];
        }else{
            return $ip;
        }
    }
}