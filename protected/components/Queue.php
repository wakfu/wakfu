<?php
/**
 * File: Queue.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 15/6/8 23:13
 * Description: 
 */
class Queue{

    private static $accessKey = 'IiAg4okR7GZWM1QCRUSI8SsvpVt5zDlJ';
    private static $queue = null;
    private static $concurrenceQueue = null;

    public static function enqueue($task, $concurrence = false){
        if($concurrence){
            if(self::$concurrenceQueue == null){
                self::$concurrenceQueue = Yii::app()->concurrenceQueue;
            }
            return (self::$concurrenceQueue->addTask($task) && self::$concurrenceQueue->push());
        }else{
            if(self::$queue == null){
                self::$queue = Yii::app()->queue;
            }
            return (self::$queue->addTask($task) && self::$queue->push());
        }
    }

    public static function createTask($url, $uid){
        return array(
            'url' => $url,
            'postdata' => 'uid='.$uid.'&accessKey='.self::$accessKey
        );
    }
}