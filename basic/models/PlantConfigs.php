<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "plant_configs".
 *
 * @property int $id
 * @property string $plant_code
 * @property string $plant_name
 * @property double $req_temp
 * @property double $req_moist
 * @property double $req_light
 *
 * @property Pots[] $pots
 */
class PlantConfigs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plant_configs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['plant_code', 'plant_name', 'req_temp', 'req_moist', 'req_light'], 'required'],
            [['req_temp', 'req_moist', 'req_light'], 'number'],
            [['plant_code', 'plant_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plant_code' => 'Plant Code',
            'plant_name' => 'Plant Name',
            'req_temp' => 'Req Temp',
            'req_moist' => 'Req Moist',
            'req_light' => 'Req Light',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPots()
    {
        return $this->hasMany(Pots::className(), ['plant_config_id' => 'id']);
    }

    public function getPlantName(){
        return $this->plant_name;
    }
    
    public function getReqTemp(){
        return $this->req_temp;
    }
    
    public function getReqMoist(){
        return $this->req_moist;
    }
    
    public function getReqLight(){
        return $this->req_light;
    }
    public static function findIdentity($id) 
    {
        return self::findOne($id);
    }
}
