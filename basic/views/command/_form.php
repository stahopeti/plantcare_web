<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Command */
/* @var $form yii\widgets\ActiveForm */
   $session = Yii::$app->session;
   $pot_id_from_session = $session->get('selected_pot_id');
?>

<div class="command-form">

    <?php $form = ActiveForm::begin(); 
        $model->pot_id = $pot_id_from_session;
        $model->deleted = 0;
    ?>

    <div style="display: none"><?= $form->field($model, 'pot_id')->textInput() ?></div>

    <?= $form->field($model, 'task')->dropDownList([
        'W' => 'Water',
        'L_SPEC' => 'Light'
        ],
        ['prompt' => 'Water or Light']
            ) ?>
    
    <?= $form->field($model, 'parameter')->textInput(['maxlength' => true]) ?>

    <div style="display: none"><?= $form->field($model, 'deleted')->textInput() ?></div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
