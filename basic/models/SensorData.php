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
 * @property int $blinder_on
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
            [['pot_id', 'timestamp', 'temperature', 'moisture', 'light', 'blinder_on', 'watertank_empty', 'connection_down'], 'required'],
            [['pot_id', 'blinder_on', 'watertank_empty', 'connection_down'], 'integer'],
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
            'blinder_on' => 'Blinder On',
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
    
    public function findByPotIdAll($pot_id){
        return self::findByCondition(['pot_id'=>$pot_id])->asArray();
    }
    
    public function findByPotIdLastDay($pot_id){
        return self::findByCondition(['pot_id'=>$pot_id])->where(
		"cast(TIMESTAMP as date) = cast(NOW() as date)")->asArray();
    }
    
    public function findByPotIdLastWeek($pot_id){
        return self::findByCondition(['pot_id'=>$pot_id])->where(
		"cast(TIMESTAMP as date) between date_sub(now(), INTERVAL 1 WEEK) and now()")->asArray();
    }
    
    public function findByPotIdLastMonth($pot_id){
        return self::findByCondition(['pot_id'=>$pot_id])->where(
		"cast(TIMESTAMP as date) between date_sub(now(), INTERVAL 1 MONTH) and now()")->asArray();
    }
}
