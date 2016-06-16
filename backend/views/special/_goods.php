<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

?>

<div class="modal fade bs-example-modal-lg" tabindex="-1" id="addGoods" role="dialog"
     aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">

        <div class="modal-content"><br>

            <div class="row">
                <div class="integral-search text-center">
                    <form id="w2" class="form-inline" action="?" method="get">
                        <div class="form-group">
                            <label class="control-label" for="goods-service_name">商品名</label>
                            <input type="text" id="goods-service_name" class="form-control" name="service_name">
                        </div>
                        <button type="button" id="goodsSearch" class="btn btn-primary">搜索</button>
                        <button type="reset" class="btn btn-default">清空</button>
                    </form>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="table-responsive col-sm-8 col-sm-offset-2" style="overflow-y: scroll; height: 500px;">
                    <table class="table table-hover" id="goodsTable">
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class="form-group text-center">
                <?= Html::button('确定', ['class' => 'btn btn-primary', 'id' => 'checkButton', 'data-dismiss' => 'modal']) ?>
                <?= Html::button('取消', ['class' => 'btn btn-white col-sm-offset-1', 'data-dismiss' => 'modal']) ?>
            </div>
            <br>
        </div>

    </div>
</div>
