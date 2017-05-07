<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pots".
 *
 * @property int $id
 * @property string $name
 * @property int $plant_config_id
 *
 * @property Commands[] $commands
 * @property PiPot[] $piPots
 * @property PlantConfigs $plantConfig
 * @property SensorData[] $sensorDatas
 */
class Pots extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pots';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'plant_config_id'], 'required'],
            [['plant_config_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['plant_config_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlantConfigs::className(), 'targetAttribute' => ['plant_config_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'plant_config_id' => 'Plant Config ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommands()
    {
        return $this->hasMany(Commands::className(), ['pot_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPiPots()
    {
        return $this->hasMany(PiPot::className(), ['pot_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlantConfig()
    {
        return $this->hasOne(PlantConfigs::className(), ['id' => 'plant_config_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSensorDatas()
    {
        return $this->hasMany(SensorData::className(), ['pot_id' => 'id']);
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentity($id) 
    {
        return self::findOne($id);
    }
}
