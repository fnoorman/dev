<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/19/15
 * Time: 11:16 AM
 */
/* @var $this yii\web\View */
/* @var $package common\models\Package */
use common\assets\ProfileUnifyAsset;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


$this->params['active']=['trynow'];

ProfileUnifyAsset::register($this);
?>

<div class="col-md-9">
    <div class="profile-body">
        <div class="row bottom-margin-10">
           <div class="col-md-12">
               <div class="row">
                   <div class="col-md-12">
                       <div class="alert alert-success fade in margin-bottom-40">
                           <h2>Welcome to Hybrizy!
                               <br>
                               <small>
                                   Thank you for taking the oppurtunity to try out our product. Please make sure the information is correct before you proceed with our trial product for
                                    <strong style="color: red"><?=$package->duration?></strong> days.
                                   <br>
                                   You will be given <strong style="color: red"> <?=$package->maxAllowedCode?> hybrizy</strong> code and <strong style="color: red"><?=$package->maxCallOut?> of call-outs</strong>
                                   <br>
                                   that be use within the trial period
                               </small>
                           </h2>
                       </div>
                   </div>
               </div>
               <div class="row">
                   <div class="col-lg-12">
                       <div class="headline">
                           <h2>Personal Information</h2>

                       </div>
                   </div>
               </div>
               <div class="row">
                   <div class="col-lg-6">
                       <?php $form = ActiveForm::begin();?>
                            <?= $form->field($model,'firstname')->label('First Name')?>
                            <?= $form->field($model,'lastname')->label('Last Name')?>
                            <?= $form->field($model,'email')?>
                       <div class="form-group">
                           <?= Html::submitButton('Proceed with Trial', ['class' => 'btn btn-success' ]) ?>
                       </div>

                       <?php ActiveForm::end();?>
                   </div>
               </div>
           </div>

        </div>
    </div>
</div>

