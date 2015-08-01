<?php
/**
 * File: ApiController.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 15/6/5 10:05
 * Description: 
 */
class ApiController extends RedController{

    private $wakfuService = null;

    public function init(){
        parent::init();

        $this->wakfuService = new WakfuService();
    }

    public function actionCreate(){
        $service = $this->getServiceByUid();
        $this->create($service);
    }

    private function create($service){
        $data = $this->wakfuService->create();
        if(is_array($data)){
            $service->server = $data[0];
            $service->port = $data[1];
            if($service->save()){
                //$this->open($service);
                $this->pac($service);
            }else{
                Yii::log("[".$service->uid."]API::CREATE save failed", CLogger::LEVEL_INFO);
            }
        }else{
            Yii::log("[".$service->uid."]API::CREATE failure", CLogger::LEVEL_INFO);
        }
    }

    public function actionRemove(){
        $service = $this->getServiceByUid();
        $this->remove($service);
    }

    private function remove($service){
        if($this->wakfuService->remove($service->server, $service->port)){
            $service->server = "";
            $service->port = 0;
            $service->pac = "";
            $service->status = 1;
            if(!$service->save()){
                Yii::log("[".$service->uid."]API::REMOVE save failed", CLogger::LEVEL_INFO);
            }
        }else{
            Yii::log("[".$service->uid."]API::REMOVE failure", CLogger::LEVEL_INFO);
        }
    }

    public function actionReset(){
        $service = $this->getServiceByUid();
        $this->reset($service);
    }

    public function reset($service){
        $this->remove($service);
        $this->create($service);
        $this->open($service);
    }

    public function actionOpen(){
        $service = $this->getServiceByUid();
        $this->open($service);
    }

    private function open($service){
        if(in_array($service->status, array(0,3))) return; // 可用状态

        if($this->wakfuService->open($service->server, $service->port)) {
            $service->status = 0; // 启用状态
            if(!$service->save()){
                Yii::log("[".$service->uid."]API::OPEN save failed", CLogger::LEVEL_INFO);
            }
        }else{
            Yii::log("[".$service->uid."]API::OPEN failure", CLogger::LEVEL_INFO);
        }
    }

    public function actionClose(){
        $service = $this->getServiceByUid();
        $this->close($service);
    }

    private function close($service, $status = 2){
        if(in_array($service->status, array(1,2))) return; // 不可用状态

        if($this->wakfuService->close($service->server, $service->port)) {
            $service->status = $status; // 默认禁用状态
            if(!$service->save()){
                Yii::log("[".$service->uid."]API::CLOSE save failed", CLogger::LEVEL_INFO);
            }
        }else{
            Yii::log("[".$service->uid."]API::CLOSE failure", CLogger::LEVEL_INFO);
        }
    }

    public function actionPac(){
        $service = $this->getServiceByUid();
        $this->pac($service);
    }

    private function pac($service){
        $server = $this->wakfuService->getServerByIp($service->server);
        if($service->status == 3){ //幸存模式
            $pac = 'function FindProxyForURL(url, host) { return "SOCKS5 '.$service->server.':'.$service->port.'; SOCKS '.$service->server.':'.$service->port.'" }';
        }else{
            $pac = $this->wakfuService->pac($server, $service->port, $service->rules);
        }
        if(!empty($pac)){
            $storage = new SaeStorage();
            $filename = substr(md5($server.":".$service->port),8,16).'.pac';
            $url = $storage->write('pac', $filename, $pac, -1, array('type' => 'application/x-ns-proxy-autoconfig'));
            if($url != false){
                if($service->pac != $url){
                    $service->pac = $url;
                    if(!$service->save()){
                        Yii::log("[".$service->uid."]API::PAC save failed", CLogger::LEVEL_INFO);
                    }else{
                        $this->createChromeBak($url, $server, $service->port);
                    }
                }

            }else{
                Yii::log("[".$service->uid."]API::PAC write storage fail", CLogger::LEVEL_INFO);
            }
        }else{
            Yii::log("[".$service->uid."]API::PAC failure", CLogger::LEVEL_INFO);
        }
    }

    public function actionView(){
        $service = $this->getServiceByUid();
        $this->view($service);
    }

    private function view($service){
        $traffic = $this->wakfuService->view($service->server, $service->port);
        //Yii::log("[".$service->uid."]API::VIEW Got [".$traffic."]", CLogger::LEVEL_INFO);
        if($traffic > 0){
            /**
             * 返回的是KB。计算单位是MB*100。因此$traffic / 1000 * 100
             */
            $traffic = round($traffic / 10);
            if($traffic >= $service->used){
                $service->left += ($traffic - $service->used);
            }else{
                $service->left += $traffic;
            }
            $service->used = $traffic;
            if($service->traffic - $service->left <= 0) {
                $this->close($service, 1); //欠费状态
            }

            if(!$service->save()){
                Yii::log("[".$service->uid."]API::VIEW save failed", CLogger::LEVEL_INFO);
            }
        }
    }

    public function actionChrome(){
        $service = $this->getServiceByUid();
        $server = $this->wakfuService->getServerByIp($service->server);
        $this->createChromeBak($service->pac, $server, $service->port);
    }

    private function getServiceByUid(){
        $accessKey = $this->request->getPost('accessKey',false);
        if($accessKey != 'IiAg4okR7GZWM1QCRUSI8SsvpVt5zDlJ'){
            Yii::log("[".$accessKey."]API accessKey auth fail", CLogger::LEVEL_INFO);
            Yii::app()->end();
        }

        $uid = $this->request->getPost('uid');
        $service = Service::model()->findByPk($uid);
        if(empty($service)){
            Yii::log("[".$uid."]API UID Not found", CLogger::LEVEL_INFO);
            Yii::app()->end();
        }
        return $service;
    }

    public function actionError(){
        $uid = $this->request->getPost('uid');
        Yii::log('queue error:'.$uid,CLogger::LEVEL_INFO);
    }

    private function createChromeBak($url, $server, $port){
$chrome = <<<STR
{"-confirmDeletion":true,"-downloadInterval":720,"-enableQuickSwitch":false,"-monitorWebRequests":true,"-quickSwitchProfiles":[],"-refreshOnProfileChange":false,"-revertProxyChanges":false,"-showInspectMenu":true,"-startupProfileName":"","schemaVersion":2,"+夸父全局":{"bypassList":[{"conditionType":"BypassCondition","pattern":"<local>"}],"color":"#9d9","fallbackProxy":{"host":"{[:server]}","port":{[:port]},"scheme":"socks5"},"name":"夸父全局","profileType":"FixedProfile","revision":"14ddb379207"},"+夸父智能":{"profileType":"PacProfile","name":"夸父智能","pacScript":"","color":"#d497ee","revision":"14ddc1cefcc","pacUrl":"{[:pacUrl]}"},"-exportLegacyRuleList":true}
STR;
        $chrome = str_replace(array(
            '{[:server]}',
            '{[:port]}',
            '{[:pacUrl]}',
        ),array($server, $port, $url), $chrome);
        $storage = new SaeStorage();
        $filename = substr(md5($server.":".$port),8,16).'.bak';
        $storage->write('chrome', $filename, $chrome);
    }
}