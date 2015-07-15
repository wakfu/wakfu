<?php
/**
 * File: index.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 15/6/7 13:33
 * Description: 
 */
?>

<div class="panel panel-default">
    <div class="panel-heading">登 录</div>
    <div class="panel-body">
        <?php $form = $this->beginWidget('CActiveForm',array(
            'htmlOptions' => array(
                'class' => 'form-horizontal'
            ),
        ));?>
        <div class="form-group">
            <?php echo $form->labelEx($model,'username',array('class'=>'col-xs-3 col-sm-2 col-md-2 control-label')); ?>
            <div class="col-xs-9 col-sm-8 col-md-8">
                <?php echo $form->textField($model,'username',array('class' => 'form-control'))?>
                <?php echo $form->error($model,'username');?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'password',array('class'=>'col-xs-3 col-sm-2 col-md-2 control-label')); ?>
            <div class="col-xs-9 col-sm-8 col-md-8">
                <?php echo $form->passwordField($model,'password',array('class' => 'form-control'))?>
                <?php echo $form->error($model,'password');?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-md-offset-2 col-xs-4 col-sm-4 col-md-4">
                <div class="checkbox">
                    <label>
                        <?php echo $form->checkBox($model,'remember'); ?>记住我
                    </label>
                </div>
            </div>
            <div class="col-xs-3 col-sm-2 col-md-2">
                <?php echo CHtml::submitButton('进入',array('class' => 'btn btn-outline btn-primary')); ?>
            </div>
            
            <div class="col-xs-3 col-sm-2 col-md-2">
                <?php echo CHtml::link('注册',$this->createUrl('index/register'),array('class' => 'btn btn-outline btn-primary'))?>
            </div>
        </div>
        <?php $this->endWidget();?>
    </div>
</div>