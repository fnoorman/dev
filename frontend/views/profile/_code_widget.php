<?php
/**
 * Created by PhpStorm.
 * User: Fahmy
 * Date: 11/23/15
 * Time: 1:32 PM
 */

/* @var $this yii\web\View */

use yii\helpers\Html;
use common\models\CampaignTracker;
$odd = 1;
foreach($model as $code)
{
    $total = CampaignTracker::totalView($code->code);
    $unique = CampaignTracker::totalUnique($code->code);

    $color = (($odd % 2) === 0) ? "color-three":"color-two";
    echo Html::beginTag('div',['class'=>"profile-post $color",'style'=>'padding-right:20px']);
        echo Html::tag('span','01',['class'=>'profile-post-numb']);
    echo Html::beginTag('div',['class'=>'profile-post-in']);
    echo Html::beginTag('h3',['class'=>'heading-xs']);
        echo Html::a($code->code,null);
    echo Html::endTag('h3');
    $divId = 'add-'.$code->code.'-member';

    echo '<ul class="list-inline">';
    echo '<li><i class="fa fa-clock-o"></i> '.($unique? $unique:0).'</li>';
    echo '<li>|</li>';
    echo '<li><a href="#"><i class="fa fa-eye"></i> '.($total? $total:0).'</a></li>';
    echo '</ul>';
    echo Html::endTag('div');
    echo Html::endTag('div');
    $odd = $odd + 1;
}


?>

<?php $this->beginBlock('JavascriptInit');?>
<script type="text/javascript">

</script>
<?php $this->endBlock();?>

