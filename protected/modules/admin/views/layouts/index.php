<?php
/**
 * file:index.php
 * author:Toruneko@outlook.com
 * date:2014-7-12
 * desc: 管理区主视图
 */
$this->cs->registerPackage('echarts');
$this->cs->registerPackage('bootstrap');
$this->cs->registerPackage('admin');
$this->cs->registerPackage('facebox');
$this->cs->registerPackage('ztree');
$this->cs->registerPackage('datetimepicker');

$this->cs->registerScript('selfEdit', "
$('.self-edit').on('click',function(){
    $.get($(this).attr('href'),function(m){
        if(m.status){
            $.facebox(m.info);
        }else{
            $('#content').html(m);
        }
    });
    return false;
});
");
$this->cs->registerScript('fraudmetrix', '
(function() {
    _fmOpt = {
        partner: "kf_Qox",
        appName: "kf_Qox_web",
        token: "' . Yii::app()->session->getSessionID() . '"
    };
    var cimg = new Image(1,1);
    cimg.onload = function() {
        _fmOpt.imgLoaded = true;
    };
    cimg.src = "https://fp.fraudmetrix.cn/fp/clear.png?partnerCode=" + _fmOpt.partner + "&appName=" + _fmOpt.appName + "&tokenId=" + _fmOpt.token;
    var fm = document.createElement("script"); fm.type = "text/javascript"; fm.async = true;
    fm.src = ("https:" == document.location.protocol ? "https://" : "http://") + "static.fraudmetrix.cn/fm.js?ver=0.1&t=" + (new Date().getTime()/3600000).toFixed(0);
    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(fm, s);
})();
');
$this->beginContent('/layouts/main');
?>
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" target="_blank"
                   href="<?php echo $this->app->homeUrl; ?>"><?php echo CHtml::encode($this->app->name) ?></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav" id="nav"><?php echo $content; ?></ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="self-edit"
                           href="<?php echo $this->createUrl('account/edit', array('id' => $this->user->getId())); ?>">
                            <?php echo $this->user->getState('nickname'); ?>
                        </a>
                    </li>
                    <li><a href="<?php echo $this->createUrl('account/logout'); ?>">退出</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-2 col-sm-2 col-md-2 sidebar">
                <ul class="nav nav-sidebar" id="menu"></ul>
            </div>
            <div class="col-xs-10 col-sm-10 col-md-10 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 main"
                 id="content"></div>
        </div>
    </div>
<?php $this->endContent(); ?>