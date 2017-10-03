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
class WaterCommand extends \app\models\Command
{
    public function WaterCommand() 
    {
        $this->task='W';
    }
}
