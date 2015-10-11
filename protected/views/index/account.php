<?php
/**
 * File: account.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 15/10/5 00:17
 * Description:
 */
?>
<div class="raw">
    <div class="col-md-6 hidden-768">
        <div class="panel panel-default">
            <div class="panel-heading">您好，<?php echo $this->user->nickname; ?></div>
            <div class="panel-body">
                <p>登录名：<?php echo $this->user->username; ?></p>
                <?php if (in_array($service->status, array(0, 3)) && ($service->traffic - $service->left > 0)) { ?>
                    <p>服务地址：<?php echo $this->user->server; ?>:<?php echo $this->user->port; ?></p>
                    <p>PAC地址：<?php echo $service->pac; ?></p>
                    <p>
                        BAK地址：<?php echo str_replace(array('.pac', 'pac'), array('.bak', 'chrome'), $service->pac); ?></p>
                <?php } ?>
                <hr/>
                <p>
                    最近登录时间：<?php echo $this->user->last_login_time ? date('Y-m-d H:i:s', $this->user->last_login_time) : ''; ?></p>

                <p>最近登录IP：<?php echo $this->user->last_login_ip ? $this->user->last_login_ip : ''; ?></p>

                <p>注册时间：<?php echo date('Y-m-d H:i:s', $this->user->sign_up_time); ?></p>

                <p>注册IP：<?php echo $this->user->sign_up_ip; ?></p>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">修改密码</div>
            <div class="panel-body">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'htmlOptions' => array(
                        'class' => 'form-horizontal'
                    ),
                )); ?>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'oldPassword', array('class' => 'col-xs-4 col-sm-3 col-md-3 control-label')); ?>
                    <div class="col-xs-8 col-sm-7 col-md-7">
                        <?php echo $form->passwordField($model, 'oldPassword', array('class' => 'form-control')) ?>
                        <?php echo $form->error($model, 'oldPassword'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'password', array('class' => 'col-xs-4 col-sm-3 col-md-3 control-label')); ?>
                    <div class="col-xs-8 col-sm-7 col-md-7">
                        <?php echo $form->passwordField($model, 'password', array('class' => 'form-control')) ?>
                        <?php echo $form->error($model, 'password'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'confirm', array('class' => 'col-xs-4 col-sm-3 col-md-3 control-label')); ?>
                    <div class="col-xs-8 col-sm-7 col-md-7">
                        <?php echo $form->passwordField($model, 'confirm', array('class' => 'form-control')) ?>
                        <?php echo $form->error($model, 'confirm'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-8 col-sm-offset-8 col-xs-offset-7 col-xs-3 col-sm-2 col-md-2">
                        <?php echo CHtml::submitButton('确认', array('class' => 'btn btn-outline btn-primary')) ?>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>