<?php
/**
 * File: billing.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 15/10/9 21:53
 * Description: 
 */
?>
<div class="raw">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="panel panel-default">
            <table class="table table-hover" id="table">
                <thead>
                <tr>
                    <td>邮箱</td>
                    <td>账单日期</td>
                    <td>账单流量</td>
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
                    'itemView' => 'billingList',
                    'template' => '{items}',
                    'emptyText' => '',
                ]); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
