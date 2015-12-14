<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 9/17/15
 * Time: 9:09 PM
 */

namespace common\models;

use yii\base\Model;
use Yii;

class CartForm extends Model
{

    public $objectId;
    public $modelClass;
    public $quantity;
    public $data;
    public $total = 0;
    public $created_by;
    public $created_at;
    protected $_cart =[];
    protected $_session;

    //protected $_quantity = 1;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['modelClass','objectId'], 'required'],
            [['modelClass', 'data'], 'string'],
            [['total'], 'number'],
            [['created_at', 'quantity', 'created_by','objectId'], 'integer']
        ];
    }

    public function AddToCart()
    {

        $modelClass = \Yii::$app->params['coreModel'] .$this->modelClass;
        $result = $modelClass::findOne($this->objectId);
        $sessionId = $this->modelClass.'-'.$this->objectId;
        // load current storage from session
        $this->loadSession();
        if(array_key_exists('data',$this->_cart))
        {
            // check if required sessionId exist in Array
            if(array_key_exists($sessionId,$this->_cart['data']))
            {
                $tempArray = $this->_cart['data'][$sessionId];
                $tempArray['name']= $result->CartTitle();
                $tempArray['count'] = $tempArray['count'] + $this->quantity;
                $tempArray['price'] = $result->price;
                $tempTotal = $result->price * $this->quantity;
                $tempArray['total'] =  $tempArray['total'] + $tempTotal;
                $this->_cart['data'][$sessionId] = $tempArray;
            }
            else{
                $temp = [
                    'name'      => $result->CartTitle(),
                    'count'     =>1,
                    'price'     =>$result->price,
                    'total'     =>$result->price,
                    'modelClass'=>$modelClass::className(),
                ];
                $this->_cart['data'][$sessionId] = $temp;
            }

        }
        else //add if does not exist
        {
            $temp =['data'=>[],'grandTotal'=>0,'totalCount'=>0];
            $temp['data'][$sessionId] = [
                'name'      => $result->CartTitle(),
                'count'     =>1,
                'price'     =>$result->price,
                'total'     =>$result->price,
                'modelClass'=>$modelClass::className(),
            ];
            $this->_cart = $temp;
        }
        if(!array_key_exists('details',$this->_cart['data'][$sessionId]))
        {
            $this->_cart['data'][$sessionId]['details'] = $result->cartDetail();
        }
        $this->_cart['grandTotal'] = $this->_cart['grandTotal'] + ($result->price * $this->quantity);
        $this->_cart['totalCount'] = $this->_cart['totalCount'] + $this->quantity;
        // Save back to session
        //$this->saveSession();

    }

    public function loadSession()
    {
        $this->_session = Yii::$app->session;
        if($this->_session->has('Hybrizy'))
            $this->_cart = unserialize($this->_session->get('Hybrizy'));
    }


    public function saveSession()
    {
        $id = Yii::$app->user->id;
        //if user logged in
        if(!Yii::$app->user->isGuest){
            $command = \Yii::$app->db->createCommand('SELECT cart FROM user where id=:id')->bindParam(':id',$id);
            $result = $command->queryOne();
            // If there is existing cart in user, add to current session
            if($result !== false){
                $cart = unserialize($result['cart']);
                $newCart =[];
                foreach($cart['data'] as $key => $value)
                {
                    $this->objectId = explode('-',$key)[1];
                    $a = explode('\\',$value['modelClass']);
                    $newCart->modelClass = $a[count($a)-1];
//                    $this->modelClass = $value['modelClass'];
                    $this->quantity = $value['count'];
                    $this->AddToCart();
                }
                // Update cart field to the table user with id = $id
                Yii::$app->db->createCommand()->update('user',['cart'=>serialize($this->_cart)],'id ='.$id)->execute();
            }
        }
        else
        {
            $this->_session->set('Hybrizy',serialize($this->_cart));
        }
    }

    public function resetSession()
    {
        Yii::$app->session->remove('Hybrizy');
        if(!Yii::$app->user->isGuest)
        {
            $id = Yii::$app->user->id;
            Yii::$app->db->createCommand()->update('user',['cart'=>null],'id ='.$id)->execute();
        }
    }

    public function getResult()
    {
        return $this->_cart;
    }

    public function setCart($newCart)
    {
        $this->_cart = $newCart;
    }

}
