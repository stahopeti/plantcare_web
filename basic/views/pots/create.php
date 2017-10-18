<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pots */

$this->title = 'Add new pot';
$this->params['breadcrumbs'][] = ['label' => 'Pots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pots-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formCreate', [
        'model' => $model,
    ]) ?>

</div>
