<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pi_pot".
 *
 * @property int $id
 * @property int $pi_id
 * @property int $pot_id
 *
 * @property Pis $pi
 * @property Pots $pot
 */
class PiPot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pi_pot';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pi_id', 'pot_id'], 'required'],
            [['pi_id', 'pot_id'], 'integer'],
            [['pi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pis::className(), 'targetAttribute' => ['pi_id' => 'id']],
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
            'pi_id' => 'Pi ID',
            'pot_id' => 'Pot ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPi()
    {
        return $this->hasOne(Pis::className(), ['id' => 'pi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPot()
    {
        return $this->hasOne(Pots::className(), ['id' => 'pot_id']);
    }

    public function getId(){
        return $this->id;
    }
    
    public function getPiId(){
        return $this->pi_id;
    }
    
    public function getPotId(){
        return $this->pot_id;
    }

    public static function findByPiId($pi_id){
        return self::findOne(['pi_id'=>$pi_id]);
    }
    
    public static function findIdentity($id) {
        return self::findOne($id);
    }
}
