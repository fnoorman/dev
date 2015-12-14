<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/20/15
 * Time: 7:29 PM
 */

/* @var $this yii\web\View */
use common\assets\ProfileUnifyAsset;
use drsdre\wizardwidget\WizardWidget;
use common\widgets\Alert;

ProfileUnifyAsset::register($this);
$this->params['active']=[];
?>
<style>
    .tab-content .tab-pane {
        padding-left: 20px;
        padding-right: 20px;
    }

    .wizard .nav-tabs {
        margin-top: 0;
    }
</style>
<?php
$wizard_config = [
    'id' => 'stepwizard',
    'steps' => [
        1 => [
            'title' => 'Step 1',
            'icon' => 'glyphicon glyphicon-shopping-cart',
            'content' => Yii::$app->controller->renderPartial('_cart_items',['cart'=>$cart]),
            'buttons' => [
                'next' => [
                    'title' => 'Proceed to billing',
                    'options' => [
                        'class' => 'btn btn-u '
                    ],
                ],
            ],
        ],
        2 => [
            'title' => 'Step 2',
            'icon' => 'glyphicon glyphicon-credit-card',
            'content' => isset($cart['data'])? Yii::$app->controller->renderPartial('@frontend/views/profile/_payment_form',['model'=>$order]):'',
            'buttons' => [
                'next' => [
                    'title' => 'Proceed to Payment Method',

                    'options' => [
                        'class' => 'btn btn-u ',
                    ],
                ],
            ],
        ],
        3 => [
            'title' => 'Step 3',
            'icon' => 'glyphicon glyphicon-transfer',
            'content'=>isset($cart['data'])? Yii::$app->controller->renderPartial('_mol_pay_processing',['form'=>$form]):'',
            'buttons'=>[
                'next' =>[
                    'title'=>'Pay Now !!!',
                    'options'=>['class'=>'btn btn-u btn-success','type'=>'submit','id'=>'MOLPayStep']
                ]
            ]

        ],
        4 => [
            'title' => 'Step 4',
            'icon' => 'glyphicon glyphicon-ok',
//            'content'=>Yii::$app->controller->renderPartial('_mol_pay_processing',['form'=>$form])
            'content' => 'Step 4',
        ],
    ],
//    'complete_content' => "You are done!", // Optional final screen
    'start_step' => $step, // Optional, start with a specific step
];
?>
<div class="col-md-9">
    <div class="profile-body">
        <div class="row">
            <div class="col-md-12">
                <div class="headline">
                    <h2>Checkout</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="headline">
                    <?=Alert::widget()?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= WizardWidget::widget($wizard_config); ?>
            </div>
        </div>

    </div>
</div>

