<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
   use app\models\MyUser;
use yii\helpers\Html;
use yii\bootstrap\Nav;
   use yii\bootstrap\Modal;
use yii\widgets\DetailView;
use app\models\Pots;
use app\models\SensorData;
use app\models\DashboardPotData;
use app\models\Pis;
use app\models\UserPi;

    $user = MyUser::findIdentity(Yii::$app->user->getId());
    $usr_pi = UserPi::findByUserIdentity($user->id);
    $pi = Pis::findIdentity($usr_pi->pi_id);
    
    $session = Yii::$app->session;
    $potId = $session->set('pi_id', $pi->id);
?>

<div class="site-index">
    <div class="jumbotron">
        <h1>Welcome back <?= Yii::$app->user->identity->username ?></h1>
        <p class="lead">Your pots:</p>
    </div>
    <span class="create-update-button">
        <?= Html::button('Add new pot', ['value'=>Url::to('index.php?r=pots/create'), 'class' => 'btn btn-success', 'id' => 'modalButtonPots']) ?>
    </span>
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

<?php 
    Modal::begin([
        'header' => '<h4>Pot</h4>',
        'id' => 'modalPots',
        'size' => 'modal-lg',
    ]);
    echo "<div id='modalContentPots'></div>";
    Modal::end();
?>