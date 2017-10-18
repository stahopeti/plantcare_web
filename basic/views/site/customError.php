<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = "Error";
$session = Yii::$app->session;
$errorMessage = $session->get('errorMessage');
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <h2><?= Html::encode($errorMessage) ?></h2>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div>
