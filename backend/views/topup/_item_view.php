<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/17/15
 * Time: 12:55 PM
 */

use yii\helpers\Html;

/* @var $model common\models\Package */
?>

    <style>
        .price-active, .pricing:hover {
            margin-top: 0px;
        }
    </style>

    <div class="col-lg-3" style="padding-bottom: 25px;box-shadow: 0 0 10px #b5b5b5;padding-top: 15px">

        <div class="row">
            <div class="col-lg-12">
                <?=Yii::$app->controller->renderPartial('_template',['model'=>$model,'backgroundColor'=>'#29abe2'])?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="text-align: center;">
                <?= Html::a(Yii::t('app', 'View'), ['view','id'=>$model->id], ['class' => 'btn btn-info']) ?>
                <?= Html::a(Yii::t('app', 'Update'), ['update','id'=>$model->id], ['class' => 'btn btn-warning']) ?>
            </div>
        </div>
    </div>


