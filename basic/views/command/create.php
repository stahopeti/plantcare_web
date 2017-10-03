<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Command */

$this->title = 'Create Command';
$this->params['breadcrumbs'][] = ['label' => 'Commands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="command-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
