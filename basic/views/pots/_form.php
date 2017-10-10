<?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use app\models\PlantConfigs;

    /* @var $this yii\web\View */
    /* @var $model app\models\Pots */
    /* @var $form yii\widgets\ActiveForm */


    $plantConfigs = PlantConfigs::findNotUniquePlantConfigs();
    $plantConfigsDropDown = array();
    foreach($plantConfigs as $pConf){
        $plantConfigsDropDown[$pConf->id] = $pConf->plant_name ;
    }
?>

<div class="pots-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plant_config_id')->dropDownList(
        $plantConfigsDropDown,
        ['prompt' => 'Choose plant config']
            ) ?>
    
    <?= $form->field($model, 'sunrise')->textInput() ?>

    <?= $form->field($model, 'sunset')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
