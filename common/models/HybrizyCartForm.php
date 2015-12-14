<?php

namespace common\models;

use yii\base\Model;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for cart".
 *
 * @property integer $id
 * @property string $modelClass
 * @property string $data
 * @property double $total
 * @property integer $created_at
 * @property integer $quantity
 * @property integer $created_by
 */
class HybrizyCartForm extends Model
{

    public $modelClass;
    public $quantity = 1;
    private $_count;        // Total quantity
    private $_totalPrice;   // Total price
    private $_price;
    public $id;
    private $_cartDisplayItems = [];

    private $_cart = [];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['modelClass', 'id','quantity'], 'required'],
            [['modelClass'], 'string'],
            [['quantity', 'id'], 'integer',]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'modelClass' => Yii::t('app', 'Model Class'),
            'quantity' => Yii::t('app', 'Quantity'),

        ];
    }


    public static function loadSession($key,$serializeData=true)
    {
//        if(!Yii::$app->session->isActive)
//        {
//            Yii::$app->session->open();
//        }
        if(Yii::$app->session->has($key)){
            return $serializeData ?  unserialize(Yii::$app->session->get($key)): Yii::$app->session->get($key);
        }
        else{
            return false;
        }
    }

    protected function isLoggedIn()
    {
        return Yii::$app->user->isGuest ? false : Yii::$app->user->id;
    }

    protected function stringClassByName($name)
    {
        return (strpos($name,'\\') == false) ? \Yii::$app->params['coreModel'] .$this->modelClass: $name;
    }

    public function processItem()
    {
        if($this->validate())
        {
            // Load class
            //$obj = $this->stringClassByName($this->modelClass);
            //$item = $obj::findOne($this->id);
            $item = $this->getObject();
            $this->_price = $item->price;
            $this->_totalPrice = $this->quantity * $this->_price;
            return [
                'name'=>$item->name,
                'modelClass'=>$this->modelClass,
                'price'=> $this->_price,
                'total'=> $this->_totalPrice,
                'details'=>$item->cartDetail()
            ];
        }
        else
        {
            return false;
        }
    }

    public function getObject()
    {
        $obj = $this->stringClassByName($this->modelClass);
        return $obj::findOne($this->id);
    }

    public function AddToCart($fromSession = true)
    {
        //if($fromSession)
        if(count($this->_cart) == 0)
            $this->_cart = $this->loadSession('Hybrizy');
        $item = $this->processItem();

        if($item == false){             // Item is error
            return [];
        }
        else
        {
            $itemName = $this->modelClass.'-'.$this->id;
            if($this->_cart == false){   // There is no Hybrizy index
                $item['count'] = $this->quantity;
                $this->_cart = ['data'=> [], 'grandTotal'=> $this->_price * $this->quantity , 'totalCount'=> $this->quantity];
                $this->_cart['data'][$itemName] = $item;
            }
            else // There is $itemName index
            {
                if(array_key_exists($itemName,$this->_cart['data']))
                {

                    $temp = $this->_cart['data'][$itemName];
//                    if($temp['price'] === "0.00"){
                    $item = $this->getObject();
                    if(!self::canAddToCart($item,$temp['count']))
                    {
                        return null;
                    }
                    $temp['count'] = $temp['count'] + $this->quantity;
                    $this->_cart['data'][$itemName] = $temp;


                }
                else // index $itemName does not exist
                {
                    $item['count'] = $this->quantity;
                    $this->_cart['data'][$itemName] = $item;
                }

                $this->_cart['grandTotal'] = $this->_cart['grandTotal'] + $this->_totalPrice;
                $this->_cart['totalCount'] = $this->_cart['totalCount'] + $this->quantity;
            }
        }
    }

    public function resetSession()
    {
        Yii::$app->session->remove('Hybrizy');
    }

    public function resetUserDb()
    {
        $db = Yii::$app->db;
        $id = Yii::$app->user->id;
        $rs = $db->createCommand()->update('user',['cart' => null],['id'=>$id])->execute();
    }

    public static function canAddToCart($objName,$current)
    {
        return $objName->limitBy !== $current ? true: false;
    }

    public function getResult()
    {
        return $this->_cart;
    }

    public function saveSession()
    {
        Yii::$app->session->set('Hybrizy',serialize($this->_cart));
    }

    public function loadFromTable()
    {
        $db = Yii::$app->db;
        $id = Yii::$app->user->id;
        $rs = $db->createCommand('SELECT cart FROM user where id=:id')->bindValue(':id',$id)->queryOne();
        return ($rs === false) ? false: unserialize($rs['cart']);
    }

    public function saveTodb()
    {
        $db = Yii::$app->db;
        $id = Yii::$app->user->id;
        $rs = $db->createCommand()->update('user',['cart' => serialize($this->_cart)],['id'=>$id])->execute();
    }

    public function dumpSessionToDb($reverse = false)
    {
        if(!$reverse){ // not reverse
            $this->_cart = $this->loadFromTable();
            $fromSessionDb = $this->loadSession('Hybrizy');
        }
        else // if reverse
        {
            $this->_cart = $this->loadSession('Hybrizy');
            $fromSessionDb = $this->loadFromTable();
        }

        //Loop each index
        if(($this->_cart !== false)){ // if there is cart in session
            if(($fromSessionDb !== false)){ // if there is cart in user's table
                foreach($fromSessionDb['data'] as $key => $value)
                {
                    $id = explode('-',$key)[1];
                    $modelClass = $value['modelClass'];
                    $quantity = $value['count'];
                    $this->attributes = ['id'=>$id,'modelClass'=>$modelClass,'quantity'=>$quantity];
                    $this->AddToCart(!$reverse); // set False if from session to db else set true
                }
            }
            if($reverse)
            {
                $this->saveTodb();
                $this->saveSession();
            }
            else
            {
                $this->saveTodb();
            }

        }
        else // No cart in session
        {
            if($reverse)
            {
                if(($fromSessionDb !== false)){ // if there is cart in user's table
                    foreach($fromSessionDb['data'] as $key => $value)
                    {
                        $id = explode('-',$key)[1];
                        $modelClass = $value['modelClass'];
                        $quantity = $value['count'];
                        $this->attributes = ['id'=>$id,'modelClass'=>$modelClass,'quantity'=>$quantity];
                        $this->AddToCart(!$reverse); // set False if from session to db else set true
                        $this->saveSession();
                    }
                }

            }

        }
    }

    public function removeFromSession()
    {
        $this->_cart = $this->loadSession('Hybrizy');
        if($this->_cart !== false){ // by this point attributes should have been loaded
            $itemToDelete = $this->modelClass.'-'.$this->id;
            if(ArrayHelper::keyExists($itemToDelete,$this->_cart['data']))
            {
                if($this->_cart['data'][$itemToDelete]['count'] == 1)// if the item is the last in the array
                {
                    $temp = $this->_cart['data'][$itemToDelete];
                    $this->_cart['grandTotal'] = $this->_cart['grandTotal'] - ($temp['price']*$this->quantity);
                    $this->_cart['totalCount'] = $this->_cart['totalCount'] - $this->quantity;
                    unset($this->_cart['data'][$itemToDelete]);
                }
                else
                {
                    $temp = $this->_cart['data'][$itemToDelete];
                    $temp['count'] = $temp['count'] - $this->quantity;
                    $this->_cart['data'][$itemToDelete] = $temp;
                    $this->_cart['grandTotal'] = $this->_cart['grandTotal'] - ($temp['price']*$this->quantity);
                    $this->_cart['totalCount'] = $this->_cart['totalCount'] - $this->quantity;
                }
            }
        }

    }

    public function setCart($value)
    {
        $this->_cart = $value;
    }

}
