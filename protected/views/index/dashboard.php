<?php
/**
 * File: dashboard.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 15/6/7 14:49
 * Description:
 */
$this->cs->registerScript('resetButton', "
$('#form').on('click','a',function(){
    alert('并不支持，请联系管理员');
    return false;
});
");
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td class="hidden-1000">邮箱</td>
                        <td>总流量</td>
                        <td>最近使用</td>
                        <td>剩余流量</td>
                        <td class="hidden-600">注册时间</td>
                        <td>服务状态</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="hidden-1000"><?php echo $service->email; ?></td>
                        <td><?php echo number_format($service->traffic / 100000, 2); ?>GB</td>
                        <td><?php echo number_format($service->used / 100000, 2); ?>GB</td>
                        <td><?php echo number_format(($service->traffic - $service->left) / 100000, 2); ?>GB</td>
                        <td class="hidden-600"><?php echo date('Y-m-d H:i:s', $service->getRelated('user')->sign_up_time); ?></td>
                        <td><?php echo $this->getStatusDisplay($service->status); ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php if (in_array($service->status, array(0, 3)) && ($service->traffic - $service->left > 0)) { ?>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'form',
                'htmlOptions' => array(
                    'class' => 'form-horizontal'
                ),
            )); ?>
            <div class="form-group">
                <div class="col-xs-9 col-sm-10 col-md-10">
                    <?php if (empty($service->pac)) { ?>
                        <p class="form-control-static">正在更新...</p>
                    <?php } else { ?>
                        <p class="form-control-static"><?php echo $service->pac; ?></p>
                    <?php } ?>
                </div>
                <div class="col-xs-3 col-sm-2 col-md-2">
                    <?php echo CHtml::link('重置', $this->createUrl('index/reset'), array('class' => 'btn btn-default')); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <?php echo $form->labelEx($service, 'rules', array('class' => 'control-label')); ?>
                    （填写域名[不带www]，多个域名用换行分隔）
                    <?php echo $form->textArea($service, 'rules', array('class' => 'form-control')) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-3 col-sm-3 col-md-2 col-xs-offset-9 col-sm-offset-9 col-md-offset-10">
                    <?php echo CHtml::submitButton('保存', array('class' => 'btn btn-default')); ?>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        </div>
        <div class="col-sm-6 col-md-6 hidden-768">
            <h4>设置帮助(QQ用户交流群：455902676)</h4>

            <p><b>Windows：</b></p>

            <p>Internet选项 -> 连接 -> 局域网设置 -> 使用自动配置脚本 -> 填入PAC地址 -> 确定</p>

            <p><b>Mac OS X：</b></p>

            <p>系统设置 -> 网络 -> 高级 -> 代理 -> 自动代理配置 -> URL中填入PAC地址 -> 好</p>

            <p><b>iOS (iPhone/iPad)：</b></p>

            <p>设置 -> Wi-Fi -> 当前使用的热点 -> 代理设置选择自动 -> 填写PAC地址</p>

            <p><b>Chrome SwitchyOmega：</b></p>

            <p>选项 -> 导入/导出 -> 在线恢复 -> 填写BAK地址 -> 恢复</p>
        </div>
    <?php } ?>
</div>
