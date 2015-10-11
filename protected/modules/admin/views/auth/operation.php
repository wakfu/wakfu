<?php
/**
 * File: editOperation.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 15/5/8 23:17
 * Description:
 */
$form = $this->beginWidget('CActiveForm', [
    'id' => 'form',
    'action' => $this->createUrl('auth/operationEdit'),
    'htmlOptions' => [
        'class' => 'form-horizontal'
    ]
]);
echo $form->hiddenField($model, 'id');
?>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'name', ['class' => 'col-xs-2 col-sm-2 col-md-2 control-label']); ?>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <?php echo $form->textField($model, 'name', ['class' => 'form-control']) ?>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2"><?php echo $form->error($model, 'name'); ?></div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'description', ['class' => 'col-xs-2 col-sm-2 col-md-2 control-label']); ?>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <?php echo $form->textField($model, 'description', ['class' => 'form-control']) ?>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2"><?php echo $form->error($model, 'description'); ?></div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'module', ['class' => 'col-xs-2 col-sm-2 col-md-2 control-label']); ?>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <?php echo $form->textField($model, 'module', ['class' => 'form-control']) ?>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2"><?php echo $form->error($model, 'module'); ?></div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'controller', ['class' => 'col-xs-2 col-sm-2 col-md-2 control-label']); ?>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <?php echo $form->textField($model, 'controller', ['class' => 'form-control']) ?>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2"><?php echo $form->error($model, 'controller'); ?></div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'action', ['class' => 'col-xs-2 col-sm-2 col-md-2 control-label']); ?>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <?php echo $form->textField($model, 'action', ['class' => 'form-control']) ?>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2"><?php echo $form->error($model, 'action'); ?></div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'sort', ['class' => 'col-xs-2 col-sm-2 col-md-2 control-label']); ?>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <?php echo $form->textField($model, 'sort', ['class' => 'form-control']) ?>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2"><?php echo $form->error($model, 'sort'); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 col-sm-3 col-md-3 col-xs-offset-2 col-sm-offset-2 col-md-offset-2">
            <div class="checkbox">
                <label>
                    <?php echo $form->checkBox($model, 'status'); ?>
                    <?php echo $form->label($model, 'status', ['style' => 'padding-left:0']); ?>
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