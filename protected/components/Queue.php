<?php

/**
 * File: Queue.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 15/6/8 23:13
 * Description:
 */
class Queue
{

    private static $accessKey = null;
    private static $queue = null;
    private static $concurrenceQueue = null;

    public static function enqueue($task, $concurrence = false)
    {
        if ($concurrence) {
            if (self::$concurrenceQueue == null) {
                self::$concurrenceQueue = Yii::app()->concurrenceQueue;
            }
            return (self::$concurrenceQueue->addTask($task) && self::$concurrenceQueue->push());
        } else {
            if (self::$queue == null) {
                self::$queue = Yii::app()->queue;
            }
            return (self::$queue->addTask($task) && self::$queue->push());
        }
    }

    public static function createTask($url, $uid, $postAction = false)
    {
        if (empty(self::$accessKey)) {
            self::$accessKey = Yii::app()->params['secretKey'];
        }
        return [
            'url' => $url,
            'postdata' => 'uid=' . $uid . '&accessKey=' . self::$accessKey . ($postAction ? '&postAction=' . $postAction : '')
        ];
    }

    public static function apiCreate($uid)
    {
        $url = Yii::app()->createUrl('api/create');
        $task = Queue::createTask($url, $uid, 'api/pac');
        Queue::enqueue($task);
    }

    public static function apiReset($uid)
    {
        $url = Yii::app()->createurl('api/reset');
        $task = Queue::createTask($url, $uid, 'api/close');
        Queue::enqueue($task);
    }
}