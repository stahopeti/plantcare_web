<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = 'Dashboard';
?>

<h3><?= Html::encode($this->title)?></h3>

<?php 

//echo \Yii::$app->view->render('_loggedInIndex');

if(Yii::$app->user->isGuest){
    echo \Yii::$app->view->render('index/_guestIndex');
} else {
    echo \Yii::$app->view->render('index/_loggedInIndex');  
}
?>