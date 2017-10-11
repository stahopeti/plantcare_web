<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\widgets\DetailView;
use app\models\Pots;
use app\models\SensorData;
use app\models\DashboardPotData;
?>

<div class="site-index">
    <div class="jumbotron">
        <h1>Welcome back <?= Yii::$app->user->identity->username ?></h1>
        <p class="lead">Your pots:</p>
    </div>
    <?php
    $pots = Pots::findPotsByUserId(1);
    
    function goToPot($potId){
        $session = Yii::$app->session;
        if(!$session->isActive){
            $session->open();
        }
        $session->set('selected_pot_id', $potId);
    }
    
    foreach($pots as $pot)
    {
        $potData = new DashboardPotData($pot->getId());
        $button = [['label' => 'GOTO', 'url' => ['/site/potdata', 'potId' => $pot->getId()]],];
        echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $button,
        ]);
        echo DetailView::widget([
            'model' => $potData,
            'attributes' => [
                [
                    'attribute' => 'Pot name',
                    'value' => $potData->getPotName()
                ],
                [
                    'attribute' => 'Last date',
                    'value' => $potData->getTimestamp()
                ],
                [
                    'attribute' => 'Temperature',
                    'value' => $potData->getTemperature()
                ],
                [
                    'attribute' => 'Light',
                    'value' => $potData->getLight()
                ],
                [
                    'attribute' => 'Moistre',
                    'value' => $potData->getMoisture()
                ],
                [
                    'attribute' => 'Light on',
                    'value' => $potData->getLightOn()
                ],
                [
                    'attribute' => 'Watertank empty',
                    'value' => $potData->getWatertankEmpty()
                ]
            ]
        ]);
    }
    ?>

</div>
