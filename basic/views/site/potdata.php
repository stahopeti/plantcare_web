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
   use yii\bootstrap\Modal;
   use yii\helpers\Url;
   
   $this->title = 'Pot data';
   $usr = MyUser::findIdentity(Yii::$app->user->getId());
   $userPi = UserPi::findByUserIdentity($usr->getId());
   $pi = Pis::findIdentity($userPi->getPiId());
   $piPot = PiPot::findByPiId($pi->id);
   $pot = Pots::findIdentity($piPot->pot_id);
   $plantConfig = PlantConfigs::findIdentity($pot->plant_config_id);
   $potId = $pot->id;
   $plantConfigId = $plantConfig->id;
   
   $session = Yii::$app->session;
   if(!$session->isActive){
       $session->open();
   }
   $session->set('selected_pot_id', $pot->getId());
   
   $dataProvider = new ActiveDataProvider([
    'query' => SensorData::findByPotIdLastWeek($pot->getId()),
    'pagination' => [
        'pageSize' => 20,
    ],
    'sort' => [
        'defaultOrder' => [
            'timestamp' => SORT_DESC,
        ]
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

<div class="create-update-pot-related-div">
    <span class="create-update-button"><?= Html::button('Create command', ['value'=>Url::to('index.php?r=command/create'), 'class' => 'btn btn-success', 'id' => 'modalButtonCommand']) ?></span>
    <span class="create-update-button"><?= Html::button('Change plant config', ['value'=>Url::to('index.php?r=plant-configs/create'), 'class' => 'btn btn-success', 'id' => 'modalButtonPlantConfigs']) ?></span>
    <span class="create-update-button"><?= Html::button('Change pot settings', ['value'=>Url::to('index.php?r=pots/update&id='.$potId), 'class' => 'btn btn-success', 'id' => 'modalButtonPots']) ?></span>
</div>

<h2>Sensor data</h2>
<?= GridView::widget([ 
    'dataProvider' => $dataProvider, 
    'columns' => [
        'timestamp',
        'temperature',
        'light',
        'moisture',
    ],
    ]); ?>


<?php use sjaakp\gcharts\LineChart;

    $lineChartData = new ActiveDataProvider([
        'query' => SensorData::findByPotIdLastWeek($pot->getId()),
        'pagination' => false,
        'sort' => [
            'defaultOrder' => [
                'timestamp' => SORT_NATURAL,
            ]
        ],
    ]);
       
    echo LineChart::widget([
        'height' => '400px',
        'dataProvider' => $lineChartData,
        'columns' => [
            'timestamp:datetime',
            'light'
        ],
        'options' => [
            'title' => 'Light condition of last day',
            'vAxis' => [ 
                'title' => 'Minutes of 10 minute',
                'titleTextStyle' => [
                'color' => '#FF0000'
                    ],
                ],
            'explorer' => [ 
                'axis' => 'horizontal'
                ],
            'lineWidth' => '3',
            'series' => [
                0 => [ 'color' => '#e2431e', ]
            ]
        ],
    ]);
    
    echo LineChart::widget([
        'height' => '400px',
        'dataProvider' => $lineChartData,
        'columns' => [
            'timestamp:datetime',
            'moisture'
        ],
        'options' => [
            'title' => 'Moisture condition of last day',
            'vAxis' => [ 'title' => 'Moisture'],
            'explorer' => [ 
                'axis' => 'horizontal',
                'maxZoomIn' => '.5',
                'maxZoomOut' => '4'
                ],
        ],
    ]);
?>

<?php 
    Modal::begin([
        'header' => '<h4>Command</h4>',
        'id' => 'modalCommand',
        'size' => 'modal-lg',
    ]);
    echo "<div id='modalContentCommand'></div>";
    Modal::end();
?>

<?php 
    Modal::begin([
        'header' => '<h4>PlantConfig</h4>',
        'id' => 'modalPlantConfigs',
        'size' => 'modal-lg',
    ]);
    echo "<div id='modalContentPlantConfigs'></div>";
    Modal::end();
?>

<?php 
    Modal::begin([
        'header' => '<h4>Pot</h4>',
        'id' => 'modalPots',
        'size' => 'modal-lg',
    ]);
    echo "<div id='modalContentPots'></div>";
    Modal::end();
?>