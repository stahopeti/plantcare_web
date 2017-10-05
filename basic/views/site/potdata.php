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
   use yii\helpers\ArrayHelper;
   
   $this->title = 'Pot data';
   $usr = MyUser::findIdentity(Yii::$app->user->getId());
   $userPi = UserPi::findByUserIdentity($usr->getId());
   $pi = Pis::findIdentity($userPi->getPiId());
   $piPot = PiPot::findByPiId($pi->id);
   $pot = Pots::findIdentity($piPot->pot_id);
   $plantConfig = PlantConfigs::findIdentity($pot->plant_config_id);
   
   
   $dataProvider = new ActiveDataProvider([
    'query' => SensorData::findByPotIdLastDay($pot->getId()),
    'pagination' => [
        'pageSize' => 50,
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

<?= Html::button('Create command', ['value'=>Url::to('index.php?r=command/create'), 'class' => 'btn btn-success', 'id' => 'modalButton', 'pot_id' => $pot->getId()]) ?>
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


<?php 
    use scotthuangzl\googlechart\GoogleChart;
    
    $lastDaysData = new ActiveDataProvider([
        'query' => SensorData::findByPotIdLastDay($pot->getId()),
        'sort' => [
            'defaultOrder' => [
                'timestamp' => SORT_DESC,
            ]
        ],
    ]);/*
    $dataInArray = ArrayHelper::toArray($lastDaysData, [
        'app\models\SensorData' => [
            'Timestamp',
            'Light'
        ],
    ]);
    $timestamps = array('asd', 1);
    $sunlights = array('asd2', 2);
    
    if(!empty($lastDaysData)){
        foreach($lastDaysData as $sensorData){
            $timestamps[] = $sensorData->getTimeStamp();
            $sunlights[] = $sensorData->getLight();
        }
    }
    
    echo GoogleChart::widget(array('visualization' => 'LineChart',
                'data' => array(
                    array('Task', 'Hours per Day'),
                    $timestamps,
                    $sunlights
                ),
                'options' => array('title' => 'Light condition of last day')));
 */
    use sjaakp\gcharts\LineChart;
       
    echo LineChart::widget([
        'height' => '400px',
        'dataProvider' => $lastDaysData,
        'columns' => [
            'timestamp:date',
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
                
            'hAxis' => [ 'title' => 'Timestamp'],
            'lineWidth' => '3',
            'series' => [
                0 => [ 'color' => '#e2431e', ]
            ]
        ],
    ]);
    echo LineChart::widget([
        'height' => '400px',
        'dataProvider' => $lastDaysData,
        'columns' => [
            'timestamp:date',
            'moisture'
        ],
        'options' => [
            'title' => 'Moisture condition of last day',
            'vAxis' => [ 'title' => 'Moisture'],
            'hAxis' => [ 'title' => 'Timestamp'],
        ],
    ]);
?>

<?php 
    Modal::begin([
        'header' => '<h4>Command</h4>',
        'id' => 'modal',
        'size' => 'modal-lg',
    ]);
    echo "<div id='modalContent'></div>";
    Modal::end();
?>