<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
?>

<div class="site-index">
    <div class="jumbotron">
        <h1>Welcome back <?= Yii::$app->user->identity->username ?></h1>
        <p class="lead">Dashboard coming soon...</p>
    </div>
    <?php
        /*Yii::$app->potcomponent->helloWorld();*/
    ?>
</div>
