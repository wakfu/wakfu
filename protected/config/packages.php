<?php
/**
 * file:packages.php
 * author:Toruneko@outlook.com
 * date:2014-7-19
 * desc: assets包
 */
return [
    /*'jquery'=>[
        'js'=>['jquery-1.11.1.min.js'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/jquery',
    ],*/
    'jquery' => [
        'js' => ['jquery.min.js'],
        'baseUrl' => 'http://libs.useso.com/js/jquery/1.11.1',
    ],
    'yii' => [
        'js' => ['jquery.yii.js'],
        'depends' => ['jquery'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/js',
    ],
    'yiitab' => [
        'js' => ['jquery.yiitab.js'],
        'depends' => ['jquery'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/yiitab',
    ],
    'yiiactiveform' => [
        'js' => ['jquery.yiiactiveform.js'],
        'depends' => ['jquery'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/js',
    ],
    'jquery.ui' => [
        'js' => ['jquery-ui.min.js'],
        'depends' => ['jquery'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/jui/js',
    ],
    'bgiframe' => [
        'js' => ['jquery.bgiframe.js'],
        'depends' => ['jquery'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/js',
    ],
    'ajaxqueue' => [
        'js' => ['jquery.ajaxqueue.js'],
        'depends' => ['jquery'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/js',
    ],
    'autocomplete' => [
        'js' => ['jquery.autocomplete.js'],
        'depends' => ['jquery', 'bgiframe', 'ajaxqueue'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/autocomplete',
    ],
    /*'maskedinput'=>[
        'js'=>['jquery.maskedinput.min.js'],
        'depends'=>['jquery'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/js',
    ],*/
    'maskedinput' => [
        'js' => ['jquery.maskedinput.min.js'],
        'depends' => ['jquery'],
        'baseUrl' => 'http://cdn.bootcss.com/jquery.maskedinput/1.3.1',
    ],
    /*'cookie'=>[
        'js'=>['jquery.cookie.js'],
        'depends'=>['jquery'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/js',
    ],*/
    'cookie' => [
        'js' => ['jquery.cookie.min.js'],
        'depends' => ['jquery'],
        'baseUrl' => 'http://cdn.bootcss.com/jquery-cookie/1.4.1',
    ],
    'treeview' => [
        'js' => ['jquery.treeview.js', 'jquery.treeview.edit.js', 'jquery.treeview.async.js'],
        'css' => ['jquery.treeview.css'],
        'depends' => ['jquery', 'cookie'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/treeview',
    ],
    'multifile' => [
        'js' => ['jquery.multifile.js'],
        'depends' => ['jquery'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/js',
    ],
    'rating' => [
        'js' => ['jquery.rating.js'],
        'depends' => ['jquery', 'metadata'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/rating',
    ],
    'metadata' => [
        'js' => ['jquery.metadata.js'],
        'depends' => ['jquery'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/js',
    ],
    /*'bbq'=>[
        'js'=>['jquery.ba-bbq.min.js'],
        'depends'=>['jquery'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/js',
    ],*/
    'bbq' => [
        'js' => ['jquery.ba-bbq.min.js'],
        'depends' => ['jquery'],
        'baseUrl' => 'http://cdn.bootcss.com/jquery.ba-bbq/1.2.1',
    ],
    /*'history'=>[
        'js'=>['jquery.history.js'],
        'depends'=>['jquery'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/js',
    ],*/
    'history' => [
        'js' => ['jquery.history.min.js'],
        'depends' => ['jquery'],
        'baseUrl' => 'http://cdn.bootcss.com/history.js/1.8/bundled/html5',
    ],
    /*'punycode'=>[
        'js'=>['punycode.min.js'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/js',
    ],*/
    'punycode' => [
        'js' => ['punycode.min.js'],
        'baseUrl' => 'http://cdn.bootcss.com/punycode/1.3.1',
    ],
    /*'bootstrap'=>[
        'js'=>['js/bootstrap.min.js'],
        'css'=>['css/bootstrap.min.css'],
        'depends'=>['jquery'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/bootstrap-3.2.0',
    ],*/
    'bootstrap' => [
        'js' => ['js/bootstrap.min.js'],
        'css' => ['css/bootstrap.min.css'],
        'depends' => ['jquery'],
        'baseUrl' => 'http://libs.useso.com/js/bootstrap/3.2.0',
    ],
    'ztree' => [
        'js' => ['js/jquery.ztree.all-3.5.min.js'],
        'css' => ['css/zTreeStyle/zTreeStyle.css'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/zTree_v3',
    ],
    'kindeditor' => [
        'js' => ['kindeditor-min.js', 'lang/zh_CN.js'],
        'css' => ['themes/default/default.css'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/kindeditor-4.1.10'
    ],
    'facebox' => [
        'js' => ['facebox.js'],
        'css' => ['facebox.css'],
        'depends' => ['jquery'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/facebox'
    ],
    'admin' => [
        'js' => ['jquery.admin.js'],
        'css' => ['admin.css'],
        'depends' => ['jquery'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/admin',
    ],
    'prettify' => [
        'js' => ['prettify.min.js'],
        //'css'=>['prettify.min.css'],
        'depends' => ['sunburst'],
        'baseUrl' => 'http://cdn.bootcss.com/prettify/r298',
    ],
    'sunburst' => [
        'css' => ['sunburst.css'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/main',
    ],
    'moment' => [
        'js' => ['moment-with-locales.min.js'],
        'baseUrl' => 'http://cdn.bootcss.com/moment.js/2.10.3',
    ],
    /*'datetimepicker'=>[
        'css'=>['css/bootstrap-datetimepicker.min.css'],
        'js'=>['js/bootstrap-datetimepicker.min.js'],
        'depends'=>['bootstrap','moment'],
        'baseUrl'=>'http://cdn.bootcss.com/bootstrap-datetimepicker/4.7.14',
    ],*/
    'datetimepicker' => [
        'css' => ['css/bootstrap-datetimepicker.min.css'],
        'js' => ['js/bootstrap-datetimepicker.min.js', 'js/locales/bootstrap-datetimepicker.zh-CN.js'],
        'depends' => ['bootstrap', 'moment'],
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/datetimepicker',
    ],
    'index' => [
        'baseUrl' => 'http://wakfu.sinaapp.com/assets/main',
        'depends' => ['bootstrap'],
        'css' => ['index.css'],
    ],
    'echarts' => [
        'js' => ['echarts-all.js'],
        'baseUrl' => 'http://cdn.bootcss.com/echarts/2.2.3'
    ],
];