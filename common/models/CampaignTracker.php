<?php

namespace common\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "{{%campaign_tracker}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $uuid
 * @property string $code
 * @property integer $total_view
 * @property integer $created_at
 * @property integer $updated_at
 */
class CampaignTracker extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%campaign_tracker}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'total_view', 'created_at', 'updated_at'], 'integer'],
            [['uuid', 'code', 'created_at', 'updated_at'], 'required'],
            [['uuid'], 'string', 'max' => 121],
            [['code'], 'string', 'max' => 11]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'uuid' => Yii::t('app', 'Uuid'),
            'code' => Yii::t('app', 'Code'),
            'total_view' => Yii::t('app', 'Total View'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return CampaignTrackerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CampaignTrackerQuery(get_called_class());
    }

    public static function uniqueByCode($code)
    {
        return self::find()->select('uuid')->where(['code'=>$code])->groupBy(['uuid'])->count();
    }

    public static function GenerateMinusDays($duration,$currentIntegerDate = null)
    {
        $date = date_create();
        $current = date_format($date,'Y-m-d H:i:s');
        while($duration > 0)
        {
            $temp[]= date('d-m-Y', strtotime($current. ' - '.($duration-1).' days'));
            $duration = $duration -1;
        }
        return $temp;
    }

    public static function ViewUniqueByDuration($duration,$code)
    {
        $sql ="SELECT FROM_UNIXTIME(created_at,'%d-%m-%Y') as START,`code`,
                COUNT(`uuid`) as views,DATE_SUB(NOW(), INTERVAL ".$duration." DAY) AS LAST30
                from `campaign_tracker` where FROM_UNIXTIME(created_at)
                BETWEEN  DATE_SUB(NOW(), INTERVAL ".$duration." DAY) AND DATE_SUB(NOW(), INTERVAL 0 DAY)
                AND `code` = '".$code."'
                GROUP BY START
                ORDER BY `created_at`";

        $results = Yii::$app->db->createCommand($sql)->queryAll();

        $final = [];
        $days = self::GenerateMinusDays($duration);
        foreach($days as $day)
        {
//            $a = explode('-',$day);
//            $final[$a[0].'/'.$a[1]] = '0';
            $final[$day] = '0';
            foreach($results as $item )
            {

                if($item['START'] === $day)
                {

//                    $final[$a[0].'/'.$a[1]] = $item['views'];
                    $final[$day] = $item['views'];
                    break;
                }

            }

        }
        return $final;
    }

    public static function ViewDailyByDuration($duration,$code)
    {
        $sql ="SELECT FROM_UNIXTIME(created_at,'%d-%m-%Y') as START,`code`,SUM(`total_view`) as views,`user_id`,
                `uuid`,DATE_SUB(NOW(), INTERVAL ".$duration." DAY) AS LAST30 from `campaign_tracker`
                where FROM_UNIXTIME(created_at) BETWEEN  DATE_SUB(NOW(), INTERVAL ". $duration." DAY) AND DATE_SUB(NOW(), INTERVAL 0 DAY)
                AND `code` = '".$code."'
                GROUP BY START
                ORDER BY `created_at`";

        $results = Yii::$app->db->createCommand($sql)->queryAll();

        $final = [];
        $days = self::GenerateMinusDays($duration);
        foreach($days as $day)
        {
//            $a = explode('-',$day);
//            $final[$a[0].'/'.$a[1]] = '0';
            $final[$day] = '0';
            foreach($results as $item )
            {

                if($item['START'] === $day)
                {

//                    $final[$a[0].'/'.$a[1]] = $item['views'];
                    $final[$day] = $item['views'];
                    break;
                }

            }

        }
        return $final;
    }

    public static function totalView($code)
    {
        $sql ="SELECT sum(`total_view`) as total  from `campaign_tracker` where `code` = '".$code."' ";
        $total = Yii::$app->db->createCommand($sql)->queryScalar();
        return $total;
    }

    public static function totalUnique($code)
    {
        $total = (new Query())->select('uuid')->from('campaign_tracker')->where(['code'=>$code])->groupBy('uuid')->count();
        return $total;
    }

}
