<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/5/15
 * Time: 12:57 PM
 */



namespace frontend\models;

use common\models\User;
use yii\base\Model;
use yii\bootstrap\Alert;

class ChangePasswordForm extends Model
{
    public $id;
    public $password;
    public $confirmPassword;
    public $success = false;


    public function rules()
    {
        return [
            ['password', 'string', 'min' => 6],
            ['confirmPassword', 'string', 'min' => 6],
            ['confirmPassword','validateConfirmPassword'],
            ['id','integer'],
            [['id','password','confirmPassword'],'required'],
        ];
    }

    public function validateConfirmPassword($attribute, $params)
    {
        if ($this->password !== $this->confirmPassword) {
            $this->addError($attribute, 'Confirm Password is not the same as Password');
        }
    }


    public function save()
    {
        $user = User::findOne($this->id);
        $user->setPassword($this->confirmPassword);
        $this->success  = $user->save();
        return $this->success;
    }

    public function getAlert()
    {
        if($this->success){
            return Alert::widget([
                'options' => [
                    'class' => 'alert-success',
                ],
                'body' => 'Congratulations!!! Your password has been changed...',
            ]);
        }
        else
            return null;

    }

}
