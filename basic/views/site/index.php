<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = 'Dashboard';

?>

<h1><?= Html::encode($this->title)?></h1>

<?php 

//echo \Yii::$app->view->render('_loggedInIndex');

if(Yii::$app->user->isGuest){
    echo \Yii::$app->view->render('_guestIndex');
} else {
    echo \Yii::$app->view->render('_loggedInIndex');  
}
?>