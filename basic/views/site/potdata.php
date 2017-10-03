<?php
   /* @var $this yii\web\View */
   use yii\helpers\Html;
   use app\models\MyUser;
   use app\models\UserPi;
   use app\models\Pis;
   use app\models\Pots;
   use app\models\PiPot;
   use app\models\PlantConfigs;
   use app\models\SensorData;
   use app\models\Command;
   use yii\grid\GridView;
   use yii\data\ActiveDataProvider;
   use yii\bootstrap\Modal;
   use yii\helpers\Url;
   
   $this->title = 'Pot data';
   $usr = MyUser::findIdentity(Yii::$app->user->getId());
   $userPi = UserPi::findByUserIdentity($usr->getId());
   $pi = Pis::findIdentity($userPi->getPiId());
   $piPot = PiPot::findByPiId($pi->id);
   $pot = Pots::findIdentity($piPot->pot_id);
   $plantConfig = PlantConfigs::findIdentity($pot->plant_config_id);
   
   $dataProvider = new ActiveDataProvider([
    'query' => SensorData::findByPotId($pot->getId()),
    'pagination' => [
        'pageSize' => 20,
    ],
]);
?>
<h3><?= Html::encode($this->title)?></h3>
<span> <b>Plant config:</b> </span>
<?= Html::encode($plantConfig->getPlantName() 
        . ' Temperature: ' . $plantConfig->getReqTemp()   
        . ' Light: ' . $plantConfig->getReqLight()
        . ' Moisture: ' . $plantConfig->getReqMoist()
        )?>

<h2>Sensor data</h2>
<?= GridView::widget([ 'dataProvider' => $dataProvider, ]); ?>

<?= Html::button('Create command', ['value'=>Url::to('index.php?r=command/create'), 'class' => 'btn btn-success', 'id' => 'modalButton', 'pot_id' => $pot->getId()]) ?>
<?php 
    Modal::begin([
        'header' => '<h4>Command</h4>',
        'id' => 'modal',
        'size' => 'modal-lg',
    ]);
    echo "<div id='modalContent'></div>";
    Modal::end();
?>