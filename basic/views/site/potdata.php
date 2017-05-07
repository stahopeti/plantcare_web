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
   use yii\grid\GridView;
   use yii\data\ActiveDataProvider;
   
   $this->title = 'Pot data';
  // $this->params['breadcrumbs'][] = $this->title;
   $usr = MyUser::findIdentity(Yii::$app->user->getId());
   $userPi = UserPi::findByUserIdentity($usr->getId());
   $pi = Pis::findIdentity($userPi->getPiId());
   $piPot = PiPot::findByPiId($pi->id);
   $pot = Pots::findIdentity($piPot->pot_id);
   
   $plantConfig = PlantConfigs::findIdentity($pot->plant_config_id);
   //$sensorData = ;
   
   //$query = SensorData::findAll(['pot_id'=>$pot->getId()]);
   
   $dataProvider = new ActiveDataProvider([
    'query' => SensorData::findByPotId($pot->getId()),
    'pagination' => [
        'pageSize' => 20,
    ],
]);
?>

<h3><?= Html::encode($this->title)?></h3>

<h2>Plant config</h2>
<?= Html::encode($plantConfig->getPlantName() 
        . ' Temperature: ' . $plantConfig->getReqTemp()   
        . ' Light: ' . $plantConfig->getReqLight()
        . ' Moisture: ' . $plantConfig->getReqMoist()
        )?>

<h2>Sensor data</h2>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
]); ?>