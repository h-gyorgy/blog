<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\SignupForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Regisztráció';

?>

<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Töltsd ki a következő mezőket:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'signup-form',
        //'layout' => 'horizontal',

        'fieldConfig' => [
            'template' => "{label}<br><div class=\"col-12\">{input}</div><br><div class=\"col-12\">{error}</div>",
            'labelOptions' => ['class' => 'control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'email', ['enableAjaxValidation' => true])->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'username', ['enableAjaxValidation' => true]) ?>

        <?= $form->field($model, 'password', )->passwordInput() ?>

        <?= $form->field($model, 'password_repeat', )->passwordInput() ?>

        <div class="form-group">
            <div class="col-12">
                <?= Html::submitButton('Regisztrálok', ['class' => 'btn btn-primary submit', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    
</div>
