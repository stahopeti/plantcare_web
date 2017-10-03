<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Command */
/* @var $form ActiveForm */
?>
<div class="CommandForm">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'pot_id') ?>
        <?= $form->field($model, 'timestamp') ?>
        <?= $form->field($model, 'task') ?>
        <?= $form->field($model, 'deleted') ?>
        <?= $form->field($model, 'parameter') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- CommandForm -->
