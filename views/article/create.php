<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = 'Bejegyzés írása';
$buttonText = 'Létrehozás';

?>
<div class="article-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'buttonText' => $buttonText]) 
    ?>

</div>
