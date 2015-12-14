<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/23/15
 * Time: 6:24 PM
 */

namespace frontend\models;

use common\models\Messages;
use Yii;
use yii\base\Model;
use common\models\User;

class CodeMemberForm extends Model
{

    public $auth_item_name;
    public $codeBank_code;
    public $email;
    public $invitee;

    public function rules()
    {
        return [
            [['codeBank_code','auth_item_name','email'],'required'],
            ['email','email'],
            ['email','checkEmail'],
            [['auth_item_name'], 'string', 'max' => 64],
            [['codeBank_code'], 'string', 'max' => 19]
        ];
    }

    public function checkEmail($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $exist = User::findByEmail($this->email);
            if(!$exist)
                $this->addError($attribute, 'Sorry the user\'s email doesn\'t exists !!!');
            else
                $this->invitee = $exist;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'auth_item_name' => Yii::t('app', 'Role'),
            'email' => Yii::t('app', 'User\'s Email'),
            'codeBank_code' => Yii::t('app', 'Code'),
        ];
    }

    public function saveToMessage()
    {
        $message = new Messages();
        $message->loadDefaultValues();
        $message->from = Yii::$app->user->identity->id;
        $message->user_id = $this->invitee->id;
        $message->messageType =1;
        $message->save();
        $message->content = Yii::$app->controller->renderPartial('_invite_message',[
            'code'=>$this->codeBank_code,
            'username'=>$this->invitee->username,
            'role'=>$this->auth_item_name,
            'user_id'=>$message->user_id,
            'message_id'=>$message->id
        ]);
        return $message->save();
    }

}