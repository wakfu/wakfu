<?php
/**
 * File: service.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 15/6/3 11:09
 * Description:
 */
?>
<div class="panel panel-default">
    <div class="panel-heading">服务</div>
    <div class="panel-body">
        <?php $form = $this->beginWidget('CActiveForm', [
            'id' => 'form',
            'method' => 'get',
            'action' => $this->createUrl('wakfu/service'),
            'htmlOptions' => [
                'class' => 'form-inline'
            ]
        ]);
        ?>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'uid', ['class' => 'sr-only control-label']); ?>
            <?php echo $form->textField($model, 'uid', ['class' => 'form-control', 'placeholder' => '用户ID']) ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'email', ['class' => 'sr-only control-label']); ?>
            <?php echo $form->textField($model, 'email', ['class' => 'form-control', 'placeholder' => '邮箱']) ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'server', ['class' => 'sr-only control-label']); ?>
            <?php echo $form->textField($model, 'server', ['class' => 'form-control', 'placeholder' => '服务器']) ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'port', ['class' => 'sr-only control-label']); ?>
            <?php echo $form->textField($model, 'port', ['class' => 'form-control', 'placeholder' => '端口']) ?>
        </div>
        <div class="form-group">
            <?php echo CHtml::submitButton('搜索', ['class' => 'btn btn-default']); ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
    <table class="table table-hover" id="table">
        <thead>
        <tr>
            <td>UID</td>
            <td>邮箱</td>
            <td>流量(GB)</td>
            <td>服务器</td>
            <td>端口</td>
            <td>状态</td>
            <td></td>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="7">
                <?php $this->widget('RedLinkPager', ['pages' => $pager]) ?>
            </td>
        </tr>
        </tfoot>
        <tbody>
        <?php $this->widget('red.zii.widget.RedListView', [
            'dataProvider' => $data,
            'itemView' => 'serviceList',
            'template' => '{items}',
            'emptyText' => '',
        ]); ?>
        </tbody>
    </table>
</div>