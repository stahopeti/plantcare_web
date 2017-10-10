<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PlantConfigs */

$this->title = 'Create Plant Configs';
$this->params['breadcrumbs'][] = ['label' => 'Plant Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plant-configs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
