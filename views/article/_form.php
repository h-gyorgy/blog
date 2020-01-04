<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'autofocus' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_public')->checkBox() ?>

    <?= $form->field($model, 'is_commentable')->checkBox() ?>

    <div class="form-group">
        <?= Html::submitButton($buttonText, ['class' => 'btn btn-success submit']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
