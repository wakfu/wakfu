<?php
/**
 * File: user.php
 * User: daijianhao@zhubajie.com
 * Date: 14-8-18 11:47
 * Description:
 */
?>
<div class="panel panel-default">
    <div class="panel-heading">用户</div>
    <div class="panel-body">
        <?php $form = $this->beginWidget('CActiveForm', [
            'id' => 'form',
            'method' => 'get',
            'action' => $this->createUrl('user/account'),
            'htmlOptions' => [
                'class' => 'form-inline'
            ]
        ]);
        ?>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'id', ['class' => 'sr-only control-label']); ?>
            <?php echo $form->textField($model, 'id', ['class' => 'form-control', 'placeholder' => '用户ID']) ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'username', ['class' => 'sr-only control-label']); ?>
            <?php echo $form->textField($model, 'username', ['class' => 'form-control', 'placeholder' => '用户名']) ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'realname', ['class' => 'sr-only control-label']); ?>
            <?php echo $form->textField($model, 'realname', ['class' => 'form-control', 'placeholder' => '姓名']) ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'nickname', ['class' => 'sr-only control-label']); ?>
            <?php echo $form->textField($model, 'nickname', ['class' => 'form-control', 'placeholder' => '昵称']) ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'email', ['class' => 'sr-only control-label']); ?>
            <?php echo $form->textField($model, 'email', ['class' => 'form-control', 'placeholder' => '邮箱']) ?>
        </div>
        <div class="form-group">
            <?php echo CHtml::submitButton('搜索', ['class' => 'btn btn-default']); ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
    <table class="table table-hover" id="table">
        <thead>
        <tr>
            <td>ID</td>
            <td>用户名</td>
            <td>实名</td>
            <td>昵称</td>
            <td>邮箱</td>
            <!--<td>登录/注册时间</td>-->
            <!--<td>登录/注册IP地址</td>-->
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
            'itemView' => 'accountList',
            'template' => '{items}',
            'emptyText' => '',
        ]); ?>
        </tbody>
    </table>
</div>