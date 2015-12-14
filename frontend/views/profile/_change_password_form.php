<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/5/15
 * Time: 3:29 PM
 */
use yii\bootstrap\ActiveForm;

?>
<?php $form = ActiveForm::begin([
    'layout'=>'horizontal',
    'action'=>['change-password']

])?>
    <?=$form->field($model,'id')->hiddenInput()->label(false)?>
    <?=$form->field($model,'password')->passwordInput()?>
    <?=$form->field($model,'confirmPassword')->passwordInput()->label('Confirm Password')?>
    <button type="reset" class="btn-u btn-u-default">Cancel</button>
    <button type="submit" class="btn-u">Save Changes</button>
<?php ActiveForm::end();?>
