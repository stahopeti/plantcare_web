<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Plant Configs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plant-configs-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Plant Configs', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'plant_code',
            'plant_name',
            'req_temp',
            'req_moist',
            // 'req_light',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
