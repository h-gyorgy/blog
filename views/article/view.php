<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $article app\models\Article */

$this->title = $article->title;

?>

<div class="article-view">
    <div class="d-flex" style="display: flex; margin-bottom: 1rem">
        <h3 class='pl-1'>
            <?= Html::encode($article->title) ?>
        </h3>
    </div>
    <div class="clearfix"></div>
    <p class="text-muted">
        Szerző: 
        <b>
            <?=Html::a(
                !Yii::$app->user->isGuest && $article->created_by == Yii::$app->user->identity->id ? 'Én' : $article->createdBy->username, 
                '@web/profile/' . $article->createdBy->id)?>
        </b>
        <br>
        Létrehozva: <b><?= Yii::$app->formatter->asDate($article->created_at, 'yyyy-MM-dd')?></b><br>
    </p>
    <hr>
    <div>
        <?= $article->getEncodedBody() ?>
    </div>
    <hr>
    <?php if($article->is_commentable == 1):?>

        <?= $this->render('_comment', [
            'comment' => $comment,
            'article' => $article
        ]) ?>

    <?php else:?>
        <div class="clearfix" style='height:3rem'></div>
    <?php endif;?>

</div>

