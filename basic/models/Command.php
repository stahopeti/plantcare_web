<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "commands".
 *
 * @property int $id
 * @property int $pot_id
 * @property string $timestamp
 * @property string $task
 * @property string $parameter
 * @property int $deleted
 *
 * @property Pots $pot
 */
class Command extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'commands';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pot_id', 'task', 'deleted'], 'required'],
            [['pot_id', 'deleted'], 'integer'],
            [['task', 'parameter'], 'string', 'max' => 255],
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
            'task' => 'Task',
            'parameter' => 'Parameter',
            'deleted' => 'Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPot()
    {
        return $this->hasOne(Pots::className(), ['id' => 'pot_id']);
    }
}
