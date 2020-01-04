<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = 'Bejegyzés szerkesztése: ' . $model->title;
$buttonText = 'Változások mentése';

?>
<div class="article-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <br>

    <?= $this->render('_form', [
        'model' => $model,
        'buttonText' => $buttonText
    ]) ?>

</div>
