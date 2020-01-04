<?php

use \yii\helpers\Html;


/** @var $article \app\models\Article */
?>
<div>
    <hr>
    
    <h3><?= Html::a($article->title, ['article/view', 'id' => $article->id]) ?></h3>
    
    <p class="text-muted"><i> <?= $article->description ?> </i></p>

    <br>

    <p class="text-muted" style='float: right'>
    
        <b><?= Html::a(
            !Yii::$app->user->isGuest && $article->created_by == Yii::$app->user->identity->id ? 'Én' : $article->createdBy->username,
            ['profile/' . $article->createdBy->id]);
            ?>
        </b>,&nbsp;

        <?= Yii::$app->formatter->asDate($article->created_at, 'yyyy-MM-dd') ?>
    </p>

    <p class="text-muted" style='float: left'>
        <?= count($article->comments)?>&nbsp;hozászólás
    </p>
   
    <div class="clearfix" style='height:3rem'></div>
    
</div>