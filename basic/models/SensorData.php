<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sensor_data".
 *
 * @property int $id
 * @property int $pot_id
 * @property string $timestamp
 * @property double $temperature
 * @property double $moisture
 * @property double $light
 * @property int $lamp_on
 * @property int $watertank_empty
 * @property int $connection_down
 *
 * @property Pots $pot
 */
class SensorData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sensor_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pot_id', 'timestamp', 'temperature', 'moisture', 'light', 'lamp_on', 'watertank_empty', 'connection_down'], 'required'],
            [['pot_id', 'lamp_on', 'watertank_empty', 'connection_down'], 'integer'],
            [['timestamp'], 'safe'],
            [['temperature', 'moisture', 'light'], 'number'],
            [['pot_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pots::className(), 'targetAttribute' => ['pot_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pot_id' => 'Pot ID',
            'timestamp' => 'Timestamp',
            'temperature' => 'Temperature',
            'moisture' => 'Moisture',
            'light' => 'Light',
            'lamp_on' => 'Lamp On',
            'watertank_empty' => 'Watertank Empty',
            'connection_down' => 'Connection Down',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPot()
    {
        return $this->hasOne(Pots::className(), ['id' => 'pot_id']);
    }
    
    
    public function getTimeStamp(){
        return $this->timestamp;
    }
    
    public function getLight(){
        return $this->light;
    }
    
    public function getTemperature(){
        return $this->temperature;
    }
    
    public function getMoisture(){
        return $this->moisture;
    }
    
    public function getLightOn(){
        return $this->lamp_on;
    }
    
    public function getWatertankEmpty(){
        return $this->watertank_empty;
    }
    
    public function findByPotIdAll($pot_id){
        return self::findByCondition(['pot_id'=>$pot_id]);
    }
    
    public function findByPotIdLastDay($pot_id){
        return self::findByCondition(['pot_id'=>$pot_id])->andWhere(
		"cast(TIMESTAMP as date) = cast(NOW() as date)");
    }
    
    public function findByPotIdLastWeek($pot_id){
        return self::findByCondition(['pot_id'=>$pot_id])->andWhere(
		"cast(TIMESTAMP as date) between date_sub(now(), INTERVAL 1 WEEK) and now()");
    }
    
    public function findByPotIdLastMonth($pot_id){
        return self::findByCondition(['pot_id'=>$pot_id])->andWhere(
		"cast(TIMESTAMP as date) between date_sub(now(), INTERVAL 1 MONTH) and now()");
    }
    
    public function findByPotIdLastEntry($pot_id){
        return self::findByCondition(['pot_id'=>$pot_id])->orderBy(['id' => SORT_DESC])->one();
        
    }
}
