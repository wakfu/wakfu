<?php
/**
 * File: register.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 14/11/28 00:35
 * Description: 注册用户
 */
?>
<div class="panel panel-default">
    <div class="panel-heading">注册</div>
    <div class="panel-body">
        <?php $form = $this->beginWidget('CActiveForm', [
            'id' => 'form',
            'action' => $this->createUrl('user/register'),
            'htmlOptions' => [
                'class' => 'form-horizontal'
            ]
        ]); ?>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'username', ['class' => 'col-xs-2 col-sm-2 col-md-2 control-label']); ?>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <?php echo $form->textField($model, 'username', ['class' => 'form-control']) ?>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2"><?php echo $form->error($model, 'username'); ?></div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'realname', ['class' => 'col-xs-2 col-sm-2 col-md-2 control-label']); ?>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <?php echo $form->textField($model, 'realname', ['class' => 'form-control']) ?>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2"><?php echo $form->error($model, 'realname'); ?></div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'nickname', ['class' => 'col-xs-2 col-sm-2 col-md-2 control-label']); ?>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <?php echo $form->textField($model, 'nickname', ['class' => 'form-control']) ?>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2"><?php echo $form->error($model, 'nickname'); ?></div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'email', ['class' => 'col-xs-2 col-sm-2 col-md-2 control-label']); ?>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <?php echo $form->textField($model, 'email', ['class' => 'form-control']) ?>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2"><?php echo $form->error($model, 'email'); ?></div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'password', ['class' => 'col-xs-2 col-sm-2 col-md-2 control-label']); ?>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <?php echo $form->passwordField($model, 'password', ['class' => 'form-control']) ?>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2"><?php echo $form->error($model, 'password'); ?></div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'confirm', ['class' => 'col-xs-2 col-sm-2 col-md-2 control-label']); ?>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <?php echo $form->passwordField($model, 'confirm', ['class' => 'form-control']) ?>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2"><?php echo $form->error($model, 'confirm'); ?></div>
        </div>
        <div class="form-group">
            <div class="col-xs-1 col-sm-1 col-md-1 col-xs-offset-4 col-sm-offset-4 col-md-offset-4">
                <?php echo CHtml::submitButton('注册', ['class' => 'btn btn-default']); ?>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1">
                <?php echo CHtml::resetButton('重置', ['class' => 'btn btn-default']); ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>