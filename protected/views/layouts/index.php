<?php
/**
 * File: index.php
 * User: daijianhao(toruneko@outlook.com)
 * Date: 15/6/7 18:26
 * Description:
 */
$this->beginContent('/layouts/master');
?>
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="jumbotron hidden-1000">
                    <h1>夸父</h1>

                    <p>生命短暂，注册即用。</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6"><?php echo $content; ?></div>
        </div>
    </div>
<?php $this->endContent(); ?>