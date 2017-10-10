<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Pots;
use app\models\PlantConfigs;

/* @var $this yii\web\View */
/* @var $model app\models\PlantConfigs */
/* @var $form yii\widgets\ActiveForm */

   $session = Yii::$app->session;
   $pot_id_from_session = $session->get('selected_pot_id');
   $selected_pot = Pots::findIdentity($pot_id_from_session);
   $selected_plant_config = $selected_pot->plantConfig;
   $model = $selected_plant_config;
   $model->isunique = 1;
?>

<div class="plant-configs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'plant_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plant_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'req_temp')->textInput() ?>

    <?= $form->field($model, 'req_moist')->textInput() ?>

    <?= $form->field($model, 'req_light')->textInput() ?>

    <div style="display: none;"><?= $form->field($model, 'isunique')->textInput() ?></div>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
