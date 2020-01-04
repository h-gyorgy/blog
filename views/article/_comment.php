<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php if(!(count($article->comments) == 0 && Yii::$app->user->isGuest)):?>

  <div class="text-muted comment-header open" style="float:left">
    <div class="arrow rotate">
      <b><span >&#8681;</span></b> 
    </div>
    Hozzászólások (<?= count($article->comments) ?>)
  </div>

  <div class="clearfix"></div>

  <div class="comment-body">

    <?php foreach(array_reverse($article->comments) as $cItem):?>
      <p>
        <?=Html::a(
          !Yii::$app->user->isGuest && $cItem->created_by == Yii::$app->user->identity->id ? 'Én' : $cItem->createdBy->username,
          '@web/profile/' . $cItem->createdBy->id )?>
        <br>
        <?= $cItem->body ?>
      </p>
      
    <?php endforeach;?>

    <?php if($article->is_commentable == 1 && !Yii::$app->user->isGuest):?>
      <div class="comment-form">

        <?php $form = ActiveForm::begin(); ?>

          <?= $form->field($comment, 'body')->textarea(['rows' => 2]) ?>

          <?= $form->field($comment, 'article_id')->hiddenInput(['value'=> $article->id])->label(false);?>

        <div class="form-group">
            <?= Html::submitButton('Küldés', ['class' => 'btn btn-primary submit']) ?>
        </div>

        <?php ActiveForm::end(); ?>

      </div>

    <?php endif;?>

  </div>

<?php endif;?>

