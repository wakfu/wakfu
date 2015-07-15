<?php
/**
 * File: index.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 15/6/7 18:26
 * Description: 
 */
$this->cs->registerPackage('index');
$this->beginContent('/layouts/main');
?>
<div class="row">
    <div class="col-md-5">
        <div class="jumbotron">
            <h1>夸父</h1>
            <p>生命短暂，注册即用。</p>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-7"><?php echo $content; ?></div>
</div>
<?php $this->endContent(); ?>