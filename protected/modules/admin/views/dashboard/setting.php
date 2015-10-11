<?php
/**
 * File: setting.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 15/6/3 10:39
 * Description:
 */
$this->cs->registerScript('setting', "
$('#form').on('click', 'a', function(){
    $.post($(this).attr('href'), $('#form').serialize(), function(m){
        $.facebox(m.info);
        if(m.status == 200){
            $.get($('#form').attr('action'),function(m){
                $('#content').html(m);
            });
        }
    });
    return false;
});
");
$this->cs->registerCss('break', "
td{word-break:break-all;}
");
?>
<div class="panel panel-default">
    <div class="panel-heading">配置</div>
    <div class="panel-body">
        <?php $form = $this->beginWidget('CActiveForm', [
            'id' => 'form',
            'action' => $this->createUrl('dashboard/setting'),
            'htmlOptions' => [
                'class' => 'form-inline'
            ]
        ]);
        ?>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'section', ['class' => 'sr-only control-label']); ?>
            <?php echo $form->textField($model, 'section', ['class' => 'form-control', 'placeholder' => '节点']) ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'name', ['class' => 'sr-only control-label']); ?>
            <?php echo $form->textField($model, 'name', ['class' => 'form-control', 'placeholder' => '键']) ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'value', ['class' => 'sr-only control-label']); ?>
            <?php echo $form->textField($model, 'value', ['class' => 'form-control', 'placeholder' => '值']) ?>
        </div>
        <div class="form-group">
            <?php echo CHtml::submitButton('搜索', ['class' => 'btn btn-default']); ?>
            <?php echo CHtml::link('添加', $this->createUrl('dashboard/setting', ['operationType' => 'add']), ['class' => 'btn btn-default', 'title' => '添加']); ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
    <table class="table table-hover" id="table">
        <thead>
        <tr>
            <td width="10%">节点</td>
            <td width="10%">键</td>
            <td>值</td>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="3">
                <?php $this->widget('RedLinkPager', ['pages' => $pager]) ?>
            </td>
        </tr>
        </tfoot>
        <tbody>
        <?php $this->widget('red.zii.widget.RedListView', [
            'dataProvider' => $data,
            'itemView' => 'settingList',
            'template' => '{items}',
            'emptyText' => '',
        ]); ?>
        </tbody>
    </table>
</div>