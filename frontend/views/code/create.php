<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CodeMember */

$this->title = Yii::t('app', 'Create Code Member');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Code Members'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="code-member-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
