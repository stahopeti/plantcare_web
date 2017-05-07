<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pis".
 *
 * @property int $id
 * @property string $name
 * @property string $mac_address
 *
 * @property PiPot[] $piPots
 * @property UserPi[] $userPis
 */
class Pis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'mac_address'], 'required'],
            [['name', 'mac_address'], 'string', 'max' => 255],
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
            'mac_address' => 'Mac Address',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPiPots()
    {
        return $this->hasMany(PiPot::className(), ['pi_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPis()
    {
        return $this->hasMany(UserPi::className(), ['pi_id' => 'id']);
    }
    
    public static function findIdentity($id) {
        return self::findOne($id);
    }
}
