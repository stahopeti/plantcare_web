<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pots';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pots-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pots', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'plant_config_id',
            'sunrise',
            'sunset',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
