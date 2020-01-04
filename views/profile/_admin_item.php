<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;

?>

<hr>

<div class="row padding">
    <div class="col-xs-3 col-md-6 text-muted"><?= Html::a($article->title, ['article/view', 'id' => $article->id])?></div>
    <div class="col-xs-3 col-md-2 text-muted text-center"><?= $article->seen?></div>
    <div class="col-xs-3 col-md-2 text-center">

        <?= Html::a(FA::icon('pencil', ['class' => 'btn-admin'])->size(FA::SIZE_2X), 
            ['article/update', 'id' => $article->id]) 
        ?>
    </div>
    <div class="col-xs-3 col-md-2 text-center">
        
        <?= Html::a(FA::icon('trash', ['class' => 'btn-admin']), 
            ['article/delete', 'id' => $article->id], [
                'data' => [
                    'confirm' => 'Biztos törölni akarod a bejegyzést?',
                    'method' => 'post',
                ],
            ]) 
        ?>
    </div> 
</div>
