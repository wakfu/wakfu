<?php
/**
 * File: edit.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 14/11/28 00:35
 * Description: 更新用户
 */
$this->cs->registerScript('assign', "
var role = '" . $this->createUrl('auth/assignRole') . "';
var group = '" . $this->createUrl('auth/assignGroup') . "';
var userId = " . $model->id . ";

$('.check-role').on('change',function(){
    $.get(role, {user:userId,auth:$(this).val()}, function(m){
        if(m.status){
            $.facebox(m.info);
        }
    });
});
$('.check-group').on('change',function(){
    $.get(group, {user:userId,auth:$(this).val()}, function(m){
        if(m.status){
            $.facebox(m.info);
        }
    });
});

");
?>
<div class="panel panel-default">
    <div class="panel-heading">编辑</div>
    <div class="panel-body">
        <?php $form = $this->beginWidget('CActiveForm', [
            'id' => 'form',
            'action' => $this->createUrl('user/edit'),
            'htmlOptions' => [
                'class' => 'form-horizontal'
            ]
        ]); ?>
        <?php echo $form->hiddenField($model, 'id'); ?>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'username', ['class' => 'col-xs-2 col-sm-2 col-md-2 control-label']); ?>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <?php echo $form->textField($model, 'username', ['class' => 'form-control', 'disabled' => 'disabled']) ?>
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
            <?php echo CHtml::label('用户组', false, ['class' => 'col-xs-2 col-sm-2 col-md-2 control-label']); ?>
            <div class="col-xs-6 col-sm-6 col-md-6" style="padding-top: 7px;">
                <?php foreach ($groupList as $key => $item) { ?>
                    <?php echo $item->getAttribute('name'); ?>
                    <?php echo CHtml::checkBox('', in_array($item->getAttribute('id'), $group),
                        ['class' => 'check-group', 'value' => $item->getAttribute('id')]); ?>
                <?php } ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo CHtml::label('角色', false, ['class' => 'col-xs-2 col-sm-2 col-md-2 control-label']); ?>
            <div class="col-xs-6 col-sm-6 col-md-6" style="padding-top: 7px;">
                <?php foreach ($roleList as $key => $item) { ?>
                    <?php echo $item->getAttribute('name'); ?>
                    <?php echo CHtml::checkBox('', in_array($item->getAttribute('id'), $role),
                        ['class' => 'check-role', 'value' => $item->getAttribute('id')]); ?>
                <?php } ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-1 col-sm-1 col-md-1 col-xs-offset-2 col-sm-offset-2 col-md-offset-2">
                <div class="checkbox">
                    <label>
                        <?php echo $form->checkBox($model, 'state'); ?>
                        <?php echo $form->label($model, 'state', ['style' => 'padding-left:0']); ?>
                    </label>
                </div>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2">
                <div class="checkbox">
                    <label>
                        <?php echo $form->checkBox($model, 'approved'); ?>
                        <?php echo $form->label($model, 'approved', ['style' => 'padding-left:0']); ?>
                    </label>
                </div>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1">
                <?php echo CHtml::submitButton('提交', ['class' => 'btn btn-default']); ?>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1">
                <?php echo CHtml::resetButton('重置', ['class' => 'btn btn-default']); ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>