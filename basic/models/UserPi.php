<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_pi".
 *
 * @property int $id
 * @property int $user_id
 * @property int $pi_id
 *
 * @property Users $user
 * @property Pis $pi
 */
class UserPi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_pi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'pi_id'], 'required'],
            [['user_id', 'pi_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['pi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pis::className(), 'targetAttribute' => ['pi_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'pi_id' => 'Pi ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPi()
    {
        return $this->hasOne(Pis::className(), ['id' => 'pi_id']);
    }

    public function getId(){
        return $this->id;
    }
    
    public function getPiId(){
        return $this->pi_id;
    }
    
    public function getUserId(){
        return $this->user_id;
    }
    
    public static function findByUserIdentity($user_id) {
        return self::findOne(['user_id'=>$user_id]);
    }
    
    public static function findIdentity($id) {
        return self::findOne($id);
    }
}
