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
class LightCommand extends \app\models\Command
{
    public function LightCommand() 
    {
        $this->task='L_SPEC';
    }
}
